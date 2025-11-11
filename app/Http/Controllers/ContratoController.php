<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Clausula;
use App\Models\Rubrica;
use App\Models\RubricaColaborador;
use App\Models\Colaboradore;
use App\Models\ClausulaContrato;
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

        // Validar dados
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
        ],
        [
            // Mensagens personalizadas
            'team_id.required'             => 'A Empresa é obrigatória.',
            'team_id.exists'               => 'A Empresa selecionada não é válida.',
            'criado_por.required'          => 'O utilizador criador é obrigatório.',
            'criado_por.exists'            => 'O utilizador criador não é válido.',
            'colaborador_id.required'      => 'O colaborador é obrigatório.',
            'colaborador_id.exists'        => 'O colaborador selecionado não existe.',
            'tipo_contrato.required'       => 'O tipo de contrato é obrigatório.',
            'data_inicio.required'         => 'A data de início é obrigatória.',
            'data_inicio.date'             => 'A data de início deve ser uma data válida.',
            'data_fim.date'                => 'A data de fim deve ser uma data válida.',
            'data_fim.after_or_equal'      => 'A data de fim não pode ser inferior à data de início.',
            'periodo_experiencia.required' => 'O período de experiência é obrigatório.',
            'salario_base.required'        => 'O salário base é obrigatório.',
            'salario_base.numeric'         => 'O salário base deve ser um valor numérico.',
            'salario_base.min'             => 'O salário base deve ser um valor positivo.',
            'funcoes.string'               => 'O campo funções deve conter texto válido.',
            'observacoes.string'           => 'O campo observações deve conter texto válido.',
            'status.string'                => 'O estado deve ser um texto válido.'
        ]);
        
        //Slavar registro
        $contrato = Contrato::create($validaDados);

        //  Pegar a rubrica "SALARIO_BASE "
        $rubricaSalarioBase = Rubrica::where('team_id', $team->id)
            ->where('slug_sistema', 'salario_base')
            ->first();
        
        // Reigstrar a Rubrica fixa ao colaborador
        if($rubricaSalarioBase){
                RubricaColaborador::updateOrCreate([
                    'team_id'         => $team->id,
                    'colaborador_id'  => $request->colaborador_id,
                    'rubrica_id'      => $rubricaSalarioBase->id,
                ],
                [
                    'eh_automatica'     => true,
                    'valor_customizado' => $request->salario_base, // salário vindo do contrato
                ]
            );
        }




        return redirect()->route('add.clausulas',$contrato->id )->with('sucesso', 'Contrato Criado com sucesso');
    }


    /**
     * Display the specified resource.
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

            $clausulas = $contrato->clausulas()->orderBy('clausula_contratos.ordem')->get();

            return view('company.contratos.contrato-rascunho', compact('contrato', 'clausulas'));
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
    public function update(Request $request, Contrato $contrato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contrato $contrato)
    {
        //
    }
}
