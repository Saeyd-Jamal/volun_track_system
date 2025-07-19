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

    // Relationship
    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
