<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Departamento;
use App\Models\Colaboradore;
use App\Models\Cargo;
use App\Models\NiveisHierarquico;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team) {
            return redirect()->route('dashboard')->with('erro', 'Nenhum time selecionado.');
        }


        // Pegar Departamentos do team autenticado
        $categorias = Categoria::where('team_id', $team->id)
                ->orderBy('id', 'desc')
                ->paginate(15);


        return view('company.categorias.index', compact('categorias'));
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


        // Listar todos departamentos do time autenticado
        $departamentos = Departamento::where('team_id', $team->id)
                ->orderBy('id', 'asc')
                ->get();
        

        // Pegar todos cargos do time autenticado
        $cargos = Cargo::where('team_id', $team->id)
                ->orderBy('id', 'asc')
                ->get();

        // Pegar todos os niveis do time autenticado
        $niveis = NiveisHierarquico::where('team_id', $team->id)
                ->orderBy('id', 'asc')
                ->get();


        return view('company.categorias.create', compact('departamentos', 'cargos', 'niveis'));
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
            'team_id'         => 'required|exists:teams,id',
            'departamento_id' => 'required|exists:departamentos,id',
            'cargo_id'        => 'required|exists:cargos,id',
            'nome'            => 'required|string|max:150',
            'funcao'          => 'required|string|max:150',
            'descricao'       => 'nullable|string',
            'estado'          => 'required|in:ativo,inativo',
            'criado_por'      => 'required|exists:users,id',
        ]);

        // Criar Categoria
        $categorias = Categoria::create($validaDados);

        return redirect()->route('categorias.index')->with('sucesso', 'Categoria criada com sucesso.');

    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team) {
            return redirect()->route('dashboard')->with('erro', 'Nenhum time selecionado.');
        }

        // Pegar categoria pelo ID
        $categoria = Categoria::findOrFail($id);
        
        // Verificar se categoria pertence ao team autenticado
        if($categoria->team_id !== $team->id){
            return redirect()-route('dashboard')->with('erro', 'Categoria não encontrada.');
        }   

        return view('company.categorias.detail', compact('categoria'));
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

        // Pegar categoria pelo ID
        $categoria = Categoria::with('colaboradores')->findOrFail($id);        // Verificar se categoria pertence ao team autenticado
        
        if($categoria->team_id !== $team->id){
            return redirect()-route('dashboard')->with('erro', 'Categoria não encontrada.');
        }   

        // Listar todos departamentos do time autenticado
        $departamentos = Departamento::where('team_id', $team->id)
                ->orderBy('id', 'asc')
                ->get();
        

        // Pegar todos cargos do time autenticado
        $cargos = Cargo::where('team_id', $team->id)
                ->orderBy('id', 'asc')
                ->get();

        // Pegar todos os niveis do time autenticado
        $niveis = NiveisHierarquico::where('team_id', $team->id)
                ->orderBy('id', 'asc')
                ->get();

        return view('company.categorias.edit', compact('categoria', 'departamentos', 'cargos', 'niveis'));
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
            'team_id'         => 'required|exists:teams,id',
            'departamento_id' => 'required|exists:departamentos,id',
            'cargo_id'        => 'required|exists:cargos,id',
            'nome'            => 'required|string|max:150',
            'funcao'          => 'required|string|max:150',
            'descricao'       => 'nullable|string',
            'estado'          => 'required|in:ativo,inativo',
            'criado_por'      => 'required|exists:users,id',
        ]);

         // pagar categoria pelo ID
        $categoria = Categoria::findOrFail($id);

        // Criar Categoria
        $categoria->update($validaDados);

       return redirect()->route('categorias.index')->with('sucesso', 'Categoria editada com sucesso.');
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

        // Pegar categoria pelo ID
        $categoria = Categoria::findOrFail($id);
        // Verificar se categoria pertence ao team autenticado
        if($categoria->team_id !== $team->id){
            return redirect()-route('dashboard')->with('erro', 'Categoria não encontrada.');
        }
        // Deletar categoria

        $categoria->delete();
        return redirect()->route('categorias.index')->with('sucesso', 'Categoria deletada com sucesso.');

    }
}
