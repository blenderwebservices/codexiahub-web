<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'recaptcha_token' => 'required',
        ]);

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'   => config('services.recaptcha.secret_key'),
            'response' => $request->recaptcha_token,
            'remoteip' => $request->ip(),
        ]);

        $result = $response->json();

        if (!$result['success'] || $result['score'] < 0.5) {
            return response()->json([
                'success' => false,
                'error'   => 'Error de verificación reCAPTCHA. Por favor, inténtalo de nuevo.',
            ], 422);
        }

        Lead::create([
            'email'      => $request->email,
            'ip_address' => $request->ip(),
            'source'     => 'diagnostico_express',
        ]);

        return response()->json([
            'success' => true,
            'message' => '¡Solicitud enviada! Nos pondremos en contacto contigo pronto.',
        ]);
    }
}
