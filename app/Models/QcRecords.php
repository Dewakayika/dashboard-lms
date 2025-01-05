<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QcRecords extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'user_id',
        'qc_stage',
        'qc_message',
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
