<?php

namespace App\Http\Controllers;

use App\Models\NiveisHierarquico;
use Illuminate\Http\Request;

class NiveisHierarquicoController extends Controller
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
        $niveisHierarquicos = NiveisHierarquico::where('team_id', $team->id)
                ->orderBy('id', 'desc')
                ->paginate(15);
        return view('company.hierarquia.index', compact('niveisHierarquicos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
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
            'nome'        => 'required|string|max:200',
            'codigo'      => 'required|string',
            'descricao'   => 'nullable|string|max:700',
            'prioridade'  => 'required|integer',
        ]);
        
        $nivelHierarquico = NiveisHierarquico::create($validaDados);
        return redirect()->back()->with('sucesso', 'Nível criado com sucesso');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(NiveisHierarquico $niveisHierarquico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NiveisHierarquico $niveisHierarquico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Verifica se o usuário está autenticado
        if (auth()->check()) {
            $user = auth()->user(); // Usuário autenticado
            $teamId = $user->currentTeam; // Equipa atual
        } else {
            // Caso não esteja autenticado, redireciona para o login
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }

        // Validação dos dados recebidos
        $validaDados = $request->validate([
            'team_id'     => 'required|exists:teams,id',
            'criado_por'  => 'required|exists:users,id',
            'nome'        => 'required|string|max:200',
            'codigo'      => 'required|string',
            'descricao'   => 'nullable|string|max:700',
            'prioridade'  => 'required|integer',
        ]);

        // Localiza o registro do nível hierárquico pelo ID
        $nivelHierarquico = NiveisHierarquico::findOrFail($id);

        // Garante que o registro pertence ao mesmo team do usuário autenticado
        if ($nivelHierarquico->team_id !== $teamId->id) {
            return redirect()->route('dashboard')->with('erro', 'Nível Hierárquico não encontrado.');
        }

        // Atualiza o registro com os dados validados
        $nivelHierarquico->update($validaDados);

        // Retorna com mensagem de sucesso
        return redirect()->back()->with('sucesso', 'Nível Hierárquico atualizado com sucesso.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Verifica se o usuário está autenticado
        if (auth()->check()) {
            $user = auth()->user(); // Usuário autenticado
            $teamId = $user->currentTeam; // Equipa atual
        } else {
            // Caso não esteja autenticado, redireciona para o login
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }

        // Pegar o nivel pelo ID
        $nivelHierarquico = NiveisHierarquico::findOrFail($id);

        // Verificar se o nivel pertence ao team autenticado
        
        // Garante que o registro pertence ao mesmo team do usuário autenticado
        if ($nivelHierarquico->team_id !== $teamId->id) {
            return redirect()->route('dashboard')->with('erro', 'Nível Hierárquico não encontrado.');
        }

        $nivelHierarquico->delete();
        return redirect()->route('niveis.index')->with('sucesso', 'Nivel excluido com sucesso');
    }



}
