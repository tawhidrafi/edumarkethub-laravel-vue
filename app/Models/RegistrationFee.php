<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationFee extends Model
{
    use HasFactory;

    protected $table = 'registration_fees';

    protected $fillable = [
        'user_id',
        'phone',
        'trxid',
        'status',
    ];

    public $timestamps = false;

    // Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
