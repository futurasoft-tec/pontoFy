<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Departamento;
use App\Models\NiveisHierarquico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CargoController extends Controller
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


        // Pega o código do nível (ex: ?codigo=N1)
        $codigoNivel = $request->input('codigo');

        // Pegar os cargos do team autenticado
        $cargos = Cargo::where('team_id', $team->id)
            ->when($codigoNivel, function ($query, $codigoNivel) {
                $query->whereHas('nivel', function ($subQuery) use ($codigoNivel) {
                    $subQuery->where('codigo', $codigoNivel);
                });
            })
            ->orderBy('nivel_id', 'desc')
            ->paginate(15);


        return view('company.cargos.index', compact('cargos'));
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


        // Pegar departamentos do team autenticado
        $departamentos = Departamento::where('team_id', $team->id)
            ->orderBy('id', 'desc')
            ->get();

        
         // Pegar departamentos do team autenticado
        $niveis = NiveisHierarquico::where('team_id', $team->id)
            ->orderBy('id', 'desc')
            ->get();


        return view('company.cargos.create', compact('departamentos', 'niveis'));
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
            'team_id'     => 'required|exists:teams,id',
            'criado_por'  => 'required|exists:users,id',
            'departamento_id' => 'required|exists:departamentos,id',
            'nivel_id'     => 'required|exists:niveis_hierarquicos,id',
            'nome' => 'required|string|max:200',
            'descricao' =>'nullable|string',
            'nivel_hierarquico' => 'nullable|string',
        ]);

        // dd($validaDados);
        $criarCargos = Cargo::create($validaDados);
        return redirect()->route('cargos.index')->with('sucesso', 'Cargo criado com sucesso');
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


        // Pegar cargo pelo ID
        $cargo = Cargo::findOrFail($id);

        // Verificar se cargo pertence ao team autenticado

        if($cargo->team_id !== $team->id){
            return redirect()-route('dashboard')->with('erro', 'Departamento não encontrado.');
        }


        return view('company.cargos.detalhe', compact('cargo'));
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

        // Pegar cargo pelo ID
        $cargo = Cargo::findOrFail($id);
        // Verificar se cargo pertence ao team autenticado 
        if($cargo->team_id !== $team->id){
            return redirect()-route('dashboard')->with('erro', 'Cargo não encontrado.');
        }


        // Pegar departamentos do team autenticado
        $departamentos = Departamento::where('team_id', $team->id)
            ->orderBy('id', 'desc')
            ->get();

        
             // Pegar departamentos do team autenticado
        $niveis = NiveisHierarquico::where('team_id', $team->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('company.cargos.edit', compact('cargo', 'departamentos', 'niveis'));
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

        $validaDados = $request->validate([
            'team_id'     => 'exists:teams,id',
            'criado_por'  => 'exists:users,id',
            'departamento_id' => 'exists:departamentos,id',
            'nivel_id'     => 'exists:niveis_hierarquicos,id',
            'nome' => 'string|max:200',
            'descricao' =>'nullable|string',
            'nivel_hierarquico' => 'nullable|string',
        ]);

        $cargo = Cargo::findOrFail($id);

        if ($cargo->team_id !== $team->id) {
            return redirect()->route('dashboard')->with('erro', 'Cargo não encontrado.');
        }

        $cargo->update($validaDados);

        return redirect()->route('cargos.index')->with('sucesso', 'Cargo actualizado com sucesso!');
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

        $cargo = Cargo::findOrFail($id);

        // Verificar se cargo pertence ao team autenticado
        if ($cargo->team_id !== $team->id) {
            return redirect()->route('dashboard')->with('erro', 'Cargo não encontrado.');
        }   

        // Verificar se o cargo está associado a algum colaborador
        $colaboradorAssociado = DB::table('colaboradores')
                ->where('departamento_id', $id)
                ->exists();
                
        // Deletar o cargo
        $cargo->delete();

        // Redirecionar com mensagem de sucesso
        return redirect()->route('cargos.index')->with('sucesso', 'Cargo excluido com sucesso!');
    }
}
