<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TalentReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'talent_review',
        'message'
    ];

    const RATING_OPTIONS = [
        1 => 'Needs Improvement',
        2 => 'Developing',
        3 => 'Competent',
        4 => 'Outstanding',
        5 => 'Exceptional'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
