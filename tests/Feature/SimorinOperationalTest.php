<?php

namespace Tests\Feature;

use App\Models\BahanBaku;
use App\Models\Pelanggan;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SimorinOperationalTest extends TestCase
{
    use DatabaseTransactions;

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
            ->get('/penjualan/create')
            ->assertStatus(200);

        $this->actingAs($admin)
            ->get('/pembelian')
            ->assertStatus(200);

        $this->actingAs($admin)
            ->get('/pembelian/create')
            ->assertStatus(200);

        $this->actingAs($admin)
            ->get('/laporan')
            ->assertStatus(200);

        $this->actingAs($admin)
            ->get('/master/pelanggan')
            ->assertStatus(200);

        $this->actingAs($admin)
            ->get('/master/pelanggan/create')
            ->assertStatus(200);

        $this->actingAs($admin)
            ->get('/master/supplier/create')
            ->assertStatus(200);

        $this->actingAs($admin)
            ->get('/master/bahan/create')
            ->assertStatus(200);

        $this->actingAs($admin)
            ->get('/akun')
            ->assertStatus(200);

        $this->actingAs($admin)
            ->get('/akun/create')
            ->assertStatus(200);
    }

    public function test_admin_can_create_penjualan_successfully(): void
    {
        $admin = User::where('role', 'admin')->first();
        $pelanggan = Pelanggan::first();

        $response = $this->actingAs($admin)->post('/penjualan', [
            'pelanggan_id' => $pelanggan->id,
            'tgl_jual' => now()->toDateString(),
            'dp_persen' => 50,
            'dp_jatuh_tempo' => now()->addDays(7)->toDateString(),
            'ln_jatuh_tempo' => now()->addDays(21)->toDateString(),
            'items' => [
                [
                    'nama_item' => 'Dress Katun Orinamia',
                    'ukuran' => 'M',
                    'qty' => 2,
                    'harga_satuan' => 150000,
                ],
            ],
        ]);

        $response->assertRedirect('/penjualan');
        $this->assertDatabaseHas('penjualan', [
            'pelanggan_id' => $pelanggan->id,
            'total' => 300000,
        ]);
    }

    public function test_admin_can_create_pembelian_successfully(): void
    {
        $admin = User::where('role', 'admin')->first();
        $supplier = Supplier::first();
        $bahan = BahanBaku::first();

        $response = $this->actingAs($admin)->post('/pembelian', [
            'supplier_id' => $supplier->id,
            'no_faktur' => 'INV-TEST-001',
            'tgl_beli' => now()->toDateString(),
            'items' => [
                [
                    'bahan_id' => $bahan->id,
                    'qty' => 5,
                    'harga_satuan_saat_transaksi' => $bahan->harga_beli,
                ],
            ],
        ]);

        $response->assertRedirect('/pembelian');
        $this->assertDatabaseHas('pembelian', [
            'supplier_id' => $supplier->id,
            'no_faktur' => 'INV-TEST-001',
        ]);
    }
}
