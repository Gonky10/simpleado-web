<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log; // Importar Log

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // Registrar los datos en el log para verificar si llegan
        Log::info('Datos recibidos:', $request->all());


        // Crear usuario en la base de datos
        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encripta la contraseña
        ]);

        if ($user) {
            Log::info('Usuario registrado correctamente:', $user->toArray());
            return redirect()->route('init')->with('success', 'Usuario registrado correctamente');
        } else {
            Log::error('Error al registrar usuario');
            return response()->json(['message' => 'Error al registrar usuario'], 500);
        }
    }
}
