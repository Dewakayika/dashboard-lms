<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AssignmentVote;
use App\Models\User;


class SubmissionCourse extends Model
{
    use HasFactory;

    protected $table = 'submission_course';

    // Database field
    protected $fillable = [
        'user_id',
        'course_name',
        'chapter_name',
        'submission_file',
        'thumbnail',
        'submission_date',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function votes()
    {
        return $this->hasMany(AssignmentVote::class, 'submission_id');
    }

}
