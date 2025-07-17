<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Specialization extends Model
{

    use HasFactory;
    
     protected $fillable = [
        'name',
        'is_active',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function approvalHierarchies()
    {
        return $this->hasMany(ApprovalHierarchy::class);
    }

    public function volunteerApplications()
    {
        return $this->hasMany(VolunteerApplication::class);
    }
}
