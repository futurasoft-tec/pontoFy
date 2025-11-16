<?php

namespace App\Http\Controllers;

use App\Models\RubricaColaborador;
use Illuminate\Http\Request;

class RubricaColaboradorController extends Controller
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

        // Validação dos dados
        $validaDados = $request->validate([
            'colaborador_id'        => 'required|exists:colaboradores,id',
            'rubrica_id'            => 'required|exists:rubricas,id',
            'eh_automatica'         => 'required|boolean',
            'valor_customizado'     => 'nullable|numeric|min:0',
            'formula_customizada'   => 'nullable|string',
            'status'                => 'nullable|in:ativo,inativo',
        ]);

        // Verifica se já existe essa rubrica para o colaborador
        $rubricaExistente = RubricaColaborador::where('team_id', $team->id)
            ->where('colaborador_id', $validaDados['colaborador_id'])
            ->where('rubrica_id', $validaDados['rubrica_id'])
            ->first();

        if ($rubricaExistente) {
            return redirect()->back()->with('erro', 'Esta rubrica já foi atribuída a este colaborador.');
        }

        // Criar registro
        RubricaColaborador::create([
            'team_id'             => $team->id,
            'colaborador_id'      => $validaDados['colaborador_id'],
            'rubrica_id'          => $validaDados['rubrica_id'],
            'eh_automatica'       => $validaDados['eh_automatica'],
            'valor_customizado'   => $validaDados['valor_customizado'] ?? null,
            'formula_customizada' => $validaDados['formula_customizada'] ?? null,
            'status'              => $validaDados['status'] ?? 'ativo',
        ]);

        return redirect()->back()->with('sucesso', 'Rubrica adicionada com sucesso.');
    }


    /**
     * Display the specified resource.
     */
    public function show(RubricaColaborador $rubricaColaborador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RubricaColaborador $rubricaColaborador)
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

        // Validação
        $dadosValidados = $request->validate([
            'colaborador_id'      => 'required|exists:colaboradores,id',
            'rubrica_id'          => 'required|exists:rubricas,id',
            'eh_automatica'       => 'required|boolean',
            'valor_customizado'   => 'nullable|numeric|min:0',
            'formula_customizada' => 'nullable|string',
            'status'              => 'nullable|in:ativo,inativo',
        ]);

        // Buscar o registro
        $rubricaColaborador = RubricaColaborador::where('team_id', $team->id)
            ->where('id', $id)
            ->firstOrFail();

        // Verificar duplicidade
        $duplicado = RubricaColaborador::where('team_id', $team->id)
            ->where('colaborador_id', $dadosValidados['colaborador_id'])
            ->where('rubrica_id', $dadosValidados['rubrica_id'])
            ->where('id', '!=', $id) // Ignora o próprio registro
            ->exists();

        if ($duplicado) {
            return redirect()->back()->with('erro', 'Este colaborador já possui essa rubrica cadastrada.');
        }

        // Atualizar dados
        $rubricaColaborador->update([
            'rubrica_id'          => $dadosValidados['rubrica_id'],
            'eh_automatica'       => $dadosValidados['eh_automatica'],
            'valor_customizado'   => $dadosValidados['valor_customizado'],
            'formula_customizada' => $dadosValidados['formula_customizada'] ?? null,
            'status'              => $dadosValidados['status'] ?? 'ativo',
        ]);

        return redirect()
            ->back()
            ->with('sucesso', 'Rubrica atualizada com sucesso!');
    }



    // ==== ReaDesativar rubrica para colaborador ====
    public function desativar($id)
    {
        // Verifica autenticação
        if (!auth()->check()) {
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }

        $user = auth()->user();
        $rubricaColaborador = RubricaColaborador::findOrFail($id);

        // Verifica se pertence ao time do usuário logado
        if ($rubricaColaborador->team_id !== $user->currentTeam->id) {
            return redirect()->route('dashboard')->with('erro', 'Acesso não autorizado a esta rubrica.');
        }

        // Apenas rubricas ativas podem ser desativadas
        if ($rubricaColaborador->status !== 'ativo') {
            return back()->with('erro', 'Esta rubrica já está inativa.');
        }

        // Atualiza o status para inativo
        $rubricaColaborador->update([
            'status' => 'inativo',
        ]);

        return redirect()->back()->with('sucesso', 'Rubrica desativada com sucesso.');
    }


    // ======= REACTIVAR UMA RUBRICA DESACTIVADA PARA COLABORADOR ======
    public function reativar($id)
    {
        // Verifica autenticação
        if (!auth()->check()) {
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }

        $user = auth()->user();
        $rubricaColaborador = RubricaColaborador::findOrFail($id);

        // Verifica se pertence ao time do usuário logado
        if ($rubricaColaborador->team_id !== $user->currentTeam->id) {
            return redirect()->route('dashboard')->with('erro', 'Acesso não autorizado a esta rubrica.');
        }

        // Apenas rubricas inativas podem ser reativadas
        if ($rubricaColaborador->status !== 'inativo') {
            return back()->with('erro', 'Esta rubrica já está ativa.');
        }

        // Atualiza o status para ativo
        $rubricaColaborador->update([
            'status' => 'ativo',
        ]);

        return redirect()->back()->with('sucesso', 'Rubrica reativada com sucesso.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RubricaColaborador $rubricaColaborador)
    {
        //
    }
}
