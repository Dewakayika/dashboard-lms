<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ewallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_panel',
        'total_project',
        'periode',
        'total_ewallet',
        'panel_bonus',
        'perfomance_bonus',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
