<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'submission_date',

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
