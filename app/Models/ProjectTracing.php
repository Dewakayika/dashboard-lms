<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTracing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'start_time', 'end_time', 'total_working_time', 'project_report',
        'status', 'pause_reason', 'pause_count', 'rest_count', 'date',
        'pause_logs', 'rest_logs', 'session_logs'
    ];

    protected $casts = [
        'pause_logs' => 'array',
        'rest_logs' => 'array',
        'session_logs' => 'array',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'date' => 'date',
    ];
}
