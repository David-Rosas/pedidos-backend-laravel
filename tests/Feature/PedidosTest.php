<?php
namespace Tests\Feature;

use Tests\TestCase;
use Database\Factories\CuentaFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PedidosTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testCrearPedidos()
    {
        $cuenta = CuentaFactory::new()->create();

        // crear pedido asociado a la cuenta.
        $response = $this->postJson('/api/pedidos', [
            'cuenta_id' => $cuenta->id,
            'producto' => 'Nombre del Producto',
            'cantidad' => 5,
            'valor' => 10.99,
            'total' => 54.95,
        ]);

        $response->assertStatus(201);
    }
}