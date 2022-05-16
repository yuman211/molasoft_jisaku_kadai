<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Band;
use Illuminate\Support\Facades\Log;
use Exception;


class BandController extends Controller
{
    public function showAllBandsWithMembers(Band $band)
    {
        try {
            return $band->getAllBandsWithMembers();
        } catch (Exception $e) {
            Log::emergency($e->getMessage());
            return $e;
        }
    }

    public function registerBand(Band $band, Request $request)
    {
        try {
            $postData = $request->only(['name', 'genre', 'count_members', 'summary']);
            $band_id = $band->insertBandAndGetId($postData);
            if($request->has('member_id'))
            {
                $members_id = $request->input('member_id');
                $band->tagMemberWithBand($band_id,$members_id);
                //バンドメンバーが複数おり、member_idが配列で来た時を想定。
            }
            return "登録OK";
        } catch (Exception $e) {
            Log::emergency($e->getMessage());
            return $e;
        }
    }

}
