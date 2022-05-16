<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

use function PHPUnit\Framework\isEmpty;

class ReservationController extends Controller
{

    public function showReservation(Reservation $reservation, Request $request)
    {
        try {
            $postData = $request->all();
            $sortedData = $reservation->sortReservation($postData);

            if($sortedData->isEmpty()){
                $sortedData = '予約がありません';
            }

            return $sortedData;


        } catch (Exception $e) {
            Log::emergency($e->getMessage());
            return $e;
        }
    }

}
