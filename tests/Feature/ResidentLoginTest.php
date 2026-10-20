<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class ResidentLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_shows_the_resident_sign_in_form(): void
    {
        $response = $this->get(route('login'));

        $response->assertOk();
        $response->assertSee('Welcome Back!');
        $response->assertSee('Back to Home');
        $response->assertSee(url('/'));
        $response->assertSee(route('password.request'));
        $response->assertSee(route('register'));
    }

    public function test_approved_resident_can_log_in(): void
    {
        $user = User::factory()->create([
            'email' => 'resident@example.com',
            'password' => Hash::make('password123'),
            'is_approved' => true,
        ]);

        $response = $this->post(route('login.store'), [
            'email' => 'resident@example.com',
            'password' => 'password123',
            'remember' => '1',
        ]);

        $response->assertRedirect(route('resident.dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_invalid_or_unapproved_credentials_cannot_log_in(): void
    {
        User::factory()->create([
            'email' => 'resident@example.com',
            'password' => Hash::make('password123'),
            'is_approved' => false,
        ]);

        $response = $this->post(route('login.store'), [
            'email' => 'resident@example.com',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_resident_can_request_a_password_reset_link(): void
    {
        Notification::fake();
        $user = User::factory()->create([
            'email' => 'resident@example.com',
        ]);

        $response = $this->post(route('password.email'), [
            'email' => $user->email,
        ]);

        $response->assertSessionHas('status');
        Notification::assertSentTo($user, ResetPassword::class);
    }

    public function test_resident_can_reset_password_with_a_valid_token(): void
    {
        $user = User::factory()->create([
            'email' => 'resident@example.com',
        ]);
        $token = Password::createToken($user);

        $response = $this->post(route('password.update'), [
            'token' => $token,
            'email' => $user->email,
            'password' => 'new-password-123',
            'password_confirmation' => 'new-password-123',
        ]);

        $response->assertRedirect(route('login'));
        $this->assertTrue(Hash::check('new-password-123', $user->fresh()->password));
    }
}
