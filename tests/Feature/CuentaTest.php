<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CuentaTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testCrearCuenta()
    {
        $response = $this->postJson('/api/cuentas', [
            'nombre' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'telefono' => $this->faker->phoneNumber,
        ]);

        $response->assertStatus(201); 
    }
}
