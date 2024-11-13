<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubmissionCourse;
use App\Models\User;



class AssignmentVote extends Model
{
    use HasFactory;

    protected $table = 'assignment_votes';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'submission_id',
        'voter_id',
        'vote_value',
        'vote_date',
    ];

    /**
     * Relasi ke model SubmissionCourse (karya yang di-vote)
     */
    public function submission()
    {
        return $this->belongsTo(SubmissionCourse::class, 'submission_id');
    }

    /**
     * Relasi ke model User (pengguna yang memberikan vote)
     */
    public function voter()
    {
        return $this->belongsTo(User::class, 'voter_id');
    }
}

