<?php

namespace App\Http\Controllers;

use App\Models\WhatsAppLog;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;

class WhatsAppController extends Controller
{
    public function index()
    {
        $settings = WhatsAppService::getSettings();
        $logs = WhatsAppLog::latest()->paginate(25);

        // Fetch overall metrics
        $totalCount = WhatsAppLog::count();
        $simulatedCount = WhatsAppLog::where('status', 'simulated')->count();
        $sentCount = WhatsAppLog::where('status', 'sent')->count();
        $failedCount = WhatsAppLog::where('status', 'failed')->count();

        return view('whatsapp.index', compact(
            'settings',
            'logs',
            'totalCount',
            'simulatedCount',
            'sentCount',
            'failedCount'
        ));
    }

    public function saveSettings(Request $request)
    {
        $validated = $request->validate([
            'mode'       => 'required|in:simulator,live',
            'endpoint'   => 'nullable|url',
            'auth_token' => 'nullable|string|max:255',
            'sender_id'  => 'nullable|string|max:50',
        ]);

        if (WhatsAppService::saveSettings($validated)) {
            return back()->with('success', 'WhatsApp configuration updated successfully.');
        }

        return back()->with('error', 'Failed to save configuration settings.');
    }

    public function clearLogs()
    {
        WhatsAppLog::truncate();
        return back()->with('success', 'All WhatsApp simulation and delivery logs have been cleared.');
    }
}
