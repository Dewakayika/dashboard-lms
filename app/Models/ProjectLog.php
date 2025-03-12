<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',
        'talent_qc',
        'timestamp',
        'status',
    ];

    // Relasi ke Project
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    // Relasi ke User (Talent)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

