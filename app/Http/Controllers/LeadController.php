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
            'recaptcha_token' => 'nullable',
        ]);

        $recaptchaSecret = config('services.recaptcha.secret_key');
        
        if ($recaptchaSecret && !app()->environment('local')) {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret'   => $recaptchaSecret,
                'response' => $request->recaptcha_token,
                'remoteip' => $request->ip(),
            ]);

            $result = $response->json();

            if (!$result['success'] || (isset($result['score']) && $result['score'] < 0.5)) {
                return response()->json([
                    'success' => false,
                    'error'   => 'Error de verificación reCAPTCHA. Por favor, inténtalo de nuevo.',
                ], 422);
            }
        }

        // Obtener ubicación a partir de la IP
        $ip = $request->ip();
        $location = 'Local / Desconocido';
        
        if ($ip !== '127.0.0.1' && $ip !== '::1') {
            try {
                $locResponse = Http::timeout(3)->get("http://ip-api.com/json/{$ip}");
                if ($locResponse->successful()) {
                    $data = $locResponse->json();
                    if (($data['status'] ?? '') === 'success') {
                        $location = ($data['city'] ?? 'N/A') . ', ' . ($data['country'] ?? 'N/A');
                    }
                }
            } catch (\Exception $e) {
                // Silently fail or log
            }
        }

        Lead::create([
            'email'      => $request->email,
            'ip_address' => $ip,
            'location'   => $location,
            'source'     => 'diagnostico_express',
        ]);

        return response()->json([
            'success' => true,
            'message' => '¡Solicitud enviada! Nos pondremos en contacto contigo pronto.',
        ]);
    }
}
