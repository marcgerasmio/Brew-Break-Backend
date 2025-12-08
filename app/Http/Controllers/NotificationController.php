<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationRequest;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function createNotification(NotificationRequest $request)
{
    $validated = $request->validated();

    $validated['text'] = $this->generateMessage(
        $validated['notification_type'],
        $validated['status']
    );

    $notification = Notification::create($validated);

    return $notification;
}

private function generateMessage(string $type, string $status): string
{
    return match ($type) {
        'attendance' => match ($status) {
            'check_in' => 'Clocked In.',
            'check_out' => 'Clocked Out.',
            default => 'Attendance Updated.',
        },

        'leave' => match ($status) {
            'approved' => 'Leave Approved',
            'rejected' => 'Leave Rejected',
            default => 'Leave Request',
        },

        default => 'You have a new notification.',
    };
}

   public function index()
    {
        return Notification::all();
    }

    public function byEmployeeNotification(string $id)
    {
        $notification = Notification::where('user_id', $id)
            ->get();

        return $notification;
    }
}
