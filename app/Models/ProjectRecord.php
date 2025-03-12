<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',
        'project_stage',
        'qc_message',
        'link_google_drive',
    ];

    // Relasi ke Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

