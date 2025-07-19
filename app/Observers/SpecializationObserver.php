<?php

namespace App\Observers;

use App\Models\Specialization;
use App\Services\ActivityLogService;

class SpecializationObserver
{
    /**
     * Handle the Specialization "created" event.
     */
    public function created(Specialization $specialization): void
    {
        ActivityLogService::log(
            'Created',
            'Specialization',
            "تم إضافة تخصص.",
            null,
            $specialization->toArray()
        );
    }

    /**
     * Handle the Specialization "updated" event.
     */
    public function updated(Specialization $specialization): void
    {
        ActivityLogService::log(
            'Updated',
            'Specialization',
            "تم تعديل تخصص.",
            $specialization->getOriginal(),
            $specialization->getChanges()
        );
    }

    /**
     * Handle the Specialization "deleted" event.
     */
    public function deleted(Specialization $specialization): void
    {
        ActivityLogService::log(
            'Deleted',
            'Specialization',
            "تم حذف تخصص.",
            $specialization->toArray(),
            null
        );
    }

    /**
     * Handle the Specialization "restored" event.
     */
    public function restored(Specialization $specialization): void
    {
        //
    }

    /**
     * Handle the Specialization "force deleted" event.
     */
    public function forceDeleted(Specialization $specialization): void
    {
        //
    }
}
