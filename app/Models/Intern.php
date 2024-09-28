<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intern extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'profile_photo',
        'phone_number',
        'address',
        'gender',
        'job',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}