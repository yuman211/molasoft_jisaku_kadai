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
}
