<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'bio',
        'bkash_num',
        'status',
    ];

    public $timestamps = false; // since you're using 'registered_at' instead of created_at

    protected $hidden = ['password'];

    protected $casts = [
        'registered_at' => 'datetime',
    ];


    // Relationships
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function registrationFees()
    {
        return $this->hasMany(RegistrationFee::class);
    }
}
