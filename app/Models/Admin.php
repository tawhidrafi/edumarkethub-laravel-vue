<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admins';

    protected $fillable = [
        'name',
        'phone',
        'username',
        'password',
        'status',
    ];

    public $timestamps = false; // because you're using created_at manually
}
