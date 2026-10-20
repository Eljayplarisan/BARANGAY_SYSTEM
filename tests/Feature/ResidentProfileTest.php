<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ResidentProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_resident_can_upload_a_profile_picture(): void
    {
        Storage::fake('public');
        $user = User::factory()->create([
            'role' => 'resident',
            'is_approved' => true,
        ]);

        $response = $this->actingAs($user)->put(route('resident.profile.update'), [
            'name' => $user->name,
            'profile_photo' => new UploadedFile(
                public_path('images/city-hall-background.png'),
                'resident.png',
                'image/png',
                null,
                true
            ),
        ]);

        $response->assertRedirect();
        $user->refresh();
        $this->assertNotNull($user->profile_photo_path);
        Storage::disk('public')->assertExists($user->profile_photo_path);
    }

    public function test_profile_page_is_available_to_authenticated_resident(): void
    {
        $user = User::factory()->create([
            'role' => 'resident',
            'is_approved' => true,
        ]);

        $response = $this->actingAs($user)->get(route('resident.profile.edit'));

        $response->assertOk();
        $response->assertSee('Profile Picture');
    }
}
