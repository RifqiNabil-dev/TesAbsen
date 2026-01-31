<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'nim',
        'institution',
        'phone',
        'start_date',
        'end_date',
        'group_id',
        'phone_number',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isMahasiswa(): bool
    {
        return $this->role === 'mahasiswa';
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function logbooks()
    {
        return $this->hasMany(Logbook::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class, 'user_id');
    }

    public function approvedLogbooks()
    {
        return $this->hasMany(Logbook::class, 'approved_by');
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}

