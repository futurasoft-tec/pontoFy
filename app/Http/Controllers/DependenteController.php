<?php

namespace App\Http\Controllers;

use App\Models\Dependente;
use Illuminate\Http\Request;

class DependenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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


        // validar dados
        $validaDados = $request->validate([
            'colaborador_id'        => 'required|exists:colaboradores,id',
            'nome'                  => 'required|string|max:255',
            'sexo'                  => 'required|string|max:50',
            'parentesco'            => 'required|string|max:50',
            'data_nascimento'      => 'required|date',
        ]);

        // Salvar dados
        $dependentes = Dependente::create($validaDados);
        return redirect()->back()->with('sucesso', 'Dependente Adicionando com Sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dependente $dependente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dependente $dependente)
    {
        //
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


        // validar dados
        $validaDados = $request->validate([
            'colaborador_id'        => 'required|exists:colaboradores,id',
            'nome'                  => 'required|string|max:255',
            'sexo'                  => 'required|string|max:50',
            'parentesco'            => 'required|string|max:50',
            'data_nascimento'      => 'required|date',
        ]);

        // Pegar Dependente pelo ID
        $dependente = Dependente::findOrFail($id);

        // Atualizar registro
        $dependente->update($validaDados);
        
        
        return redirect()->back()->with('sucesso', 'Dependente Actualizado com sucesso');
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

        // Pegar Dependente pelo ID
        $dependente = Dependente::findOrFail($id);

        $dependente->delete();

        return redirect()->back()->with('sucesso', 'Dependente foi excluido com sucesso');
    }
}
