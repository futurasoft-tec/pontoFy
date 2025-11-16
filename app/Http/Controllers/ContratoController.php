<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Clausula;
use App\Models\Rubrica;
use App\Models\RubricaColaborador;
use App\Models\Colaboradore;
use App\Models\ClausulaContrato;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf; // Importa o DomPDF

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        // VERIFICAR SE USUARIO ESTA AUTENTICADO
        if(auth()->check()){
            $user = auth()->user(); // Pegar usuario autenticado

            // Pegar o team do usuario autenticado
            $team = $user->currentTeam;
        } else {
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }



        // Aplicar filtros
        $query = Contrato::where('team_id', $team->id);

        // Filtrar por codigo
        if($request->filled('searchCode')){
            $query->where('codigo', $request->searchCode);
        }

        // Filtrar por data de inicio do contrato
        if($request->filled('seacrhDataStart')){
            $query->where('data_inicio', $request->seacrhDataStart);
        }

        // Filtrar por colaborador
        if($request->filled('searchColaborador')){
            $query->where('colaborador_id', $request->searchColaborador);
        }
        
        // Pegar todos contratos pertencente ao team autenticado
        $contratos = $query->paginate(15);

        // Pegar Colaboradores para Filtragens
        $colaboradores = Colaboradore::where('team_id', $team->id)
        ->orderBy('id', 'desc')
        ->get();
        return view('company.contratos.index', compact('contratos', 'colaboradores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team) {
            return redirect()->route('dashboard')->with('erro', 'Nenhum time selecionado.');
        }

        // Validação dos campos
        $validaDados = $request->validate([
            'team_id'             => 'required|exists:teams,id',
            'criado_por'          => 'required|exists:users,id',
            'colaborador_id'      => 'required|exists:colaboradores,id',
            'tipo_contrato'       => 'required|string',
            'data_inicio'         => 'required|date',
            'data_fim'            => 'nullable|date|after_or_equal:data_inicio',
            'periodo_experiencia' => 'required|string',
            'salario_base'        => 'required|numeric|min:0',
            'funcoes'             => 'nullable|string',
            'observacoes'         => 'nullable|string',
            'status'              => 'nullable|string'
        ], [
            'team_id.required'             => 'A Empresa é obrigatória.',
            'colaborador_id.required'      => 'O colaborador é obrigatório.',
            'tipo_contrato.required'       => 'O tipo de contrato é obrigatório.',
            'data_inicio.required'         => 'A data de início é obrigatória.',
            'periodo_experiencia.required' => 'O período de experiência é obrigatório.',
            'salario_base.required'        => 'O salário base é obrigatório.',
        ]);

        // Forçar status como rascunho
        $validaDados['status'] = 'rascunho';

        // Verificar se o colaborador já tem um contrato ativo ou em rascunho
        $contratoExistente = Contrato::where('team_id', $team->id)
            ->where('colaborador_id', $validaDados['colaborador_id'])
            ->where('status', ['ativo'])
            ->first();

        if ($contratoExistente) {
            return redirect()->back()->with('erro', 'O colaborador selecionado já possui um contrato activo.');
        }

        // Criar contrato
        $contrato = Contrato::create($validaDados);

        // Registrar rubrica "SALARIO_BASE" ao colaborador
        $rubricaSalarioBase = Rubrica::where('team_id', $team->id)
            ->where('slug_sistema', 'salario_base')
            ->first();

        if ($rubricaSalarioBase) {
            RubricaColaborador::updateOrCreate(
                [
                    'team_id'        => $team->id,
                    'colaborador_id' => $request->colaborador_id,
                    'rubrica_id'     => $rubricaSalarioBase->id,
                ],
                [
                    'eh_automatica'     => true,
                    'status'            => 'ativo',
                    'valor_customizado' => $request->salario_base,
                ]
            );
        }

        return redirect()->route('add.clausulas', $contrato->id)
                        ->with('sucesso', 'Contrato criado com sucesso.');
    }




    /**
     * Display the specified resource.
     */
    public function rascunho($id)
    {
        // Verifica autenticação
        if (!auth()->check()) {
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team) {
            return redirect()->route('dashboard')->with('erro', 'Nenhum time selecionado.');
        }

        // Busca o contrato
        $contrato = Contrato::with([
            'colaborador',
            'team',
            'clausulas' => function ($q) {
                $q->orderBy('clausula_contratos.ordem', 'asc');
            }
        ])->findOrFail($id);

        // Verifica se o contrato é do time atual
        if ($contrato->team_id !== $team->id) {
            return redirect()->route('dashboard')->with('erro', 'Acesso não autorizado a este contrato.');
        }

        // Só permite visualizar se está em rascunho
        if ($contrato->status !== 'rascunho') {
            return redirect()->route('dashboard')->with('erro', 'Este contrato já não está mais em rascunho.');
        }

        // Ordena cláusulas corretamente
        $clausulas = $contrato->clausulas()->orderBy('clausula_contratos.ordem')->get();

        return view('company.contratos.contrato-rascunho', compact('contrato', 'clausulas'));
    }



    /**
     * Display the specified resource (contrato ativo/assinado).
     */
    public function show($id)
    {
        // Verifica autenticação
        if (!auth()->check()) {
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team) {
            return redirect()->route('dashboard')->with('erro', 'Nenhum time selecionado.');
        }

        // Busca o contrato
        $contrato = Contrato::with([
            'colaborador',
            'team',
            'clausulas' => function ($q) {
                $q->orderBy('clausula_contratos.ordem', 'asc');
            }
        ])->findOrFail($id);

        // Verifica se o contrato pertence ao time atual
        if ($contrato->team_id !== $team->id) {
            return redirect()->route('dashboard')->with('erro', 'Acesso não autorizado a este contrato.');
        }

        // Só permite visualizar contratos ativos ou assinados
        if (!in_array($contrato->status, ['ativo','terminado', 'inativo','rescindido'])) { // adicione outros status se necessário
            return redirect()->route('dashboard')->with('erro', 'Este contrato não pode ser visualizado.');
        }

        // Ordena cláusulas
        $clausulas = $contrato->clausulas()->orderBy('clausula_contratos.ordem')->get();

        return view('company.contratos.contrato-manager', compact('contrato', 'clausulas'));
    }


    





    
    // PAGINA PARA ADICIONAR CLAUSULAS
    public function addClausulas($id){
       if (!auth()->check()) {
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team) {
            return redirect()->route('dashboard')->with('erro', 'Nenhum time selecionado.');
        }
        // Pegar contrato pelo ID
        $contrato = Contrato::findOrFail($id);

        // Só permite visualizar se está em rascunho
        if ($contrato->status !== 'rascunho') {
            return redirect()->route('dashboard')->with('erro', 'Este contrato já não está mais em rascunho.');
        }

        
        // Pegar todas Clausulas
        $clausulas  = Clausula::orderBy('id', 'asc')->get();
        // Pegar Clausulas do team autenticado
        $minhasClausulas = Clausula::where('team_id', $team->id)
            ->orderBy('id', 'asc')
            ->get();
        
        // Pegar todas clausulas globais do tipo de "TRABALHO"
        $clausulasTrabalho = Clausula::where('tipo', 'trabalho')
            ->where('team_id', null)
            ->orderBy('id', 'asc')
            ->get();

        // Pegar todas clausulas globais do tipo de "SERVICOS"
        $clausulasServicos = Clausula::where('tipo', 'servico_prestacao')
            ->where('team_id', null)
            ->orderBy('id', 'asc')
            ->get();

        
        // Pegar todas clausulas globais do tipo diferente "Trabalho e Servicos"
        $OutrasClausulas = Clausula::whereNotIn('tipo', ['trabalho', 'servico_prestacao'])
            ->where('team_id', null)
            ->orderBy('id', 'asc')
            ->get();
        return view('company.contratos.add-clausulas', compact('contrato', 'clausulasTrabalho', 'minhasClausulas', 'clausulasServicos', 'OutrasClausulas', 'clausulas'));
    }


    
    /**
     * Show the form for editing the specified resource.
     */
    public function gerarPdf($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team) {
            return redirect()->route('dashboard')->with('erro', 'Nenhum time selecionado.');
        }


        // Busca o contrato
        $contrato = Contrato::with('clausulas')->findOrFail($id);

        // Passa os dados para a view PDF
        $pdf = Pdf::loadView('company.contratos.contratos-pdf', compact('contrato'));

        // Define o nome do ficheiro
        $filename = 'Contrato_' . $contrato->id . '.pdf';

        // Retorna o PDF para download ou visualização
        return $pdf->stream($filename);
        // Se quiser forçar o download: return $pdf->download($filename);
    }


    /**
     * Converter contrato em PDF e finalizar
     */
    public function edit(Contrato $contrato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team) {
            return redirect()->route('dashboard')->with('erro', 'Nenhum time selecionado.');
        }

        // Encontrar contrato
        $contrato = Contrato::findOrFail($id);

        // 1. BLOQUEAR EDIÇÃO SE FOR UM CONTRATO JA ASSINADO
        if ($contrato->codigo_assinatura) {
            return back()->with('erro', 'Este contrato já foi assinado e não pode ser editado. Crie um aditivo contratual.');
        }

        // 2. BLOQUEAR SE STATUS NÃO PERMITIR EDIÇÃO
        $bloqueados = ['ativo', 'terminado', 'rescindido', 'inativo'];

        if (in_array($contrato->status, $bloqueados)) {
            return back()->with('erro', 'Este contrato não pode ser editado no status atual (' . $contrato->status . ').');
        }

        // 3. VALIDAÇÃO DOS CAMPOS
        $validaDados = $request->validate([
            'team_id'             => 'required|exists:teams,id',
            'criado_por'          => 'required|exists:users,id',
            'colaborador_id'      => 'required|exists:colaboradores,id',
            'tipo_contrato'       => 'required|string',
            'data_inicio'         => 'required|date',
            'data_fim'            => 'nullable|date|after_or_equal:data_inicio',
            'periodo_experiencia' => 'required|string',
            'salario_base'        => 'required|numeric|min:0',
            'funcoes'             => 'nullable|string',
            'observacoes'         => 'nullable|string',
            'status'              => 'nullable|string'
        ]);

        // 4. Atualizar contrato
        $contrato->update($validaDados);

        return back()->with('sucesso', 'Contrato editado com sucesso!');
    }



    /**
     * Assinar the specified resource from storage.
     */
    public function assinar(Request $request, $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team) {
            return redirect()->route('dashboard')->with('erro', 'Nenhum time selecionado.');
        }

        // Pegar o contrato
        $contrato = Contrato::findOrFail($id);

        // 1. Verificar se já está assinado
        if ($contrato->codigo_assinatura) {
            return back()->with('erro', 'Este contrato já está assinado.');
        }

        // 2. Verificar se o status permite assinatura
        $permitidos = ['rascunho'];
        if (!in_array($contrato->status, $permitidos)) {
            return back()->with('erro', 'Este contrato não pode ser assinado no status atual (' . $contrato->status . ').');
        }

        // 3. Verificar se o contrato possui cláusulas associadas
        if (!$contrato->clausulaContratos()->exists()) {
            return back()->with('erro', 'Não é possível assinar um contrato sem cláusulas associadas.');
        }


         // Verifica se o contrato pertence ao time atual
        if ($contrato->team_id !== $team->id) {
            return redirect()->route('dashboard')->with('erro', 'Acesso não autorizado a este contrato.');
        }

        // 4. Assinar contrato (registar assinatura)
        $contrato->update([
            'codigo_assinatura' => strtoupper(Str::random(16)),
            'assinado_por'      => $user->id,
            'data_assinatura'   => now(),
            'status'            => 'ativo',
        ]);

        return redirect()->route('contrato.show', $contrato->id)->with('sucesso', 'Contrato assinado com sucesso!');
    }



    // Rescindir o contrato 

    public function rescindir(Request $request, $id)
    {
        // VALIDA AUTENTICAÇÃO
        if (!auth()->check()) {
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team) {
            return redirect()->route('dashboard')->with('erro', 'Nenhum time selecionado.');
        }

        // VALIDA CAMPOS
        $request->validate([
            'motivo_rescisao' => 'required|string|min:5|max:2000',
        ]);

        // BUSCA O CONTRATO DA EMPRESA
        $contrato = Contrato::where('team_id', $team->id)->findOrFail($id);

        // REGRAS DE NEGÓCIO — ELEGIBILIDADE DA RESCISÃO
        if ($contrato->status !== 'ativo') {
            return back()->with('erro', 'Apenas contratos ativos podem ser rescindidos.');
        }

        // EVITA DUPLICIDADE
        if ($contrato->data_rescisao !== null) {
            return back()->with('erro', 'Este contrato já foi rescindido anteriormente.');
        }

        // ATUALIZA OS DADOS DA RESCISÃO
        $dataHoje = now()->toDateString();

        // Verificar se é maior ou igual à data de início
        if ($dataHoje < $contrato->data_inicio) {
            return back()->with('erro', 'A data de rescisão não pode ser anterior à data de início do contrato.');
        }

        $contrato->update([
            'status'            => 'rescindido',
            'data_rescisao'     => $dataHoje,
            'motivo_rescisao'   => $request->motivo_rescisao,
            'rescindido_por'    => $user->id,
        ]);


        return redirect()
            ->route('contrato.show', $contrato->id)
            ->with('sucesso', 'Contrato rescindido com sucesso.');
    }



    // Cancelar o contrato 
    public function cancelar(Request $request, $id)
    {
         // VALIDA AUTENTICAÇÃO
        if (!auth()->check()) {
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team) {
            return redirect()->route('dashboard')->with('erro', 'Nenhum time selecionado.');
        }

        // Busca o contrato
        $contrato = Contrato::findOrFail($id);

        // Verifica se o contrato é rascunho
        if ($contrato->status !== 'rascunho') {
            return back()->with('erro', 'Apenas contratos em rascunho podem ser cancelados.');
        }


        // Verifica se o contrato pertence ao time atual
        if ($contrato->team_id !== $team->id) {
            return redirect()->route('dashboard')->with('erro', 'Acesso não autorizado a este contrato.');
        }



        // Atualiza status para inativo
        $contrato->update([
            'status' => 'inativo',
        ]);

        return redirect()
            ->back()
            ->with('sucesso', 'Contrato cancelado com sucesso.');
    }




    /**
     * Remove the specified resource from storage.
     */
     
    public function destroy($id)
    {
        // Verifica autenticação
        if (!auth()->check()) {
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }

        $user = auth()->user();
        $team = $user->currentTeam;

        // Busca o contrato
        $contrato = Contrato::findOrFail($id);

        // Verifica se pertence ao time atual
        if ($contrato->team_id !== $team->id) {
            return redirect()->route('dashboard')->with('erro', 'Acesso não autorizado a este contrato.');
        }

        // Apenas contratos em rascunho ou ativos podem ser deletados
        if (!in_array($contrato->status, ['rascunho', 'ativo'])) {
            return back()->with('erro', 'Este contrato não pode ser deletado.');
        }

        // Deleta o contrato
        $contrato->delete();

        return redirect()
            ->route('contratos.index')
            ->with('sucesso', 'Contrato deletado com sucesso.');
    }

}
