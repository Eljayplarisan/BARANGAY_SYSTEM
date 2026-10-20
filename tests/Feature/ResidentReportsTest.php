<?php

namespace Tests\Feature;

use App\Models\Report;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResidentReportsTest extends TestCase
{
    use RefreshDatabase;

    public function test_resident_can_submit_a_report_and_see_it_in_my_reports(): void
    {
        $user = User::factory()->create([
            'role' => 'resident',
            'is_approved' => true,
        ]);

        $response = $this->actingAs($user)->post(route('resident.reports.store'), [
            'type' => 'complaint',
            'category' => 'Infrastructure',
            'occurred_at' => '2026-10-20T10:30',
            'location' => 'Purok 1, Main Street',
            'description' => 'The streetlight is not working.',
        ]);

        $response->assertRedirect(route('resident.dashboard'));
        $this->assertDatabaseHas('reports', [
            'user_id' => $user->id,
            'type' => 'complaint',
            'category' => 'Infrastructure',
            'location' => 'Purok 1, Main Street',
            'status' => 'submitted',
        ]);

        $this->actingAs($user)
            ->get(route('resident.reports.index'))
            ->assertOk()
            ->assertSee('The streetlight is not working.');
    }

    public function test_my_reports_only_displays_reports_owned_by_current_resident(): void
    {
        $resident = User::factory()->create(['role' => 'resident', 'is_approved' => true]);
        $otherResident = User::factory()->create(['role' => 'resident', 'is_approved' => true]);

        $ownReport = Report::create([
            'user_id' => $resident->id,
            'type' => 'blotter',
            'category' => 'Peace and Order',
            'occurred_at' => now(),
            'location' => 'Purok 1',
            'description' => 'My own report.',
            'status' => 'submitted',
        ]);
        Report::create([
            'user_id' => $otherResident->id,
            'type' => 'complaint',
            'category' => 'Health',
            'occurred_at' => now(),
            'location' => 'Purok 9',
            'description' => 'Another resident report.',
            'status' => 'submitted',
        ]);

        $response = $this->actingAs($resident)->get(route('resident.reports.index'));

        $response->assertOk();
        $response->assertSee('My own report.');
        $response->assertDontSee('Another resident report.');

        $this->actingAs($resident)
            ->get(route('resident.reports.index', ['report' => $ownReport->id + 1]))
            ->assertNotFound();
    }

    public function test_report_form_requires_valid_fields(): void
    {
        $user = User::factory()->create([
            'role' => 'resident',
            'is_approved' => true,
        ]);

        $response = $this->actingAs($user)->post(route('resident.reports.store'), [
            'type' => 'admin',
            'category' => 'Invalid category',
        ]);

        $response->assertSessionHasErrors(['type', 'category', 'occurred_at', 'location', 'description']);
        $this->assertDatabaseCount('reports', 0);
    }
}
