<?php

if (!function_exists('currencySymbol')) {
    function currencySymbol($country = null) {
        $country = $country ?? auth()->user()?->institute?->country;
        $map = [
            'India' => '₹', 'USA' => '$', 'United States' => '$',
            'UK' => '£', 'United Kingdom' => '£',
            'UAE' => 'د.إ', 'United Arab Emirates' => 'د.إ',
            'Canada' => 'CA$', 'Australia' => 'A$',
            'Singapore' => 'S$', 'Malaysia' => 'RM',
            'Bangladesh' => '৳', 'Pakistan' => '₨',
            'Nepal' => 'रू', 'Sri Lanka' => 'Rs',
            'Japan' => '¥', 'China' => '¥',
            'Euro' => '€', 'Germany' => '€', 'France' => '€',
            'South Africa' => 'R', 'Nigeria' => '₦',
            'Kenya' => 'KSh', 'Ghana' => 'GH₵',
        ];
        return $map[$country] ?? '₹';
    }
}
