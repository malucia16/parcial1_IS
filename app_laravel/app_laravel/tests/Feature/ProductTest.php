<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;


class ProductTest extends TestCase
{
    use RefreshDatabase;
    public function test_can_create_product()
    {
        $data = [
            'name' => 'comida',
            'selling_price' => 10000,
            'buying_price' => 10000,
            'stock' => 3,
            'description' => 'chatarra',
        ];
        $response = $this->post('api/products', $data);
        $response -> assertStatus(201);
        $this->assertDatabaseHas('products', [
            'name' => 'comida',
            'selling_price' => 10000,
            'buying_price' => 10000,
            'stock' => 3,
            'description' => 'chatarra',
        ]);
    }

    public function test_can_show_product()
    {
        $product = Product::create([
            'name' => 'ropa',
            'selling_price' => 50000,
            'buying_price' => 50000,
            'stock' => 4,
            'description' => 'de marca',
        ]);
        $response = $this->get("api/products/{$product->id}");
        $response -> assertStatus(200);
        $response -> assertJson([
            'name' => 'ropa',
            'selling_price' => 50000,
            'buying_price' => 50000,
            'stock' => 4,
            'description' => 'de marca',
        ]);
    }

    public function test_can_update_product()
    {
        $product = Product::create([
            'name' => 'ropa',
            'selling_price' => 50000,
            'buying_price' => 50000,
            'stock' => 4,
            'description' => 'de marca', 
        ]);
        $updatedData = [
            'name' => 'tecnologia',
            'selling_price' => 1000000,
            'buying_price' => 900000,
            'stock' => 8,
            'description' => 'celulares', 
        ];
        $response = $this->put("api/products/{$product->id}", $updatedData);
        $response -> assertStatus(200);
        $this->assertDatabaseHas('products',[
            'name' => 'tecnologia',
            'selling_price' => 1000000,
            'buying_price' => 900000,
            'stock' => 8,
            'description' => 'celulares',   
        ]);
    }

    public function test_can_delete_product()
    {
        $product = Product::create([
            'name' => 'cosmetica',
            'selling_price' => 10000,
            'buying_price' => 8000,
            'stock' => 8,
            'description' => 'brillo', 
        ]);
        $response = $this->delete("api/products/{$product->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('products', [
            'name' => 'cosmetica',
        ]);
    }
}