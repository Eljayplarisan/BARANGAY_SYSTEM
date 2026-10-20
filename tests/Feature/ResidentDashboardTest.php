<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Report;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResidentDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login_from_resident_dashboard(): void
    {
        $response = $this->get(route('resident.dashboard'));

        $response->assertRedirect(route('login'));
    }

    public function test_approved_resident_can_view_dashboard(): void
    {
        $user = User::factory()->create([
            'name' => 'Juan Dela Cruz',
            'role' => 'resident',
            'is_approved' => true,
        ]);

        $response = $this->actingAs($user)->get(route('resident.dashboard'));

        $response->assertOk();
        $response->assertSee('Juan Dela Cruz');
        $response->assertSee('What would you like to report?');
        $response->assertSee('Blotter Report');
        $response->assertSee('Submit a Complaint / Concern');
        $response->assertSee('class="nav-item active"', false);
        $response->assertSee('aria-current="page"', false);
        $response->assertSee('href="'.route('resident.reports.create').'"', false);
        $response->assertSee('href="'.route('resident.reports.index').'"', false);
    }

    public function test_non_resident_cannot_view_resident_dashboard(): void
    {
        $user = User::factory()->create([
            'role' => 'admin',
            'is_approved' => true,
        ]);

        $this->actingAs($user)->get(route('resident.dashboard'))->assertForbidden();
        $this->get(route('resident.reports.create'))->assertForbidden();
        $this->get(route('resident.reports.index'))->assertForbidden();
        $this->get(route('resident.profile.edit'))->assertForbidden();
    }

    public function test_resident_can_log_out_from_dashboard(): void
    {
        $user = User::factory()->create([
            'role' => 'resident',
            'is_approved' => true,
        ]);

        $response = $this->actingAs($user)->post(route('logout'));

        $response->assertRedirect(route('login'));
        $this->assertGuest();
    }

    public function test_resident_can_open_the_report_form_with_report_navigation_active(): void
    {
        $user = User::factory()->create([
            'role' => 'resident',
            'is_approved' => true,
        ]);

        $response = $this->actingAs($user)->get(route('resident.reports.create', ['type' => 'complaint']));

        $response->assertOk();
        $response->assertSee('Submit a Complaint / Concern');
        $response->assertSee('class="nav-item active"', false);
        $response->assertSee('aria-current="page"', false);
    }

    public function test_resident_can_open_my_reports_with_my_reports_navigation_active(): void
    {
        $user = User::factory()->create([
            'role' => 'resident',
            'is_approved' => true,
        ]);
        Report::create([
            'user_id' => $user->id,
            'type' => 'blotter',
            'category' => 'Peace and Order',
            'occurred_at' => now(),
            'location' => 'Purok 2',
            'description' => 'Noise disturbance.',
            'status' => 'submitted',
        ]);

        $response = $this->actingAs($user)->get(route('resident.reports.index'));

        $response->assertOk();
        $response->assertSee('My Reports');
        $response->assertSee('CR-0001');
        $response->assertSee('Peace and Order');
        $response->assertSee('class="nav-item active"', false);
        $response->assertSee('aria-current="page"', false);
    }
}
