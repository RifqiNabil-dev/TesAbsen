<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'location_id',
        'date',
        'check_in',
        'check_out',
        'status',
        'notes',
        'location_status',
        'distance',
        'latitude',
        'longitude',
    ];

    /*ACCESSORS*/

    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value) : null;
    }

    public function getCheckInAttribute($value)
    {
        return $value ? Carbon::parse($value) : null;
    }

    public function getCheckOutAttribute($value)
    {
        return $value ? Carbon::parse($value) : null;
    }

    /*RELATIONS*/

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }


    public function getWorkDurationAttribute()
    {
        if ($this->check_in && $this->check_out) {
            return $this->check_in->diffInHours($this->check_out);
        }

        return null;
    }
}
