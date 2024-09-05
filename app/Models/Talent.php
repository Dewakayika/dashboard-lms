<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Talent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'school',
        'bank_name',
        'bank_account',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}