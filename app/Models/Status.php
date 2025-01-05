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

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Relasi ke StatusType
    public function statusType()
    {
        return $this->belongsTo(StatusType::class, 'status_type_id');
    }
}
