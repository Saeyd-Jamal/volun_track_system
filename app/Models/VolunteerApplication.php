<?php

namespace App\Models;

use App\Services\ActivityLogService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerApplication extends Model
{
    use HasFactory;
    protected $table = 'volunteer_applications';

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

    // Relationships
    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function rejectedBy()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }


    // Scopes
    // دالة فحص للمراجعين لعرض الطلبات التي تخصهم
    public function scopeForReviewer(Builder $query, User $user)
    {
        return $query
            ->where('specialization_id', $user->specialization_id)
            ->where('status', 'pending')
            ->where('current_approval_level', function ($q) use ($user) {
                $q->select('order_sequence')
                    ->from('approval_hierarchies')
                    ->whereColumn('specialization_id', 'volunteer_applications.specialization_id')
                    ->where('user_id', $user->id);
            });
    }

    // Helpers
    // دوال لفحص هل هذه المرحلة الأخيرة؟
    public function isLastLevel(): bool
    {
        $max = ApprovalHierarchy::where('specialization_id', $this->specialization_id)
            ->max('order_sequence');

        return $this->current_approval_level >= $max;
    }

    // دالة لانتقال إلى المرحلة التالية
    public function moveToNextLevel(): void
    {
        $this->increment('current_approval_level');

        $nextHierarchy = ApprovalHierarchy::where('specialization_id', $this->specialization_id)
            ->where('order_sequence', $this->current_approval_level)
            ->first();
        if ($nextHierarchy) {
            // تسجيل الحدث
            ActivityLogService::log(
                'Updated',
                'VolunteerApplication',
                "تم الموافقة على طلب التطوع",
                $this->getOriginal(),
                $this->getChanges()
            );
        }else{
            $this->completeApproval();
        }
    }

    // دالة رفض الطلب
    public function reject(User $user, string $reason): void
    {
        $this->update([
            'status' => 'rejected',
            'rejected_by' => $user->id,
            'rejection_reason' => $reason,
            'completed_at' => Carbon::now(),
        ]);
        // تسجيل الحدث
        ActivityLogService::log(
            'Updated',
            'VolunteerApplication',
            "تم رفض طلب التطوع",
            $this->getOriginal(),
            $this->getChanges()
        );
    }

    // دالة قبول نهائي
    public function completeApproval(): void
    {
        $this->update([
            'current_approval_level' => $this->current_approval_level - 1,
            'status' => 'approved',
            'completed_at' => Carbon::now(),
        ]);
    }
}
