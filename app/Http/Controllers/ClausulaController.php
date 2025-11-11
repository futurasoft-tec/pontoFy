<?php

namespace App\Http\Controllers;

use App\Models\Clausula;
use Illuminate\Http\Request;

class ClausulaController extends Controller
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
        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team) {
            return redirect()->route('dashboard')->with('erro', 'Nenhum time selecionado.');
        }

        // Validação dos dados
        $validated = $request->validate([
            'titulo'      => 'required|string|max:255',
            'tipo'        => 'required|string',
            'conteudo'    => 'required|string',
        ]);

        // dd($validated);
        // Criação da cláusula personalizada
        $clausula = Clausula::create([
            'team_id'     => $team->id,
            'titulo'      => $validated['titulo'],
            'tipo'        => $validated['tipo'],
            'conteudo'    => $validated['conteudo'],
            'criado_por'  => $user->id,
            'criado_em'   => now(),
        ]);

        return redirect()
            ->back()
            ->with('sucesso', 'Cláusula criada com sucesso e adicionada à sua biblioteca!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Clausula $clausula)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clausula $clausula)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clausula $clausula)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team) {
            return redirect()->route('dashboard')->with('erro', 'Nenhum time selecionado.');
        }

        // Encontrar a cláusula pelo ID
        $clausula = Clausula::findOrFail($id);

        // Verificar se pertence ao time do usuário
        if ($clausula->team_id !== $team->id) {
            return redirect()->route('dashboard')->with('erro', 'Cláusula não pertence à sua empresa.');
        }

        // Eliminar
        $clausula->delete();

        return redirect()
            ->back()
            ->with('sucesso', 'Cláusula eliminada com sucesso da sua biblioteca!');
    }


}
