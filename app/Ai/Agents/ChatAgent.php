<?php

namespace App\Ai\Agents;

use App\Models\AiProvider;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Messages\Message;
use Laravel\Ai\Promptable;
use Laravel\Ai\Providers\Tools\WebSearch;
use Stringable;

class ChatAgent implements Agent, Conversational, HasTools
{
    use Promptable;

    public function provider(): string
    {
        $dbProvider = AiProvider::where('is_default', true)->first();
        
        if ($dbProvider?->vendor?->key) {
            config(["ai.providers.{$dbProvider->vendor->key}.key" => $dbProvider->api_key]);
            if ($dbProvider->base_url) {
                config(["ai.providers.{$dbProvider->vendor->key}.url" => $dbProvider->base_url]);
            }
            return $dbProvider->vendor->key;
        }

        return config('ai.default');
    }

    public function model(): ?string
    {
        $dbProvider = AiProvider::where('is_default', true)->first();

        if ($dbProvider?->aiModel?->key) {
            return $dbProvider->aiModel->key;
        }

        return config("ai.providers.{$this->provider()}.model");
    }

    protected array $history = [];

    /**
     * Set the conversation history.
     */
    public function withHistory(array $history): self
    {
        $this->history = $history;

        return $this;
    }

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        // Cargar desde la BD (proveedor por defecto)
        $dbProvider = AiProvider::where('is_default', true)->first();

        $instructions = ($dbProvider?->system_prompt) ?: 'Eres el asistente virtual de CodexiaHub, experto en Inteligencia Operativa y Sistematización de Procesos. Ayuda a los usuarios a entender cómo transformar el caos operativo en eficiencia mediante automatización y agentes de IA. Responde de manera profesional, ejecutiva y enfocada en el ROI.
 
 IMPORTANTE: Usa formato Markdown para tus respuestas.';

        if ($dbProvider?->web_search_enabled) {
            $instructions .= ' Tienes la capacidad de realizar búsquedas en internet para verificar información actualizada.';
        }

        return $instructions;
    }

    /**
     * Get the list of messages comprising the conversation so far.
     *
     * @return Message[]
     */
    public function messages(): iterable
    {
        return $this->history;
    }

    /**
     * Get the tools available to the agent.
     *
     * @return Tool[]
     */
    public function tools(): iterable
    {
        $dbProvider = AiProvider::where('is_default', true)->first();

        if ($dbProvider?->web_search_enabled) {
            return [
                new WebSearch,
            ];
        }

        return [];
    }
}
