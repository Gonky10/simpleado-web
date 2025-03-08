<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validar las credenciales

        Log::info('Datos recibidos:', $request->all());

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            // Regenerar sesión para mayor seguridad
            $request->session()->regenerate();

            Log::info('Usuario autenticado:', ['user_id' => Auth::id(), 'email' => $request->email]);

            // Redirigir al usuario a `/flyers`
            return redirect()->route('flyers')->with('success', 'Bienvenido a Simpleado');
        }
        Log::error('Error de autenticación:', ['email' => $request->email]);

        // Redirigir con un mensaje de error
        return back()->with('error', 'Credenciales incorrectas. Inténtalo de nuevo.');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Cierra la sesión

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Sesión cerrada correctamente');
    }
}
