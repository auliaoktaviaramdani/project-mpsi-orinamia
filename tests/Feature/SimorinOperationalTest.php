<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class SimorinOperationalTest extends TestCase
{
    public function test_guest_is_redirected_to_login_when_accessing_dashboard(): void
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_admin_can_access_dashboard_and_pages(): void
    {
        $admin = User::where('role', 'admin')->first();
        if (! $admin) {
            $admin = User::factory()->create([
                'username' => 'testadmin',
                'role' => 'admin',
            ]);
        }

        $this->actingAs($admin)
            ->get('/dashboard')
            ->assertStatus(200);

        $this->actingAs($admin)
            ->get('/penjualan')
            ->assertStatus(200);

        $this->actingAs($admin)
            ->get('/pembelian')
            ->assertStatus(200);

        $this->actingAs($admin)
            ->get('/laporan')
            ->assertStatus(200);

        $this->actingAs($admin)
            ->get('/master/pelanggan')
            ->assertStatus(200);

        $this->actingAs($admin)
            ->get('/akun')
            ->assertStatus(200);
    }
}
