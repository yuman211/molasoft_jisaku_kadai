<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Exception;

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
}
