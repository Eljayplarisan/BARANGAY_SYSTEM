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
        $response->assertSee('Secretary');
    }

    public function test_registration_requires_terms_acceptance(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'Resident Example',
            'address' => 'Purok 1',
            'phone' => '09123456789',
            'email' => 'resident@example.com',
            'role' => 'resident',
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
            'role' => 'resident',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'terms_accepted' => '1',
            'is_approved' => '0',
        ]);

        $response->assertRedirect(route('register'));
        $response->assertSessionHas('status', 'Your resident account has been created and automatically approved.');

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

    public function test_registration_creates_an_approved_secretary_after_terms_acceptance(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'Secretary Example',
            'address' => 'Barangay Hall',
            'phone' => '09123456780',
            'email' => 'secretary@example.com',
            'role' => 'secretary',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'terms_accepted' => '1',
            'is_approved' => '0',
        ]);

        $response->assertRedirect(route('register'));
        $response->assertSessionHas('status', 'Your secretary account has been created and automatically approved.');

        $this->assertDatabaseHas('users', [
            'name' => 'Secretary Example',
            'address' => 'Barangay Hall',
            'phone' => '09123456780',
            'email' => 'secretary@example.com',
            'role' => 'secretary',
            'is_approved' => true,
        ]);

        $user = \App\Models\User::where('email', 'secretary@example.com')->firstOrFail();
        $this->assertNotNull($user->terms_accepted_at);
        $this->assertTrue(Hash::check('password123', $user->password));
    }

    public function test_registration_rejects_disallowed_roles(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'Invalid Role User',
            'address' => 'Purok 1',
            'phone' => '09123456789',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'terms_accepted' => '1',
        ]);

        $response->assertSessionHasErrors('role');
        $this->assertDatabaseMissing('users', ['email' => 'admin@example.com']);
    }
}
