<?php

namespace Tests\Feature;

use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class ReservationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function 時間とスタジオが重複したら予約ができない()
    {

        //準備
        Reservation::insert([
            [
                'studio' => 'A',
                'band_id' => 2,
                'date' => "2022-5-17",
                'start_time' => "9:00:00",
                'end_time' => "12:00:00",
            ],
            [
                'studio' => 'A',
                'band_id' => 2,
                'date' => "2022-5-17",
                'start_time' => "15:00:00",
                'end_time' => "19:00:00",
            ],
        ]);

        $postData = [
            'studio' => 'A',
            'band_id' => 2,
            'date' => "2022-5-17",
            'start_time' => "10:00:00",
            'end_time' => "16:00:00",
        ];
        //実行・検証
        $this->post('api/reservation/register', $postData)
            ->assertOK();

        $this->assertCount(2, Reservation::all());
        $this->assertDatabaseMissing('reservations', $postData);
    }

    /**
     * @test
     */
    public function 同じスタジオだが、予約時間が重複していないので予約できる()
    {

        //準備
        Reservation::insert([
            [
                'studio' => 'A',
                'band_id' => 2,
                'date' => "2022-5-17",
                'start_time' => "9:00:00",
                'end_time' => "12:00:00",
            ],
            [
                'studio' => 'A',
                'band_id' => 2,
                'date' => "2022-5-17",
                'start_time' => "15:00:00",
                'end_time' => "19:00:00",
            ],
        ]);

        $postData = [
            'studio' => 'A',
            'band_id' => 2,
            'date' => "2022-5-17",
            'start_time' => "20:00:00",
            'end_time' => "21:00:00",
        ];
        //実行・検証
        $this->post('api/reservation/register', $postData)
            ->assertOK();

        $this->assertCount(3, Reservation::all());
        $this->assertDatabaseHas('reservations', $postData);
    }

    /**
     * @test
     */
    public function 予約時間が重複しているがスタジオが違うので予約できる()
    {

        //準備
        Reservation::insert([
            [
                'studio' => 'A',
                'band_id' => 2,
                'date' => "2022-5-17",
                'start_time' => "9:00:00",
                'end_time' => "12:00:00",
            ],
            [
                'studio' => 'A',
                'band_id' => 2,
                'date' => "2022-5-17",
                'start_time' => "15:00:00",
                'end_time' => "19:00:00",
            ],
        ]);

        $postData = [
            'studio' => 'C',
            'band_id' => 2,
            'date' => "2022-5-17",
            'start_time' => "10:00:00",
            'end_time' => "16:00:00",
        ];
        //実行・検証
        $this->post('api/reservation/register', $postData)
            ->assertOK();

        $this->assertCount(3, Reservation::all());
        $this->assertDatabaseHas('reservations', $postData);
    }
}
