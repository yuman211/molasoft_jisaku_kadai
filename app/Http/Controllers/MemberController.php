<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function showAllMembersWithBands(Member $member)
    {
        try {
            return $member->getAllMembersWithBands();
        } catch (Exception $e) {
            Log::emergency($e->getMessage());
            return $e;
        }
    }

    public function registerMember(Member $member, Request $request)
    {
        try {
            DB::beginTransaction();
            $postData = $request->only(['name', 'grade', 'gender', 'part']);
            $member_id = $member->insertMemberAndGetId($postData);

            if ($request->has('band_id')) {
                $band_id = $request->input('band_id');
                $member->tagBandWithMember($member_id, $band_id);
            }

            DB::commit();
            return '登録完了';
        } catch (Exception $e) {
            DB::rollback();
            Log::emergency($e->getMessage());
            return $e;
        }
    }

    public function deleteMember(Member $member,Request $request)
    {
        try {
            $postData = $request->only('id');
            $member->softDeleteMember($postData);

            return '削除OK';
        } catch (Exception $e) {
            Log::emergency($e->getMessage());
            return $e;
        }
    }

    public function updateMember(Member $member,Request $request)
    {
        try {
            $postData = $request->all();
            $member->updateMember($postData);

            return '更新OK';
        } catch (Exception $e) {
            Log::emergency($e->getMessage());
            return $e;
        }
    }
}
