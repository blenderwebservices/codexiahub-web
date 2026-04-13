<?php

namespace Tests\Feature;

use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class LeadRegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_bypasses_recaptcha_in_development_if_secret_is_missing()
    {
        // Aseguramos que el secreto de recaptcha sea null
        config(['services.recaptcha.secret_key' => null]);

        $response = $this->postJson('/leads', [
            'email' => 'dev_test@example.com',
            'recaptcha_token' => null, // Opcional en dev
        ]);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('leads', [
            'email' => 'dev_test@example.com',
            'source' => 'diagnostico_express',
        ]);
    }

    /** @test */
    public function it_requires_and_validates_recaptcha_in_production_success()
    {
        // Simulamos entorno con secreto
        config(['services.recaptcha.secret_key' => 'mock_secret_key']);

        // Mock de la respuesta de Google
        Http::fake([
            'https://www.google.com/recaptcha/api/siteverify' => Http::response([
                'success' => true,
                'score' => 0.9,
            ], 200),
            'http://ip-api.com/*' => Http::response([
                'status' => 'success',
                'city' => 'New York',
                'country' => 'USA',
            ], 200),
        ]);

        $response = $this->withServerVariables(['REMOTE_ADDR' => '1.1.1.1'])
            ->postJson('/leads', [
                'email' => 'prod_success@example.com',
                'recaptcha_token' => 'valid_token',
            ]);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('leads', [
            'email' => 'prod_success@example.com',
            'location' => 'New York, USA',
        ]);
    }

    /** @test */
    public function it_fails_in_production_with_invalid_recaptcha()
    {
        // Simulamos entorno con secreto
        config(['services.recaptcha.secret_key' => 'mock_secret_key']);

        // Mock de la respuesta de Google (Falla)
        Http::fake([
            'https://www.google.com/recaptcha/api/siteverify' => Http::response([
                'success' => false,
                'error-codes' => ['invalid-input-response'],
            ], 200),
        ]);

        $response = $this->postJson('/leads', [
            'email' => 'prod_fail@example.com',
            'recaptcha_token' => 'invalid_token',
        ]);

        $response->assertStatus(422)
            ->assertJson(['success' => false]);

        $this->assertDatabaseMissing('leads', [
            'email' => 'prod_fail@example.com',
        ]);
    }

    /** @test */
    public function it_captures_location_from_external_ip()
    {
        // Saltamos recaptcha para enfocarnos en location
        config(['services.recaptcha.secret_key' => null]);

        // Mock de ip-api.com
        Http::fake([
            'http://ip-api.com/*' => Http::response([
                'status' => 'success',
                'city' => 'Madrid',
                'country' => 'Spain',
            ], 200),
        ]);

        // Simulamos una IP externa (no local)
        $response = $this->withServerVariables(['REMOTE_ADDR' => '1.1.1.1'])
            ->postJson('/leads', [
                'email' => 'location_test@example.com',
            ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('leads', [
            'email' => 'location_test@example.com',
            'location' => 'Madrid, Spain',
        ]);
    }
}
