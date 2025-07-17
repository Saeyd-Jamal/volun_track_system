<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VolunteerApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'specialization_id',
        'full_name',
        'email',
        'phone',
        'gender',
        'birth_date',
        'university',
        'major',
        'academic_year',
        'motivation',
        'skills',
        'previous_experience',
        'availability',
        'notes',
        'city',
        'volunteer_place',
        'file',
        'status',
        'current_approval_level',
        'rejected_by',
        'rejection_reason',
        'completed_at',
    ];

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    public function approvalTrackings()
    {
        return $this->hasMany(ApprovalTracking::class, 'application_id');
    }
}
