<?php

namespace App\Http\Controllers;

use App\Notifications\FeeReminderNotification;
use App\Models\Student;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function sendPortalAlert(Student $student)
    {
        $student->notify(new FeeReminderNotification());

        return back()->with('success', 'Portal alert sent successfully to ' . $student->name);
    }
}
