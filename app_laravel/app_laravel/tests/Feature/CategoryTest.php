<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;


class CategoryTest extends TestCase
{
    use RefreshDatabase;
    public function test_can_create_category()
    {
        $data = [
            'name' => 'comida',
            'description' => 'chatarra',
        ];
        $response = $this->post('api/categories', $data);
        $response -> assertStatus(201);
        $this->assertDatabaseHas('categories', [
            'name' => 'comida',
            'description' => 'chatarra',
        ]);
    }

    public function test_can_show_category()
    {
        $category = Category::create([
            'name' => 'ropa',
            'description' => 'de marca',
        ]);
        $response = $this->get("api/categories/{$category->id}");
        $response -> assertStatus(200);
        $response -> assertJson([
            'name' => 'ropa',
            'description' => 'de marca',
        ]);
    }

    public function test_can_update_category()
    {
        $category = Category::create([
            'name' => 'ropa',
            'description' => 'de marca', 
        ]);
        $updatedData = [
            'name' => 'tecnologia',
            'description' => 'celulares', 
        ];
        $response = $this->put("api/category/{$category->id}", $updatedData);
        $response -> assertStatus(200);
        $this->assertDatabaseHas('categories',[
            'name' => 'tecnologia',
            'description' => 'celulares',   
        ]);
    }

    public function test_can_delete_category()
    {
        $category = Category::create([
            'name' => 'cosmetica',
            'description' => 'brillo', 
        ]);
        $response = $this->delete("api/categories/{$category->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('categories', [
            'name' => 'cosmetica',
        ]);
    }
}
