<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\Band;

class Reservation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function band()
    {
        return $this->belongsTo(Band::class,'band_id','id');
    }


    public function sortReservation($postData)
    {
        try {
            $query = $this->query();

            if (isset($postData['studio'])) {
                $query->where('studio', '=', $postData['studio']);
            }
            if (isset($postData['date'])) {
                $query->where('date', '=', $postData['date']);
            }

            return $query->orderBy('start_time','asc')->with('band.members')->get();

        } catch (Exception $e) {
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    public function searchByStudioAndDate($postData)
    {
        try {
            $query = $this->query();

            if (isset($postData['studio'])) {
                $query->where('studio', '=', $postData['studio']);
            }
            if (isset($postData['date'])) {
                $query->where('date', '=', $postData['date']);
            }

            return $query->get()->toArray();
        } catch (Exception $e) {
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    public function insertReservation($postData)
    {
        try {
            $this->insert($postData);
        } catch (Exception $e) {
            Log::emergency($e->getMessage());
            throw $e;
        }
    }
}
