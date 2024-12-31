<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyProject extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'apply_projects';

    // Kolom yang boleh diisi (mass assignable)
    protected $fillable = [
        'project_id',
        'user_id',
    ];

    /**
     * Relasi ke model Project.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Relasi ke model User (talent).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

