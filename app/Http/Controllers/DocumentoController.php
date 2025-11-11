<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Colaboradore;
use Illuminate\Http\Request;

class DocumentoController extends Controller
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
        // VERIFICAR SE USUARIO ESTA AUTENTICADO
        if(auth()->check()){
            $user = auth()->user(); // Pegar usuario autenticado

            // Pegar o team do usuario autenticado
            $teamId = $user->currentTeam;
        } else {
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }


        // Validar dados 
        $validaDados = $request->validate([
            'colaborador_id'         => 'required|exists:colaboradores,id',
            'tipo_documento'         => 'required|string',
            'nome_arquivo'           => 'nullable|string',
            'caminho_arquivo'        => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'observacoes'            => 'nullable|string',
        ]);

        
        // Slavar fihceiro
        if ($request->hasFile('caminho_arquivo')) {
            // Armazena o arquivo e obtém o caminho
            $path = $request->file('caminho_arquivo')->store('Documentos', 'public');
            $validaDados['caminho_arquivo'] = $path;
        }

        // Salvar registro
        $documento = Documento::create($validaDados);
        return redirect()->back()->with('sucesso', 'Documento Adicionado com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Documento $documento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Documento $documento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        // VERIFICAR SE USUARIO ESTA AUTENTICADO
        if(auth()->check()){
            $user = auth()->user(); // Pegar usuario autenticado

            // Pegar o team do usuario autenticado
            $teamId = $user->currentTeam;
        } else {
            return redirect()->route('login')->with('erro', 'É necessário estar autenticado.');
        }

         // Validar dados 
        $validaDados = $request->validate([
            'colaborador_id'         => 'required|exists:colaboradores,id',
            'tipo_documento'         => 'required|string',
            'nome_arquivo'           => 'nullable|string',
            'caminho_arquivo'        => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'observacoes'            => 'nullable|string',
        ]);

        
        // Slavar fihceiro
        if ($request->hasFile('caminho_arquivo')) {
            // Armazena o arquivo e obtém o caminho
            $path = $request->file('caminho_arquivo')->store('Documentos', 'public');
            $validaDados['caminho_arquivo'] = $path;
        }

        // Pegar documento pelo ID
        $documento = Documento::findOrFail($id);
        // Actualizar registro

        $documento->update($validaDados);

        return redirect()->back()->with('sucesso', 'Documento actualizado com sucesso');
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

        // Pegar documento pelo ID
        $documento = Documento::findOrFail($id);

        // Excluir registro
        $documento->delete();

        return redirect()->back()->with('sucesso', 'Documento excluido com sucesso');
    }
}
