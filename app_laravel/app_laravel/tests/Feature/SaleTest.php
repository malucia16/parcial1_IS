<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Sale;


class SaleTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;
    public function test_can_create_sale()
    {
        $data = [
            'name' => 'perro caliente',
            'quantity' => 15,
            'price' => 15000,
            'taxes' => 1,5,
            'total' => 30000,
        ];
        $response = $this->post('api/sales', $data);
        $response -> assertStatus(201);
        $this->assertDatabaseHas('sales', [
            'name' => 'perro caliente',
            'quantity' => 2,
            'price' => 15000,
            'taxes' => 1,5,
            'total' => 30000,,
        ]);
    }

    public function test_can_show_sale()
    {
        $sale = Sale::create([
            'name' => 'hamburgesa',
            'quantity' => 1,
            'price' => 18000,
            'taxes' => 1,5,
            'total' => 18000,
            
        ]);
        $response = $this->get("api/sales/{$sales->id}");
        $response -> assertStatus(200);
        $response -> assertJson([
            'name' => 'hamburgesa',
            'quantity' => 1,
            'price' => 18000,
            'taxes' => 1,5,
            'total' => 18000,
        ]);
    }

    public function test_can_update_sale()
    {
        $sale = Sale::create([
            'name' => 'salchipapa',
            'quantity' => 2,
            'price' => 8000,
            'taxes' => 1,5,
            'total' => 16000, 
        ]);
        $updatedData = [
            'name' => 'salchipapa',
            'quantity' => 2,
            'price' => 8000,
            'taxes' => 1,5,
            'total' => 16000, 
        ];
        $response = $this->put("api/sales/{$sales->id}", $updatedData);
        $response -> assertStatus(200);
        $this->assertDatabaseHas('sales',[
            'name' => 'salchipapa',
            'quantity' => 2,
            'price' => 8000,
            'taxes' => 1,5,
            'total' => 16000, 
        ]);
    }

    public function test_can_delete_sale()
    {
        $sale = Sale::create([
            'name' => 'pizza',
            'quantity' => 1,
            'price' => 10000,
            'taxes' => 1,5,
            'total' => 10000, 
        ]);
        $response = $this->delete("api/sales/{$sale->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('sales', [
            'name' => 'pizza',
        ]);
    }

    }

