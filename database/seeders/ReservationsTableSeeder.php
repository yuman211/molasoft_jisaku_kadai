<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservations')->insert([
            [
                'studio' => 'A',
                'band_id' => '1',
                'date' => "2018-05-15",
                'start_time' => "16:00:00",
                'end_time' => "18:00:00"
            ],
            [
                'studio' => 'B',
                'band_id' => '1',
                'date' => "2018-05-15",
                'start_time' => "16:00:00",
                'end_time' => "18:00:00"
            ],
            [
                'studio' => 'B',
                'band_id' => '2',
                'date' => "2018-05-15",
                'start_time' => "13:00:00",
                'end_time' => "15:00:00"
            ],
            [
                'studio' => 'A',
                'band_id' => '2',
                'date' => "2018-05-15",
                'start_time' => "19:00:00",
                'end_time' => "21:00:00"
            ],
            [
                'studio' => 'A',
                'band_id' => '2',
                'date' => "2018-05-15",
                'start_time' => "13:00:00",
                'end_time' => "15:00:00"
            ],
            [
                'studio' => 'C',
                'band_id' => '2',
                'date' => "2018-05-15",
                'start_time' => "19:00:00",
                'end_time' => "21:00:00"
            ],
        ]);
    }
}
