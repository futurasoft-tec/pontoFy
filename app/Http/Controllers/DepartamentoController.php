<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepartamentoController extends Controller
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
        $departamentos = Departamento::where('team_id', $team->id)
                ->orderBy('id', 'desc')
                ->paginate(15);

        return view('company.departamento.index', compact('departamentos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // VERIFICAR SE USUARIO ESTA AUTENTICADO
        if(auth()->check()){
            $user = auth()->user(); // Pegar usuario autenticado

            // Pegar o team do usuario autenticado
            $teamId = $user->currentTeam;
        }else{
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }


        return view('company.departamento.create', compact('teamId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // VERIFICAR SE USUARIO ESTA AUTENTICADO
        if(auth()->check()){
            $user = auth()->user(); // Pegar usuario autenticado

            // Pegar o team do usuario autenticado
            $teamId = $user->currentTeam;
        }else{
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }


        // VLIDACAO DOS DADOS
        $validaDados = $request->validate([
            'team_id'     => 'required|exists:teams,id',
            'criado_por'  => 'required|exists:users,id',
            'nome'        => 'required|string|max:200',
            'descricao'   => 'nullable|string|max:400',
        ]);

        // dd($validaDados);
        $createDepartamento = Departamento::create($validaDados);
        
        return redirect()->back()->with('sucesso', 'Departamento criado com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $teamId, $id)
    {
        // VERIFICAR SE USUARIO ESTA AUTENTICADO
        if(auth()->check()){
            $user = auth()->user(); // Pegar usuario autenticado

            // Pegar o team do usuario autenticado
            $teamId = $user->currentTeam;
        }else{
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }

        // Pegar o departamento pelo ID
        $departamento = Departamento::with('colaboradores')->findOrFail($id);

        // Verificar se departamento perence ao team autenticado
        if($departamento->team_id !== $teamId->id){
            return redirect()-route('dashboard')->with('erro', 'Departamento não encontrado.');
        }


        return view('company.departamento.detalhe', compact('departamento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $teamId, $id)
    {
        // VERIFICAR SE USUARIO ESTA AUTENTICADO
        if(auth()->check()){
            $user = auth()->user(); // Pegar usuario autenticado

            // Pegar o team do usuario autenticado
            $teamId = $user->currentTeam;
        } else {
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }

        // Pegar o departamento pelo ID
        $departamento = Departamento::findOrFail($id);

        // Verificar se o departamento pertence ao team do usuario autenticado
        if ($departamento->team_id !== $teamId->id) {
            return redirect()->route('dashboard')->with('erro', 'Departamento não encontrado.');
        }

        return view('company.departamento.edit', compact('departamento'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $teamId, $id)
    {
        // VERIFICAR SE USUARIO ESTA AUTENTICADO
        if(auth()->check()){
            $user = auth()->user(); // Pegar usuario autenticado

            // Pegar o team do usuario autenticado
            $teamId = $user->currentTeam;
        } else {
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }

        // Validar os dados
        $validaDados = $request->validate([
            'team_id'     => 'required|exists:teams,id',
            'criado_por'  => 'required|exists:users,id',
            'nome'        => 'required|string|max:200',
            'status'        => 'required|string',
            'descricao'   => 'nullable|string|max:400',
        ]);

        // Pegar o departamento pelo ID
        $departamento = Departamento::findOrFail($id);

        // Verificar se o cargo pertence ao team autenticado
        if ($departamento->team_id !== $team->id) {
            return redirect()->route('dashboard')->with('erro', 'Departamento não encontrado.');
        } 
        
        $departamento -> update($validaDados);
        return redirect()->back()->with('sucesso', 'Departamento editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        // VERIFICAR SE USUARIO ESTA AUTENTICADO
        if(auth()->check()){
            $user = auth()->user(); // Pegar usuario autenticado

            // Pegar o team do usuario autenticado
            $teamId = $user->currentTeam;
        } else {
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }


        // Pegar departamento pelo ID
        $departamento = Departamento::findOrFail($id);


        // Verificar se o departamento te registro associado
        $colaboradorAssociado = DB::table('colaboradores')
                ->where('departamento_id', $id)
                ->exists();

        //Redireccionar utilizador com mensagem de erro
        if($colaboradorAssociado){
            return redirect()->back()->with('erro', 'Departamento com colaboradores asocciados');
        }

        $departamento->delete();
        return redirect()->route('departamentos.index')->with('sucesso', 'Departamento excluido com sucesso');
        
    }
}
