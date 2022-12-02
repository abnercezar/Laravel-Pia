<?php

use App\Providers\RouteServiceProvider;

test('test_registration_screen_can_be_rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
}); 

test('test_new_users_can_register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});
