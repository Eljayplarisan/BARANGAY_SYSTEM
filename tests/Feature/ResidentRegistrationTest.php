<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ResidentRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_page_has_a_back_to_home_link(): void
    {
        $response = $this->get(route('register'));

        $response->assertOk();
        $response->assertSee('Back to Home');
        $response->assertSee('href="'.url('/').'"', false);
        $response->assertSee('Account Role');
        $response->assertSee('Resident');
    }

    public function test_registration_requires_terms_acceptance(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'Resident Example',
            'address' => 'Purok 1',
            'phone' => '09123456789',
            'email' => 'resident@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors('terms_accepted');
        $this->assertDatabaseMissing('users', ['email' => 'resident@example.com']);
    }

    public function test_registration_creates_an_approved_resident_after_terms_acceptance(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'Resident Example',
            'address' => 'Purok 1',
            'phone' => '09123456789',
            'email' => 'resident@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'terms_accepted' => '1',
            'role' => 'admin',
            'is_approved' => '0',
        ]);

        $response->assertRedirect(route('register'));
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('users', [
            'name' => 'Resident Example',
            'address' => 'Purok 1',
            'phone' => '09123456789',
            'email' => 'resident@example.com',
            'role' => 'resident',
            'is_approved' => true,
        ]);

        $user = \App\Models\User::where('email', 'resident@example.com')->firstOrFail();
        $this->assertNotNull($user->terms_accepted_at);
        $this->assertTrue(Hash::check('password123', $user->password));
    }
}
