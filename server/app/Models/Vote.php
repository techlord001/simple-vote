<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'vote_number',
        'ip_address',
        'estimated_location',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
