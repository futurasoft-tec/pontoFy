<?php

namespace App\Http\Controllers;

use App\Models\Colaboradore;
use App\Models\Categoria;
use App\Models\Documento;
use App\Models\RubricaColaborador;
use App\Models\Contrato;
use App\Models\Dependente;
use App\Models\Cargo;
use App\Models\Departamento;
use Illuminate\Http\Request;

class ColaboradoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        if (!auth()->check()) {
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team) {
            return redirect()->route('dashboard')->with('erro', 'Nenhum time selecionado.');
        }

        // Pegar todos colaboradores do team autenticado
         //Aplicar filtros de Colaboradores
        $query = Colaboradore::where('team_id', $team->id);
        
        //Filtrar cliente por nome
        if($request->filled('search')){
            $query->where('nome_completo', 'like', '%' . $request->search . '%');
        }

        // Filtera por numero de processo
        if($request->filled('searchCode')){
            $query->where('codigo',  $request->searchCode);
        }

        // Filtrar por numero do documento
        if($request->filled('searchDocId')){
            $query->where('numero_doc_id', $request->searchDocId);
        }

        // Filtrar por dada de admissao
        if($request->filled('seacrhData')){
            $query->where('data_admissao', $request->seacrhData);
        }


        $colaboradores = $query->paginate(15);
        return view('company.colaboradores.index', compact('colaboradores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
         if (!auth()->check()) {
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team) {
            return redirect()->route('dashboard')->with('erro', 'Nenhum time selecionado.');
        }


        // Pegar Categorias do team autenticado
        $categorias = Categoria::where('team_id', $team->id)
                ->orderBy('id', 'asc')
                ->get();
        
        $departamentos = Departamento::where('team_id', $team->id)
            ->orderBy('id', 'desc')
            ->get();

        $cargos = Cargo::where('team_id', $team->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('company.colaboradores.create', compact('categorias', 'departamentos', 'cargos'));
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
            'team_id'               => 'required|exists:teams,id',
            'user_id'               => 'nullable|exists:users,id',
            'departamento_id'       => 'nullable|exists:departamentos,id',
            'cargo_id'              => 'nullable|exists:cargos,id',
            'nome_completo'         => 'required|string|max:255',
            'data_nascimento'       => 'required|date',
            'genero'                => 'required|string',
            'estado_civil'          => 'required|string|max:50',
            'nacionalidade'         => 'required|string|max:100',
            'tipo_documento'        => 'required|string|max:50',
            'numero_doc_id'         => 'nullable|string|max:50|unique:colaboradores,numero_doc_id,NULL,id,team_id,' . $team->id,
            'data_emissao_doc'      => 'nullable|date',
            'data_validade_doc'     => 'nullable|date',
            'nif'                   => 'nullable|string|max:255|unique:colaboradores,nif,NULL,id,team_id,' . $team->id,
            'numero_inss'           => 'nullable|string|max:255|unique:colaboradores,numero_inss,NULL,id,team_id,' . $team->id,
            'pais'                  => 'required|string|max:100',
            'provincia'             => 'nullable|string|max:100',
            'cidade_estrangeira'    => 'nullable|string|max:255',
            'endereco'              => 'nullable|string|max:255',
            'telefone'              => 'nullable|string|max:20',
            'email'                 => 'nullable|string|max:50',
            'foto_url'              => 'nullable|string',
            'data_admissao'         => 'required|date',
            'data_demissao'         => 'nullable|date',
            'status'                => 'nullable|string',
            'criado_por'            => 'required|exists:users,id',
        ]);
          
        // Criar registro
        $colaboradores = Colaboradore::create($validaDados);
        return redirect()->route('colaboradores.index')->with('sucesso', 'Colaborador adicionando com sucesso');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team) {
            return redirect()->route('dashboard')->with('erro', 'Nenhum time selecionado.');
        }

        // Pegar Colaborador pelo ID
        // $colaborador = Colaboradore::with('dependentes', 'documentos', 'contratos')->findOrFail($id);
        $colaborador = Colaboradore::with('rubricas')->findOrFail($id);

        // Pegar todos dependentes do colaborador selecionado
        $dependentes = Dependente::where('colaborador_id', $colaborador->id)
        ->orderBy('id', 'desc')
        ->paginate(10);

        // Pegar todos Documento do Colaborador
        $documentos = Documento::where('colaborador_id', $colaborador->id)
            ->orderBy('id', 'desc')
            ->paginate(10);

        // Pegar todos Documento do Colaborador
        $contratos = Contrato::where('colaborador_id', $colaborador->id)
            ->orderBy('id', 'desc')
            ->paginate(10);

        
        // Pegar todas rubricas do colaborador
        // $rubricasColaborador = RubricaColaborador::with('rubrica')
        //     ->where('colaborador_id', $colaborador->id)
        //     ->orderBy('id', 'desc')
        //     ->get();

         // Verificar se o colaborador pertence ao team autenticado
        if ($colaborador->team_id !== $team->id) {
            return redirect()->route('dashboard')->with('erro', 'Cargo não encontrado.');
        }

        return view('company.colaboradores.detail', compact('colaborador', 'dependentes', 'documentos', 'contratos'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
         if (!auth()->check()) {
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team) {
            return redirect()->route('dashboard')->with('erro', 'Nenhum time selecionado.');
        }


        // Pegar o Colaborador pelo ID
        $colaborador = Colaboradore::findOrFail($id);

        // Verificar se o cargo pertence ao team autenticado
        if ($colaborador->team_id !== $team->id) {
            return redirect()->route('dashboard')->with('erro', 'Colaborador não encontrado.');
        }

        // Pegar todos cargos
        $cargos = Cargo::where('team_id', $team->id)
                ->orderBy('id', 'desc')
                ->get();
        // Pegar todos Departamentos
        $departamentos = Departamento::where('team_id', $team->id)
         ->orderBy('id', 'desc')
                ->get();

        return view('company.colaboradores.edit', compact('colaborador', 'cargos', 'departamentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
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
            'team_id'               => 'required|exists:teams,id',
            'user_id'               => 'nullable|exists:users,id',
            'departamento_id'       => 'nullable|exists:departamentos,id',
            'cargo_id'              => 'nullable|exists:cargos,id',
            'nome_completo'         => 'required|string|max:255',
            'data_nascimento'       => 'required|date',
            'genero'                => 'required|string',
            'estado_civil'          => 'required|string|max:50',
            'nacionalidade'         => 'required|string|max:100',
            'tipo_documento'        => 'required|string|max:50',
            'numero_doc_id'         => 'nullable|string|max:50',
            'data_emissao_doc'      => 'nullable|date',
            'data_validade_doc'     => 'nullable|date',
            'nif'                   => 'nullable|string|max:50',
            'numero_inss'           => 'nullable|string|max:50',
            'pais'                  => 'required|string|max:100',
            'provincia'             => 'nullable|string|max:100',
            'cidade_estrangeira'    => 'nullable|string|max:255',
            'endereco'              => 'nullable|string|max:255',
            'telefone'              => 'nullable|string|max:20',
            'email'                 => 'nullable|string|max:50',
            'foto_url'              => 'nullable|string',
            'data_admissao'         => 'required|date',
            'data_demissao'         => 'nullable|date',
            'status'                => 'nullable|string',
            'criado_por'            => 'required|exists:users,id',
        ]);

        // Pegar o Colaborador pelo ID
        $colaborador = Colaboradore::findOrFail($id);
        
        // Verificar se o cargo pertence ao team autenticado
        if ($colaborador->team_id !== $team->id) {
            return redirect()->route('dashboard')->with('erro', 'Cargo não encontrado.');
        }

        // Actualizar registro
        $colaborador->update($validaDados);
        return redirect()->route('colaboradores.index')->with('sucesso', 'Dados do Colaborador Actualizados com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team) {
            return redirect()->route('dashboard')->with('erro', 'Nenhum time selecionado.');
        }

        // Buscar colaborador garantindo que seja do time
        $colaborador = Colaboradore::where('team_id', $team->id)->findOrFail($id);

        // Verificar vínculos antes de excluir
        $possuiVinculos =
            $colaborador->contratos()->exists() ||
            $colaborador->documentos()->exists() ||
            $colaborador->lancamentosSalarios()->exists() ||
            $colaborador->recibos()->exists() ||
            $colaborador->insses()->exists() ||
            $colaborador->irps()->exists() ||
            $colaborador->dependentes()->exists();

        if ($possuiVinculos) {
            return redirect()
                ->route('colaboradores.index')
                ->with('erro', 'Não é possível excluir este colaborador pois existem dados associados.');
        }

        // Caso não tenha vínculos — pode excluir
        $colaborador->delete();

        return redirect()->route('colaboradores.index')->with('sucesso', 'Colaborador excluído com sucesso.');
    }


}
