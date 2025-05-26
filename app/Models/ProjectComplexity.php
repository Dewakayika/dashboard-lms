<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectComplexity extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'comic_name',
        'user_id',
        'complexity'
    ];

    const COMPLEXITY_OPTIONS = [
        1 => 'Very Easy',
        2 => 'Easy',
        3 => 'Medium',
        4 => 'Hard',
        5 => 'Very Hard'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // In Project.php model


}
