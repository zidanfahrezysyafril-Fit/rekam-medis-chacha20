<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    /**
     * Log an activity for the current user.
     *
     * @param string $activity
     * @return ActivityLog
     */
    public static function log(string $activity): ActivityLog
    {
        return ActivityLog::create([
            'user_id' => Auth::id(),
            'activity' => $activity,
            'ip_address' => request()->ip(),
        ]);
    }
}
