<?php

namespace App\Http\Controllers;

use App\Models\PeriodosProcessamento;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PeriodosProcessamentoController extends Controller
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

        // Pegar todos niveis de Hierarquia do team autenticado
        $periodos = PeriodosProcessamento::where('team_id', $team->id)
                ->orderBy('ano', 'desc')
                ->paginate(15);
        
        return view('company.configuracoes.periodos-processamentos.index', compact('periodos'));
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

        // Validação básica
        $validated = $request->validate([
            'mes'  => 'required|integer|min:1|max:12',
            'ano'  => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'observacoes' => 'nullable|string|max:500',
        ]);

        $mes = $validated['mes'];
        $ano = $validated['ano'];

        // Verifica se já existe um período para o mesmo mês/ano
        $existe = PeriodosProcessamento::where('team_id', $team->id)
            ->where('mes', $mes)
            ->where('ano', $ano)
            ->exists();

        if ($existe) {
            return redirect()->back()->with('erro', 'Já existe um período de processamento para este mês e ano.');
        }

        // Calcula datas automáticas
        $data_inicio = Carbon::createFromDate($ano, $mes, 1);
        $data_fim = $data_inicio->copy()->endOfMonth();

        // Cria o período
        $periodo = PeriodosProcessamento::create([
            'team_id'     => $team->id,
            'mes'         => $mes,
            'ano'         => $ano,
            'data_inicio' => $data_inicio,
            'data_fim'    => $data_fim,
            'status'      => 'aberto',
            'observacoes' => $validated['observacoes'] ?? null,
            'criado_por'  => $user->id,
        ]);

        return redirect()->route('periodos.index')->with('sucesso', 'Período de processamento criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PeriodosProcessamento $periodosProcessamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PeriodosProcessamento $periodosProcessamento)
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

        // Busca o período
        $periodo = PeriodosProcessamento::where('team_id', $team->id)->findOrFail($id);

         // Verificar se o perido pertence ao team autenticado
        if ($periodo->team_id !== $team->id) {
            return redirect()->route('dashboard')->with('erro', 'Periodo não encontrado.');
        }

         // Verifica se está aberto
        if ($periodo->status !== 'aberto') {
            return redirect()->back()->with('erro', 'Não é possível editar um período fechado ou processado.');
        }

        // Validação
        $validated = $request->validate([
            'mes'  => 'required|integer|min:1|max:12',
            'ano'  => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'observacoes' => 'nullable|string|max:500',
        ]);

        $mes = $validated['mes'];
        $ano = $validated['ano'];

        // Verifica se existe outro período igual (exceto este)
        $existe = PeriodosProcessamento::where('team_id', $team->id)
            ->where('mes', $mes)
            ->where('ano', $ano)
            ->where('id', '!=', $periodo->id)
            ->exists();

        if ($existe) {
            return redirect()->back()->with('erro', 'Já existe um período de processamento para este mês e ano.');
        }

        // Recalcula datas
        $data_inicio = Carbon::createFromDate($ano, $mes, 1);
        $data_fim = $data_inicio->copy()->endOfMonth();

        // Atualiza
        $periodo->update([
            'mes'         => $mes,
            'ano'         => $ano,
            'data_inicio' => $data_inicio,
            'data_fim'    => $data_fim,
            'observacoes' => $validated['observacoes'] ?? null,
            'atualizado_por' => $user->id,
        ]);

        return redirect()->route('periodos.index')->with('sucesso', 'Período atualizado com sucesso.');
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

        
        $periodo = PeriodosProcessamento::findOrFail($id);

        // Verificar se o periodo pertence ao team autenticado
        if ($periodo->team_id !== $team->id) {
            return redirect()->route('dashboard')->with('erro', 'Periodo não encontrado.');
        }

        // Verifica se está aberto
        if ($periodo->status !== 'aberto') {
            return redirect()->back()->with('erro', 'Não é possível eliminar um período fechado ou processado.');
        }

        // Verifica se há dependências (ex: lançamentos)
        $folhasSalarios = $periodo->folhas()->exists();
        if ($folhasSalarios) {
            return redirect()->back()->with('erro', 
                'Não é possível eliminar este período, pois já existem folhas de salários associadas. 
                Caso precise reprocessar, feche este período e crie um novo.'
            );
        }

        // Elimina se seguro
        $periodo->delete();

        return redirect()->back()->with('sucesso', 'Período eliminado com sucesso.');
    }

   




}
