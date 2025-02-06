<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

/**
 * Tests product creation at database.
 */
it('can create a product', function () {
    $user = User::factory()->create();

    $product = Product::create([
        'name' => 'Test Product',
        'description' => 'A sample product',
        'price' => 19.99,
        'stock_quantity' => 1500,
        'owner_id' => $user->id,
    ]);

    expect($product)
        ->name->toBe('Test Product')
        ->description->toBe('A sample product')
        ->price->toBe(19.99)
        ->stock_quantity->toBe(1500)
        ->owner_id->toBe($user->id);
});

/**
 * Test the creation of a product using the route.
 */
it(/**
 * @throws JsonException
 */ 'can create and retrieve a product via route', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->post(route('product.store'), [
            'name' => 'Test Product',
            'description' => 'A sample product',
            'price' => 19.99,
            'stock_quantity' => 10,
            'owner_id' => $user->id,
        ])
        ->assertRedirect(route('home'))
        ->assertSessionHasNoErrors();

    $product = Product::latest()->first();

    $retrievedResponse = $this->get(route('home'));

    $retrievedResponse->assertStatus(200)
        ->assertSee([
            'id' => $product->id,
            'name' => 'Test Product',
            'description' => 'A sample product',
            'price' => 19.99,
            'stock_quantity' => 10,
            'owner_id' => $user->id,
        ]);
});
