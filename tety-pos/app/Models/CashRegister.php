<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashRegister extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'opening_balance', 'closing_balance', 
        'expected_balance', 'opened_at', 'closed_at', 'status', 'notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}