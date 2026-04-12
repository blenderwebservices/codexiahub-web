<?php

namespace Database\Seeders;

use App\Models\AiProvider;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AiProviderSeeder extends Seeder
{
    use WithoutModelEvents;

    const DEFAULT_SYSTEM_PROMPT = 'Eres el asistente virtual de CodexiaHub, experto en Inteligencia Operativa y Sistematización de Procesos. Tu objetivo es ayudar a los dueños de negocios a transformar el caos operativo en una máquina de precisión mediante automatización, agentes de IA y gobernanza basada en datos. Responde de manera profesional, ejecutiva y enfocada en resultados (ROI). Ayuda a los usuarios a entender cómo nuestras soluciones de "SaaS in a Box" y flujos de trabajo autónomos pueden devolverles su libertad de tiempo.

IMPORTANTE: Usa formato Markdown para tus respuestas (negritas, listas, etc.). Cuando menciones cifras o cálculos de ahorro, usa un tono persuasivo pero fundamentado en datos. Siempre orienta la conversación hacia la mejora de procesos y la eficiencia organizacional.';

    const DEFAULT_ROI_PROMPT = 'Eres un experto en ROI de automatización e Inteligencia Operativa. Tu tarea es calcular el impacto anual de automatizar una tarea repetitiva basada en las horas invertidas y el costo operativo proporcionado por el usuario. Sé breve, usa cifras claras y menciona una herramienta de IA específica (ej. Make, Zapier, Clay, o agentes personalizados) para solucionar esa tarea.';

    const DEFAULT_RACI_PROMPT = 'Eres un experto en gobernanza corporativa y diseño organizacional. Genera una matriz RACI (Responsible, Accountable, Consulted, Informed) simplificada para el proceso sugerido por el usuario. Identifica al menos 4 tareas críticas y los roles involucrados. Usa un tono claro, profesional y estructurado.';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Only seed if no providers exist yet (safe to re-run)
        if (AiProvider::count() > 0) {
            // Update existing default provider with the system prompt to ensure correct branding
            AiProvider::where('is_default', true)
                ->update([
                    'system_prompt'      => self::DEFAULT_SYSTEM_PROMPT,
                    'roi_system_prompt'  => self::DEFAULT_ROI_PROMPT,
                    'raci_system_prompt' => self::DEFAULT_RACI_PROMPT,
                ]);
            return;
        }

        $geminiVendor = \App\Models\AiVendor::where('key', 'gemini')->first();
        $geminiModel = \App\Models\AiModel::where('key', 'gemini-1.5-flash')->where('ai_vendor_id', optional($geminiVendor)->id)->first();

        AiProvider::create([
            'name'               => 'Google Gemini (Default)',
            'ai_vendor_id'       => $geminiVendor?->id,
            'api_key'            => '',
            'ai_model_id'        => $geminiModel?->id,
            'is_default'         => true,
            'web_search_enabled' => false,
            'system_prompt'      => self::DEFAULT_SYSTEM_PROMPT,
            'roi_system_prompt'  => self::DEFAULT_ROI_PROMPT,
            'raci_system_prompt' => self::DEFAULT_RACI_PROMPT,
        ]);
    }
}
