<?php

namespace App\Http\Controllers;

use App\Models\Flyer;
use Illuminate\Http\Request;
// use Barryvdh\Snappy\Facades\SnappyPdf;

class FlyerController extends Controller
{
    public function index()
    {
        $flyers = Flyer::all();
        return view('layout.app', compact('flyers'));
    }

    // public function generatePDF(Request $request)
    // {
    //     // Obtener los datos del formulario
    //     $data = $request->all();

    //     // Renderizar la vista en HTML
    //     $html = view('flyers.template', compact('data'))->render();

    //     // Generar el PDF usando Snappy
    //     $pdf = SnappyPdf::loadHTML($html)->setPaper('a4')->setOption('margin-top', 10);

    //     // Devolver el PDF como respuesta para descarga
    //     return response()->streamDownload(
    //         fn() => print($pdf->output()),
    //         "flyer.pdf"
    //     );
    // }

    public function store(Request $request)
    {
        $flyer = Flyer::create($request->all());
        return response()->json($flyer, 201);
    }

    public function show($id)
    {
        return Flyer::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $flyer = Flyer::findOrFail($id);
        $flyer->update($request->all());
        return response()->json($flyer, 200);
    }

    public function destroy($id)
    {
        Flyer::destroy($id);
        return response()->json(null, 204);
    }
}
