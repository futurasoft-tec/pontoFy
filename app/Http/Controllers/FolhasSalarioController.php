<?php

namespace App\Http\Controllers;

use App\Models\FolhasSalario;
use Illuminate\Http\Request;

class FolhasSalarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        // VERIFICAR SE USUARIO ESTA AUTENTICADO
        if(auth()->check()){
            $user = auth()->user(); // Pegar usuario autenticado

            // Pegar o team do usuario autenticado
            $team = $user->currentTeam;
        } else {
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }

        // Pegar todas folhas de salarios do team autenticado
        $folhasSalarios = FolhasSalario::where('team_id', $team->id);
        
        return view('company.folha_salarios.lista', compact('folhasSalarios'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FolhasSalario $folhasSalario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FolhasSalario $folhasSalario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FolhasSalario $folhasSalario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FolhasSalario $folhasSalario)
    {
        //
    }
}
