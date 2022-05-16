<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BandController;
use App\Http\Controllers\MemberController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/band_list', [BandController::class, 'showAllBandsWithMembers']);

Route::get('/member_list',[MemberController::class, 'showAllMembersWithBands']);

Route::post('/member/register',[MemberController::class, 'registerMember']);

Route::post('/member/delete',[MemberController::class, 'deleteMember']);

Route::post('/member/update',[MemberController::class, 'updateMember']);

Route::post('/band/register',[BandController::class, 'registerBand']);




