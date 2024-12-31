<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Status;


class StatusType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // Relasi ke Statuses
    public function statuses()
    {
        return $this->hasMany(Status::class, 'status_type_id');
    }
}
