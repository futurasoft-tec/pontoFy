<?php

namespace App\Http\Controllers;

use App\Models\Assiduidade;
use App\Models\Colaboradore;
use App\Models\Escala;
use Illuminate\Http\Request;

class AssiduidadeController extends Controller
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

        // Buscar todas assiduidades do time autenticado, com colaborador e escala
        $assiduidades = Assiduidade::with(['colaborador', 'escala.horario'])
            ->where('team_id', $team->id)
            ->orderBy('data', 'desc')
            ->paginate(15);

        // Pegar todos colaboradores do team autenticado 
        $colaboradores = Colaboradore::where('team_id', $team->id)->get();

        // Pegar todas escalas do time autenticado
        $escalas = Escala::where('team_id', $team->id)->get();

        return view('company.assiduidade.index', compact('assiduidades', 'colaboradores', 'escalas'));
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
        // Verifica autenticação
        if (!auth()->check()) {
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }

        $user = auth()->user();
        $team = $user->currentTeam;

        if (!$team) {
            return redirect()->route('dashboard')->with('erro', 'Nenhum time selecionado.');
        }

        // Validação dos campos
        $validaDados = $request->validate([
            'colaborador_id'      => 'required|exists:colaboradores,id',
            'escala_id'           => 'nullable|exists:escalas,id',
            'data'                => 'required|date',
            'hora_entrada'        => 'nullable|date_format:H:i',
            'hora_saida'          => 'nullable|date_format:H:i',
            'hora_inicio_almoco'  => 'nullable|date_format:H:i',
            'hora_fim_almoco'     => 'nullable|date_format:H:i',
            'status'              => 'required|in:presente,falta,feriado,licenca,home_office',
            'observacoes'         => 'nullable|string|max:500',
        ]);

        // Criação do registro usando create
        $assiduidade = Assiduidade::create([
            'team_id'            => $team->id,
            'colaborador_id'     => $validaDados['colaborador_id'],
            'criado_por'         => $user->id,
            'escala_id'          => $validaDados['escala_id'] ?? null,
            'data'               => $validaDados['data'],
            'hora_entrada'       => $validaDados['hora_entrada'] ?? null,
            'hora_saida'         => $validaDados['hora_saida'] ?? null,
            'hora_inicio_almoco' => $validaDados['hora_inicio_almoco'] ?? null,
            'hora_fim_almoco'    => $validaDados['hora_fim_almoco'] ?? null,
            'status'             => $validaDados['status'],
            'observacoes'        => $validaDados['observacoes'] ?? null,
        ]);


        return redirect()->back()
            ->with('sucesso', 'Registo de assiduidade criado com sucesso!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Assiduidade $assiduidade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assiduidade $assiduidade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assiduidade $assiduidade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assiduidade $assiduidade)
    {
        //
    }
}
