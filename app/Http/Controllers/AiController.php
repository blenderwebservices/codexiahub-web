<?php

namespace App\Http\Controllers;

use App\Ai\Agents\ChatAgent;
use Illuminate\Http\Request;
use Laravel\Ai\Messages\Message;

class AiController extends Controller
{
    /**
     * Process an AI request using the default provider.
     */
    public function process(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string',
            'system_instruction' => 'nullable|string',
            'tool' => 'nullable|string|in:roi,raci',
        ]);

        $prompt = $request->input('prompt');
        $systemInstruction = $request->input('system_instruction');
        $toolType = $request->input('tool');

        try {
            $agent = new ChatAgent();
            $dbProvider = \App\Models\AiProvider::where('is_default', true)->first();

            // Determine the system instruction to use
            if ($toolType === 'roi' && $dbProvider?->roi_system_prompt) {
                $systemInstruction = $dbProvider->roi_system_prompt;
            } elseif ($toolType === 'raci' && $dbProvider?->raci_system_prompt) {
                $systemInstruction = $dbProvider->raci_system_prompt;
            }

            // Prepended system instructions if provided
            $finalPrompt = $systemInstruction 
                ? "INSTRUCCIONES DEL SISTEMA:\n{$systemInstruction}\n\nMENSAJE DEL USUARIO:\n{$prompt}"
                : $prompt;

            \Illuminate\Support\Facades\Log::info("AI Process [{$toolType}]: " . substr($prompt, 0, 100) . "...");

            $response = $agent->prompt($finalPrompt);

            return response()->json([
                'success' => true,
                'result' => (string) $response,
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("AI Error: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Hubo un error al procesar la solicitud con la IA.',
            ], 500);
        }
    }
}
