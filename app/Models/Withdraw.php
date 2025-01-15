<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_panel',
        'total_project',
        'withdraw_date',
        'withdraw_amount',
        'panel_bonus',
        'perfomance_bonus',
        'bank_account',
        'bank_name',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
