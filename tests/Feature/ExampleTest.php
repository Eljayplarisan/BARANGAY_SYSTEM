<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_register_page_returns_a_successful_response(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('Create Resident Account');
    }

    public function test_landing_page_has_register_link(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee(route('register'));
    }
}
