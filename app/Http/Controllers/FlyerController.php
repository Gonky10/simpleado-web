<?php

namespace App\Http\Controllers;

use App\Models\Flyer;
use Illuminate\Http\Request;

class FlyerController extends Controller
{
    public function index()
    {
        $flyers = Flyer::all();
        return view('flyers.index', compact('flyers'));
    }

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
