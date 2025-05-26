<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectRecap extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_type_id',
        'total_project',
        'total_panel',
        'periode'
    ];

    /**
     * Get the user that owns the project recap.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
