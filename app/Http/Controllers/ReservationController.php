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

            if ($sortedData->isEmpty()) {
                $sortedData = '予約がありません';
            }

            return $sortedData;
        } catch (Exception $e) {
            Log::emergency($e->getMessage());
            return $e;
        }
    }

    public function registerReservation(Reservation $reservation, Request $request)
    {

        try {
            //スタジオ、日にち、バンドID、予約開始時間、予約終了時間がとんできたとする。
            $postData = $request->only(['studio', 'date', 'band_id', 'start_time', 'end_time']);
            //スタジオ、日にちで絞ったデータを取得。
            $searchedData = $reservation->searchByStudioAndDate($postData);
            $check_result = true;
            //絞ったデータに値があればその配列をループで一つずつ重複チェックする。
            if (isset($searchedData)) {

                foreach ($searchedData as $each) {
                    $start_time = $each['start_time'];
                    $end_time = $each['end_time'];

                    if ($postData['start_time'] <= $end_time && $postData['end_time'] >= $start_time) {
                        // Log::info('重複しています');
                        $check_result = false;
                    } else {
                        // Log::info('予約できます');
                        $check_result = true;
                    }
                }
            }
            //予約ができる状況であれば登録。
            if ($check_result) {
                $reservation->insertReservation($postData);
                \Slack::send('予約が登録されました');
                return '予約できました';
            } else {
                return '予約できませんでした';
            }
        } catch (Exception $e) {
            Log::emergency($e->getMessage());
            return $e;
        }
    }
}

// //スタジオ、日にち、バンドID、予約開始時間、予約終了時間がとんできたとする。
// $postData = $request->only(['studio', 'date', 'band_id', 'start_time', 'end_time']);
// //スタジオ、日にちで絞ったデータを取得。
// $searchedData = $reservation->searchByStudioAndDate($postData);
// //予約の配列をループで一つずつ重複チェックする。

// foreach ($searchedData as $each) {
//     $start_time = $each['start_time'];
//     $end_time = $each['end_time'];

//     if ($postData['start_time'] <= $end_time && $postData['end_time'] >= $start_time) {
//         Log::info('重複しています');
//         abort(403);
//     } else {
//         Log::info('予約できます');
//         $check_result = true;
//     }
// }

// //重複チェックが全てOKであれば
// if ($check_result) {
//     $reservation->insertReservation($postData);
// }
