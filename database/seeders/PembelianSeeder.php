<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PembelianSeeder extends Seeder
{
    public function run()
    {
        $data = [];

        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'name' => 'Pembeli ' . ($i + 1),
                'phone_number' => '08' . rand(1000000000, 9999999999),
                'product_id' => [6, 8][array_rand([6, 8])],
                'points' => rand(500, 5000),
                'quantity' => rand(1, 10),
                'made_by' => ['Agus', 'Budi', 'Citra', 'Dewi'][array_rand(['Agus', 'Budi', 'Citra', 'Dewi'])],
                'created_at' => Carbon::now()->subDays(100 - $i), // Tanggal mundur 100 hari ke belakang
                'updated_at' => Carbon::now()->subDays(100 - $i),
            ];
        }

        DB::table('purchases')->insert($data);
    }
}
