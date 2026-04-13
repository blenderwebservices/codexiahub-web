<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function generate(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:roi,raci',
            'prompt' => 'required|string',
            'analysis' => 'required|string',
        ]);

        $isRoi = $request->type === 'roi';
        
        $data = [
            'type' => $request->type,
            'siteName' => 'CodexiaHub',
            'date' => now()->format('d/m/Y H:i:s'),
            'explanation' => $isRoi 
                ? 'Simulador de ROI de Automatización: Calcula el retorno de inversión al automatizar una tarea repetitiva.' 
                : 'Clarificador de Roles RACI: Define quién es Responsable, Aprobador, Consultado o Informado.',
            'prompt' => $request->prompt,
            'analysis' => $request->analysis,
        ];

        $pdf = Pdf::loadView('pdf.report', $data);
        
        $filename = 'CodexiaHub-' . strtoupper($request->type) . '-' . time() . '.pdf';
        
        return $pdf->download($filename);
    }
}
