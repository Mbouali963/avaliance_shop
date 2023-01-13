<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ProductTest extends TestCase
{
    // Authenticate user
    protected function login(){
        $credentials = ['email' => "mohammed@mail.com", 'password' => "123456"];
        $token = auth()->attempt($credentials);

        return $token;
    }
    /**
     * Test listing all existing products
     *
     * @return void
     */
    public function test_list_all_existing_products()
    {
        // call route to rettrieve all products
        $response = $this->get('/api/products');
        // test response satus
        $response->assertOk();
    }

    public function test_create_product()
    {
        $token = $this->login();
        // Create some dummy categories
        $category = Category::first();
        // Create some dummy product
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('POST', route('products.store'),[
            'name' => 'Product 1',
            'sku' => 'AAA1',
            'price' => 100.0,
            'quantity' => 10,
            'category_id' => $category->id,
        ]);
        $response->assertStatus(200);
    }

    public function test_update_product()
    {
        $token = $this->login();
        // Create some dummy categories
        $product = Product::first();
        // Create some dummy product
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('PUT', route('products.update', ['product' => $product->id]),[
            'name' => 'Product New',
            'sku' => 'AAA0',
            'price' => 110.0,
            'quantity' => 15,
            'category_id' => $product->category_id,
        ]);
        $product = Product::first();

        $response->assertStatus(200);
        $this->assertEquals('Product New', $product->name);
    }

    public function test_delete_product()
    {
        $token = $this->login();
        // Create some dummy categories
        $product_id = Product::first()->id;
        // Create some dummy product
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('DELETE', route('products.destroy', ['product' => $product_id]));
        $product = Product::find($product_id);

        $response->assertStatus(200);
        $this->assertEquals(null, $product);
    }
}
