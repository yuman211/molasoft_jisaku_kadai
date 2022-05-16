<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Band extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function members()
    {
        return $this->belongsToMany(Member::class,'bands_members','band_id','member_id');
    }

    public function getAllBandsWithMembers()
    {
        try {
            return $this->with('members')->get();
        } catch (Exception $e) {
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    public function insertBandAndGetId($postData)
    {
        try {
            return $this->insertGetId($postData);
        } catch (Exception $e) {
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    public function tagMemberWithBand($band_id, $members_id)
    {
        try {

            $insertData = [];
            foreach($members_id as $member_id){
            $insertData[] =[
                'band_id' => $band_id,
                'member_id' =>$member_id
            ];
            }

            DB::table('bands_members')->insert($insertData);

        } catch (Exception $e) {
            Log::emergency($e->getMessage());
            throw $e;
        }
    }
}
