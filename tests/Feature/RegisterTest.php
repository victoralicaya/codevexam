<?php

namespace Tests\Feature;

use App\Livewire\Register;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_register_a_user(): void
    {
        $credentials = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123'
        ];

        Livewire::test(Register::class)
            ->set('name', $credentials['name'])
            ->set('email', $credentials['email'])
            ->set('password', $credentials['password'])
            ->call('register');

        $this->assertDatabaseHas('users', [
            'name' => $credentials['name'],
            'email' => $credentials['email'],
        ]);

        $user = User::first();
        $this->assertTrue(Hash::check($credentials['password'], $user->password));
    }
}
