<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Band;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Member extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    public function bands()
    {
        return $this->belongsToMany(Band::class, 'bands_members', 'member_id', 'band_id');
    }

    public function getAllMembersWithBands()
    {
        try {
            return $this->with('bands')->get();
        } catch (Exception $e) {
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    public function insertMemberAndGetId($postData)
    {
        try {
            return $this->insertGetId($postData);
        } catch (Exception $e) {
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    public function tagBandWithMember($member_id, $band_id)
    {
        // DB::table('bands_members')->insert(
        //     [
        //         'band_id' => $band_id,
        //         'member_id' => $member_id,
        //     ]
        // );

        $this->bands()->attach(
            ['band_id' => $band_id],
            ['member_id' => $member_id]
        );
    }

    public function softDeleteMember($postData)
    {
        try {
            $this->where('id', '=', $postData)->delete();

        } catch (Exception $e) {
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    public function updateMember($postData)
    {
        try {
            $this->where('id', '=', $postData['id'])->update($postData);
        } catch (Exception $e) {
            Log::emergency($e->getMessage());
            throw $e;
        }
    }
}


