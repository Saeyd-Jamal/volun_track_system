<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApprovalHierarchy extends Model
{
    use HasFactory;

    protected $fillable = [
        'specialization_id',
        'role_name',
        'order_sequence',
        'user_id',
    ];

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approvalTrackings()
    {
        return $this->hasMany(ApprovalTracking::class, 'hierarchy_level_id');
    }
}
