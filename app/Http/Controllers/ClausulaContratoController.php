<?php

namespace App\Http\Controllers;

use App\Models\ClausulaContrato;
use App\Models\Clausula;
use App\Models\Contrato;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClausulaContratoController extends Controller
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
     * Armazena uma nova cláusula vinculada a um contrato
     */
    public function store(Request $request)
{
    $user = auth()->user();
    $team = $user->currentTeam;

    if (!$team) {
        return redirect()->route('dashboard')->with('erro', 'Nenhum time selecionado.');
    }

    // Validação: recebemos um array de clausulas (clausula_id[])
    $request->validate([
        'contrato_id'      => ['required', 'exists:contratos,id'],
        'clausula_id'      => ['required', 'array', 'min:1'],
        'clausula_id.*'    => [
            'required',
            'integer',
            'exists:clausulas,id',

            // Garante que não exista já ligação desta clausula com o mesmo contrato
            Rule::unique('clausula_contratos', 'clausula_id')->where(function ($query) use ($request) {
                return $query->where('contrato_id', $request->contrato_id);
            }),
        ],

        // Campos opcionais de personalização; se quiseres enviar por-clausula, precisa mudar a estrutura
        'conteudo_personalizado' => ['nullable', 'string'],
        'ordem'                  => ['nullable', 'integer'],
    ]);

    

    $contrato = Contrato::findOrFail($request->contrato_id);

    // Carregar cláusulas selecionadas
    $clausulaIds = $request->input('clausula_id', []);

    // Verificar se alguma cláusula não pertence ao mesmo team (exceto globais com team_id = null)
    $clausulas = Clausula::whereIn('id', $clausulaIds)->get();

    $invalid = $clausulas->filter(function ($c) use ($contrato) {
        return $c->team_id && $c->team_id !== $contrato->team_id;
    });

    if ($invalid->isNotEmpty()) {
        $lista = $invalid->pluck('id')->implode(', ');
        return response()->json([
            'message' => "As seguintes cláusulas não pertencem à mesma empresa do contrato: {$lista}."
        ], 422);
    }

    // Definir ordem inicial (continua depois do maior existente)
    $ordemInicial = (int) (ClausulaContrato::where('contrato_id', $contrato->id)->max('ordem') ?? 0);

    $criados = [];
    foreach ($clausulaIds as $idx => $clausulaId) {
        // Se o utilizador passou 'ordem' no formulário, usamos; senão incrementamos
        // Nota: se quiser ordens individuais por checkbox, o formulário deve enviar ordens separadas (ex: ordem[<id>])
        $ordem = $request->filled('ordem') ? (int) $request->input('ordem') : ++$ordemInicial;

        // Conteúdo personalizado global (se o utilizador enviou), caso contrário null
        $conteudoPersonalizado = $request->input('conteudo_personalizado', null);

        // Cria ou retorna o existente (evita duplicação)
        $cc = ClausulaContrato::firstOrCreate(
            [
                'contrato_id' => $contrato->id,
                'clausula_id' => $clausulaId,
            ],
            [
                'conteudo_personalizado' => $conteudoPersonalizado,
                'ordem'                  => $ordem,
            ]
        );

        $criados[] = $cc;
    }

    return redirect()
        ->route('contrato.rascunho', $contrato->id)
        ->with('sucesso', count($criados) . ' cláusula(s) adicionada(s) ao contrato com sucesso.');
}


    /**
     * Display the specified resource.
     */
    public function show(ClausulaContrato $clausulaContrato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClausulaContrato $clausulaContrato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $contratoId, $clausulaContratoId)
{
    $validated = $request->validate([
        'conteudo_personalizado' => 'required|string',
    ]);

    $clausulaContrato = ClausulaContrato::where('id', $clausulaContratoId)
                                        ->where('contrato_id', $contratoId)
                                        ->firstOrFail();

    $clausulaContrato->update([
        'conteudo_personalizado' => $validated['conteudo_personalizado'],
        'alterado_por' => auth()->user()->id,
        'alterado_em' => now(),
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Cláusula atualizada com sucesso!',
    ]);
}

    /**
     * Remove the specified resource from storage.
     */
    
    public function destroyMultiple(Request $request, $contratoId)
    {
        $ids = $request->input('clausulas', []);

        if (empty($ids)) {
            return back()->with('erro', 'Nenhuma cláusula selecionada.');
        }

        ClausulaContrato::where('contrato_id', $contratoId)
            ->whereIn('clausula_id', $ids)
            ->delete();

        return back()->with('sucesso', count($ids).' cláusula(s) removida(s) com sucesso!');
    }

    // public function destroy($contratoId, $clausulaId)
    // {
    //     $contrato = Contrato::findOrFail($contratoId);

    //     // Verifica se a cláusula está associada a este contrato
    //     $existe = ClausulaContrato::where('contrato_id', $contrato->id)
    //         ->where('clausula_id', $clausulaId)
    //         ->first();

    //     if (!$existe) {
    //         return redirect()
    //             ->back()
    //             ->with('erro', 'A cláusula não está associada a este contrato.');
    //     }

    //     // Remove o vínculo
    //     $existe->delete();

    //     return redirect()
    //         ->back()
    //         ->with('sucesso', 'Cláusula removida do contrato com sucesso.');
    // }

}
