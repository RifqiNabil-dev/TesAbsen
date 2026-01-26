<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'assessed_by',
        'attendance_score',
        'discipline_score',
        'performance_score',
        'initiative_score',
        'cooperation_score',
        'strengths',
        'weaknesses',
        'recommendations',
        'total_score',
        'grade',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assessor()
    {
        return $this->belongsTo(User::class, 'assessed_by');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($assessment) {
            $assessment->total_score = 
                $assessment->attendance_score +
                $assessment->discipline_score +
                $assessment->performance_score +
                $assessment->initiative_score +
                $assessment->cooperation_score;

            if ($assessment->total_score >= 90) {
                $assessment->grade = 'A';
            } elseif ($assessment->total_score >= 80) {
                $assessment->grade = 'B';
            } elseif ($assessment->total_score >= 70) {
                $assessment->grade = 'C';
            } elseif ($assessment->total_score >= 60) {
                $assessment->grade = 'D';
            } else {
                $assessment->grade = 'E';
            }
        });
    }
}

