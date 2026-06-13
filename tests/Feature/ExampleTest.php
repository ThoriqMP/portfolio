<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $this->seed();

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Test that missing database tables trigger our custom neo-brutalist error page.
     */
    public function test_database_missing_table_exception_returns_custom_view(): void
    {
        $this->app['router']->get('/test-error-migration-helper', function () {
            // Force a query exception for a non-existent table
            \Illuminate\Support\Facades\DB::table('non_existent_table_xyz')->get();
        });

        $response = $this->get('/test-error-migration-helper');

        $response->assertStatus(500);
        $response->assertSee('Tabel Database');
        $response->assertSee('Belum Dibuat!');
        $response->assertSee('php artisan migrate');
        $response->assertSee('php artisan db:seed');
    }
}
