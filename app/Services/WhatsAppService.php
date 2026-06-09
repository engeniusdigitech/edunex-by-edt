<?php

namespace App\Services;

use App\Models\WhatsAppLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    private static $settingsPath = 'whatsapp_settings.json';

    /**
     * Get active WhatsApp configuration.
     */
    public static function getSettings(): array
    {
        if (Storage::exists(self::$settingsPath)) {
            try {
                $content = Storage::get(self::$settingsPath);
                return json_decode($content, true) ?? self::defaultSettings();
            } catch (\Exception $e) {
                Log::error('WhatsAppService config read error: ' . $e->getMessage());
            }
        }

        return self::defaultSettings();
    }

    /**
     * Save WhatsApp configuration settings.
     */
    public static function saveSettings(array $settings): bool
    {
        $merged = array_merge(self::defaultSettings(), $settings);
        try {
            Storage::put(self::$settingsPath, json_encode($merged, JSON_PRETTY_PRINT));
            return true;
        } catch (\Exception $e) {
            Log::error('WhatsAppService config write error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Dispatch WhatsApp message (Simulate or send to Live API).
     */
    public static function sendWhatsApp(string $recipientName, ?string $recipientPhone, string $message, string $type): bool
    {
        if (empty($recipientPhone)) {
            Log::warning("WhatsApp dispatch failed: empty phone number for {$recipientName}");
            return false;
        }

        // Clean phone number: remove non-numeric
        $phone = preg_replace('/[^0-9]/', '', $recipientPhone);
        if (strlen($phone) < 10) {
            Log::warning("WhatsApp dispatch failed: invalid phone number '{$phone}' for {$recipientName}");
            return false;
        }

        $config = self::getSettings();

        if (($config['mode'] ?? 'simulator') === 'simulator') {
            // Log as simulated message
            WhatsAppLog::create([
                'recipient_name'  => $recipientName,
                'recipient_phone' => $phone,
                'message_type'    => $type,
                'message_body'    => $message,
                'status'          => 'simulated',
            ]);
            return true;
        }

        // Live API integration
        $endpoint = $config['endpoint'] ?? '';
        $authToken = $config['auth_token'] ?? '';
        $senderId = $config['sender_id'] ?? '';

        if (empty($endpoint)) {
            WhatsAppLog::create([
                'recipient_name'  => $recipientName,
                'recipient_phone' => $phone,
                'message_type'    => $type,
                'message_body'    => $message,
                'status'          => 'failed',
                'error_message'   => 'Live mode enabled but Endpoint URL is missing.',
            ]);
            return false;
        }

        try {
            // Flexible payload configuration sending to custom endpoint API
            $response = Http::timeout(10)->withHeaders([
                'Authorization' => 'Bearer ' . $authToken,
                'Accept'        => 'application/json',
            ])->post($endpoint, [
                'sender'   => $senderId,
                'to'       => $phone,
                'message'  => $message,
            ]);

            if ($response->successful()) {
                WhatsAppLog::create([
                    'recipient_name'  => $recipientName,
                    'recipient_phone' => $phone,
                    'message_type'    => $type,
                    'message_body'    => $message,
                    'status'          => 'sent',
                ]);
                return true;
            } else {
                WhatsAppLog::create([
                    'recipient_name'  => $recipientName,
                    'recipient_phone' => $phone,
                    'message_type'    => $type,
                    'message_body'    => $message,
                    'status'          => 'failed',
                    'error_message'   => 'Gateway response ' . $response->status() . ': ' . substr($response->body(), 0, 500),
                ]);
                return false;
            }
        } catch (\Exception $e) {
            WhatsAppLog::create([
                'recipient_name'  => $recipientName,
                'recipient_phone' => $phone,
                'message_type'    => $type,
                'message_body'    => $message,
                'status'          => 'failed',
                'error_message'   => 'HTTP connection error: ' . $e->getMessage(),
            ]);
            return false;
        }
    }

    /**
     * Default fallback configuration.
     */
    private static function defaultSettings(): array
    {
        return [
            'mode'       => 'simulator',
            'endpoint'   => '',
            'auth_token' => '',
            'sender_id'  => '',
        ];
    }
}
