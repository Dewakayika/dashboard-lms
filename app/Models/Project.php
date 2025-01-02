<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Status;





class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id', 'comic_name', 'chapter_number', 'talent_qc', 'talent',
        'number_of_panel', 'finish_date', 'file', 'status'
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function statuses()
    {
        return $this->hasMany(Status::class);
    }
    // app/Models/Project.php

    public function talent()
    {
        return $this->belongsTo(Talent::class, 'talent_id');
    }
    public function applications()
    {
        return $this->hasMany(ApplyProject::class);
    }
    // In Project.php model
    public function talentQc()
    {
        return $this->belongsTo(User::class, 'talent_qc'); // assuming 'talent_qc' is the foreign key in projects table
    }

    public function logs()
    {
        return $this->hasMany(ProjectLog::class, 'project_id');
    }
    public function projectRecords()
    {
        return $this->hasMany(ProjectRecord::class);
    }





}
