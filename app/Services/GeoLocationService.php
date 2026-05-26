<?php

namespace App\Services;

use App\Models\Institute;

class GeoLocationService
{
    public function distanceInMeters(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $earthRadius = 6371000;
        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(
            pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)
        ));

        return round($earthRadius * $angle, 2);
    }

    public function isWithinInstituteRange(Institute $institute, float $latitude, float $longitude): array
    {
        if ($institute->latitude === null || $institute->longitude === null) {
            return [
                'allowed' => false,
                'distance' => null,
                'message' => 'Institute location is not configured. Contact your administrator.',
            ];
        }

        $distance = $this->distanceInMeters(
            (float) $institute->latitude,
            (float) $institute->longitude,
            $latitude,
            $longitude
        );

        $radius = (int) ($institute->attendance_radius_meters ?? 100);

        return [
            'allowed' => $distance <= $radius,
            'distance' => (int) round($distance),
            'radius' => $radius,
            'message' => $distance <= $radius
                ? 'Within allowed range.'
                : "You are {$distance}m away. Must be within {$radius}m of the institute.",
        ];
    }

    public function geocodeAddress(string $address): ?array
    {
        $query = urlencode($address);
        $url = "https://nominatim.openstreetmap.org/search?q={$query}&format=json&limit=1";

        $context = stream_context_create([
            'http' => [
                'header' => "User-Agent: EduNex-ERP/1.0\r\n",
                'timeout' => 10,
            ],
        ]);

        $response = @file_get_contents($url, false, $context);
        if (!$response) {
            return null;
        }

        $data = json_decode($response, true);
        if (empty($data[0])) {
            return null;
        }

        return [
            'latitude' => (float) $data[0]['lat'],
            'longitude' => (float) $data[0]['lon'],
            'display_name' => $data[0]['display_name'] ?? $address,
        ];
    }
}
