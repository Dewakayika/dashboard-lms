<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'role',
        'email',
        'password',
        'registration_code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the user's course progress as an array.
     */
    public function getCourseProgressAttribute()
    {
        return json_decode($this->attributes['course_progress'], true) ?? [];
    }

    // Relationships

    public function votesGiven()
    {
        return $this->hasMany(AssignmentVote::class, 'voter_id');
    }

    public function talent()
    {
        return $this->hasOne(Talent::class, 'user_id');
    }

    public function intern()
    {
        return $this->hasOne(Intern::class, 'user_id');
    }

    public function submissions()
    {
        return $this->hasMany(SubmissionCourse::class, 'user_id');
    }

    public function talentQc()
    {
        return $this->hasOne(TalentQc::class, 'user_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'talent_qc');
    }

    public function appliedProjects()
    {
        return $this->hasMany(ApplyProject::class);
    }

    public function projectRecords()
    {
        return $this->hasMany(ProjectRecord::class);
    }

    public function sopChecklists()
    {
        return $this->hasMany(SopChecklist::class);
    }

    public function qcRecords()
    {
        return $this->hasMany(QcRecords::class);
    }

    public function projectQc()
    {
        return $this->hasOne(ProjectQc::class);
    }

    // Withdrawals and e-wallets

    public function withdraws()
    {
        return $this->hasMany(Withdraw::class);
    }

    public function ewallets()
    {
        return $this->hasMany(Ewallet::class);
    }

    public function projectComplexities()
    {
        return $this->hasMany(ProjectComplexity::class);
    }

    // Reviews

    public function talentReviews()
    {
        return $this->hasMany(TalentReview::class);
    }

    public function qcReviews()
    {
        return $this->hasMany(QcReview::class);
    }
}