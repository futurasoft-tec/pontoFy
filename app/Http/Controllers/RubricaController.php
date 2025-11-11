<?php

namespace App\Http\Controllers;

use App\Models\Rubrica;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class RubricaController extends Controller
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
        $rubricas = Rubrica::where('team_id', $team->id)
                ->orderBy('id', 'desc')
                ->paginate(15);
        return view('company.rubricas.index', compact('rubricas'));
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
        
        $validated = $request->validate([
            'codigo' => [
                'required',
                'string',
                'max:50',
                Rule::unique('rubricas')->where(function ($query) use ($request) {
                    return $query->where('team_id', auth()->user()->currentTeam->id);
                }),
            ],
            'nome'         => 'required|string|max:150',
            'descricao'    => 'nullable|string',
            'tipo'         => 'required|in:vencimento,desconto',
            'base_calculo' => 'required|in:fixo,percentual,formula',
            'valor'        => 'nullable|numeric|min:0',
            'formula'      => 'nullable|string',
            'is_tributavel'=> 'nullable|boolean',
        ]);


        // Ajuste do valor/fórmula
        if ($validated['base_calculo'] === 'formula') {
            $validated['valor'] = null;
            $validated['formula'] = $validated['formula'] ?? null;
        } else {
            $validated['formula'] = null;
        }

        // Preencher team_id e is_tributavel padrão
        $validated['team_id'] = auth()->user()->currentTeam->id;
        $validated['is_tributavel'] = $validated['is_tributavel'] ?? true;

        // Criar rubrica
        $rubrica = Rubrica::create($validated);

        return redirect()->route('rubricas.index')
            ->with('sucesso', 'Rubrica criada com sucesso!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Rubrica $rubrica)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rubrica $rubrica)
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

        // Pegar rubrica pelo ID
        $rubrica = Rubrica::findOrFail($id);

        $validaDados = $request->validate([
            'codigo'       => 'required|string|max:50|unique:rubricas,codigo,' . $rubrica->id,
            'nome'         => 'required|string|max:150',
            'descricao'    => 'nullable|string',
            'tipo'         => 'required|in:vencimento,desconto',
            'base_calculo' => 'required|in:fixo,percentual,formula',
            'valor'        => 'nullable|numeric|min:0',
            'formula'      => 'nullable|string',
            'is_tributavel'=> 'nullable|boolean',
        ]);

        // Ajuste do valor/fórmula
        if ($validaDados['base_calculo'] === 'formula') {
            $validaDados['valor'] = null;
            $validaDados['formula'] = $validaDados['formula'] ?? null;
        } else {
            $validaDados['formula'] = null;
        }

        // Garantir team_id e is_tributavel
        $validaDados['team_id'] = $team->id;
        $validaDados['is_tributavel'] = $validaDados['is_tributavel'] ?? true;

        // Atualizar rubrica
        $rubrica->update($validaDados);

        return redirect()->route('rubricas.index')
            ->with('sucesso', 'Rubrica atualizada com sucesso!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rubrica $rubrica)
    {
        //
    }
}
