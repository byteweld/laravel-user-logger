<?php

declare(strict_types=1);

namespace YourVendor\UserLogger;

use Illuminate\Http\Request;
use YourVendor\UserLogger\Models\UserLog;

class UserLogger
{
    public function logFromRequest(Request $request): UserLog
    {
        $user = $request->user();

        return UserLog::create([
            'user_id' => $user?->id,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'url' => $request->fullUrl(),
            'referer' => $request->header('referer'),
            'method' => $request->method(),
            'data' => $this->getAdditionalData($request),
        ]);
    }

    protected function getAdditionalData(Request $request): ?array
    {
        $data = [];

        if (config('user-logger.log_request_data', false)) {
            $data['request'] = $request->except(
                config('user-logger.except.fields', ['password', '_token'])
            );
        }

        return ! empty($data) ? $data : null;
    }
}