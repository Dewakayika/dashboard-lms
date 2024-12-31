<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use App\Models\StatusType;



class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'status_type_id',
    ];

    // Relasi ke Project
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    // Relasi ke StatusType
    public function statusType()
    {
        return $this->belongsTo(StatusType::class, 'status_type_id');
    }
}
