<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Project;


class Talent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'Address',
        'Bank_Account',
        'profile_photo',
        'phone_number',
        'gender',
        'date_of_birth',
        'id_card',
        'bank_name',
        'swift_code',
        'subjected_tax',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    // Relasi ke proyek yang menjadi talent
    public function talentProjects()
    {
        return $this->hasMany(Project::class, 'talent_id');
    }

}
