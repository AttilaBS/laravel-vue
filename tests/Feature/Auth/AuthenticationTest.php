<?php

use App\Models\Product;
use App\Models\User;
use function Pest\Laravel\actingAs;

test('login screen can be rendered', function () {
    $response = $this->get('/user/login');

    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create(['password' => '12345678']);

    $response = $this->post('/user/login', [
        'email' => $user->email,
        'password' => '12345678',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('home'));
});

test('users can not authenticate using wrong password', function () {
    $user = User::factory()->create(['password' => '12345678']);

    $response = $this->post('/user/login', [
        'email' => $user->email,
        'password' => '123456789',
    ]);

    $this->assertGuest();
    expect('Invalid credentials');
});

test('non-admin users can not delete products', function () {
    $user = User::factory()->create(
        [
            'password' => '12345678',
            'is_admin' => false,
        ]
    );

    actingAs($user);

    $product = Product::factory()->create(['owner_id' => $user->id]);

    $response = $this->delete(route('product.delete', $product->id));

    $response->assertStatus(403);

});
