<?php

namespace App\Http\Controllers;

use App\Models\PoliticaPrivacidade;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // Importa o DomPDF

class PoliticaPrivacidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function politicaPrivacidade()
    {
        
         // Passa os dados para a view PDF
        // $pdf = Pdf::loadView('policy');

        // Define o nome do ficheiro
        // $filename = 'Política de Privacidade' . $contrato->id . '.pdf';

        // Retorna o PDF para download ou visualização
        // return $pdf->stream($filename);
        // Se quiser forçar o download: return $pdf->download($filename);
        return view('policy');
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
    public function show(PoliticaPrivacidade $politicaPrivacidade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PoliticaPrivacidade $politicaPrivacidade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PoliticaPrivacidade $politicaPrivacidade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PoliticaPrivacidade $politicaPrivacidade)
    {
        //
    }
}
