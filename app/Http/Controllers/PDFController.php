<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class PDFController extends Controller
{
    public function generarPDF(Request $request)
    {
        try {
            // Imprimir los datos para depuración
            Log::info("Datos recibidos para el PDF:", $request->all());

            $data = [
                'title' => $request->input('title', 'Título de la Invitación'),
                'date' => $request->input('date', 'Fecha no definida'),
                'time' => $request->input('time', 'Hora no definida'),
                'location' => $request->input('location', 'Ubicación no definida'),
                'organizer' => $request->input('organizer', 'Organizador no definido'),
                'headerColor' => $request->input('headerColor', '#000000'),
                'footerColor' => $request->input('footerColor', '#000000'),
                'base64Image' => $request->input('base64Image', '')
            ];

            // Verifica si la imagen en base64 es válida
            if (!empty($data['base64Image']) && !str_starts_with($data['base64Image'], 'data:image')) {
                Log::error("Formato de imagen incorrecto: " . substr($data['base64Image'], 0, 50));
                return response()->json(['error' => 'Formato de imagen no válido'], 400);
            }

            // Carga la vista y genera el PDF
            $pdf = Pdf::loadView('pdf.invitacion', $data);

            // Guardar el PDF temporalmente para revisarlo
            $pdfPath = storage_path('app/public/prueba.pdf');
            file_put_contents($pdfPath, $pdf->output());
            Log::info("PDF generado y guardado en: $pdfPath");

            return $pdf->download('flyer.pdf');
        } catch (\Exception $e) {
            Log::error("Error generando el PDF: " . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al generar el PDF'], 500);
        }
    }
}
