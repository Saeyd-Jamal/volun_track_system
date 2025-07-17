<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApprovalTracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'hierarchy_level_id',
        'action',
        'approved_by',
        'notes',
        'action_date',
    ];

    public function application()
    {
        return $this->belongsTo(VolunteerApplication::class, 'application_id');
    }

    public function hierarchyLevel()
    {
        return $this->belongsTo(ApprovalHierarchy::class, 'hierarchy_level_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
