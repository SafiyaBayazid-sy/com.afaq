<?php

namespace App\Observers;

use App\Models\Lead;
use App\Models\LeadActivity;
use Illuminate\Support\Arr;

class LeadObserver
{
    public function created(Lead $lead): void
    {
        LeadActivity::create([
            'lead_id' => $lead->id,
            'user_id' => auth()->id(),
            'activity_type' => 'created',
            'description' => "Lead created from source: {$lead->source}.",
            'new_values' => [
                'status' => $lead->status,
                'assigned_to' => $lead->assigned_to,
            ],
        ]);
    }

    public function updated(Lead $lead): void
    {
        $changes = collect($lead->getChanges())
            ->except(['updated_at', 'last_activity_at']);

        if ($changes->isEmpty()) {
            return;
        }

        $changedKeys = $changes->keys()->all();
        $oldValues = Arr::only($lead->getOriginal(), $changedKeys);
        $newValues = $changes->all();

        $activityType = 'updated';
        $description = 'Lead details updated.';

        if (array_key_exists('status', $newValues)) {
            $activityType = 'status_changed';
            $description = "Lead status changed from {$oldValues['status']} to {$newValues['status']}.";
        } elseif (array_key_exists('assigned_to', $newValues)) {
            $activityType = 'reassigned';
            $description = 'Lead assignee was updated.';
        }

        LeadActivity::create([
            'lead_id' => $lead->id,
            'user_id' => auth()->id(),
            'activity_type' => $activityType,
            'description' => $description,
            'old_values' => $oldValues,
            'new_values' => $newValues,
        ]);
    }
}

