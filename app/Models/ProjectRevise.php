<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectRevise extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'project_id',
        'user_id',
        'revise_stage',
        'revise_message',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
