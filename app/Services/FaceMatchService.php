<?php

namespace App\Services;

class FaceMatchService
{
    /** Euclidean distance threshold (face-api.js standard ~0.6) */
    public const MATCH_THRESHOLD = 0.55;

    public function matches(array $storedDescriptor, array $liveDescriptor): array
    {
        if (count($storedDescriptor) !== 128 || count($liveDescriptor) !== 128) {
            return [
                'matched' => false,
                'distance' => null,
                'message' => 'Invalid face data. Please re-enroll your face with admin.',
            ];
        }

        $distance = $this->euclideanDistance($storedDescriptor, $liveDescriptor);

        return [
            'matched' => $distance < self::MATCH_THRESHOLD,
            'distance' => round($distance, 4),
            'threshold' => self::MATCH_THRESHOLD,
            'message' => $distance < self::MATCH_THRESHOLD
                ? 'Face verified successfully.'
                : 'Face does not match enrolled profile. Please try again in good lighting.',
        ];
    }

    public function euclideanDistance(array $a, array $b): float
    {
        $sum = 0.0;
        for ($i = 0; $i < 128; $i++) {
            $diff = (float) $a[$i] - (float) $b[$i];
            $sum += $diff * $diff;
        }

        return sqrt($sum);
    }

    public function parseDescriptor(?string $json): ?array
    {
        if (!$json) {
            return null;
        }

        $decoded = json_decode($json, true);
        if (!is_array($decoded)) {
            return null;
        }

        if (isset($decoded['descriptor']) && is_array($decoded['descriptor'])) {
            return $decoded['descriptor'];
        }

        return is_array($decoded) && count($decoded) === 128 ? $decoded : null;
    }
}
