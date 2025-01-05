<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SopChecklist extends Model
{
    use HasFactory;

    protected $fillable = [
        'sop_id',
        'project_id',
        'user_id',
        'is_checked',
    ];

    // Relasi ke tabel SOP
    public function sop()
    {
        return $this->belongsTo(Sop::class);
    }

    // Relasi ke tabel Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Relasi ke tabel User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
