<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SeoLandingController extends Controller
{
    private $locations = [
        // Top Tier Indian Cities
        'mumbai' => ['city' => 'Mumbai', 'country' => 'India'],
        'delhi' => ['city' => 'Delhi', 'country' => 'India'],
        'bangalore' => ['city' => 'Bangalore', 'country' => 'India'],
        'hyderabad' => ['city' => 'Hyderabad', 'country' => 'India'],
        'chennai' => ['city' => 'Chennai', 'country' => 'India'],
        'kolkata' => ['city' => 'Kolkata', 'country' => 'India'],
        'pune' => ['city' => 'Pune', 'country' => 'India'],
        'ahmedabad' => ['city' => 'Ahmedabad', 'country' => 'India'],
        'jaipur' => ['city' => 'Jaipur', 'country' => 'India'],
        'surat' => ['city' => 'Surat', 'country' => 'India'],
        'lucknow' => ['city' => 'Lucknow', 'country' => 'India'],
        'kanpur' => ['city' => 'Kanpur', 'country' => 'India'],
        'nagpur' => ['city' => 'Nagpur', 'country' => 'India'],
        'indore' => ['city' => 'Indore', 'country' => 'India'],
        'thane' => ['city' => 'Thane', 'country' => 'India'],
        'bhopal' => ['city' => 'Bhopal', 'country' => 'India'],
        'visakhapatnam' => ['city' => 'Visakhapatnam', 'country' => 'India'],
        'patna' => ['city' => 'Patna', 'country' => 'India'],
        'vadodara' => ['city' => 'Vadodara', 'country' => 'India'],
        'ghaziabad' => ['city' => 'Ghaziabad', 'country' => 'India'],
        'ludhiana' => ['city' => 'Ludhiana', 'country' => 'India'],
        'agra' => ['city' => 'Agra', 'country' => 'India'],
        'nashik' => ['city' => 'Nashik', 'country' => 'India'],
        'faridabad' => ['city' => 'Faridabad', 'country' => 'India'],
        'meerut' => ['city' => 'Meerut', 'country' => 'India'],
        'rajkot' => ['city' => 'Rajkot', 'country' => 'India'],
        'varanasi' => ['city' => 'Varanasi', 'country' => 'India'],
        'srinagar' => ['city' => 'Srinagar', 'country' => 'India'],
        'aurangabad' => ['city' => 'Aurangabad', 'country' => 'India'],
        'dhanbad' => ['city' => 'Dhanbad', 'country' => 'India'],
        'amritsar' => ['city' => 'Amritsar', 'country' => 'India'],
        'navi-mumbai' => ['city' => 'Navi Mumbai', 'country' => 'India'],
        'allahabad' => ['city' => 'Allahabad', 'country' => 'India'],
        'howrah' => ['city' => 'Howrah', 'country' => 'India'],
        'ranchi' => ['city' => 'Ranchi', 'country' => 'India'],
        'gwalior' => ['city' => 'Gwalior', 'country' => 'India'],
        'jabalpur' => ['city' => 'Jabalpur', 'country' => 'India'],
        'coimbatore' => ['city' => 'Coimbatore', 'country' => 'India'],
        'vijayawada' => ['city' => 'Vijayawada', 'country' => 'India'],
        'jodhpur' => ['city' => 'Jodhpur', 'country' => 'India'],
        'madurai' => ['city' => 'Madurai', 'country' => 'India'],
        'raipur' => ['city' => 'Raipur', 'country' => 'India'],
        'kota' => ['city' => 'Kota', 'country' => 'India'],
        'guwahati' => ['city' => 'Guwahati', 'country' => 'India'],
        'chandigarh' => ['city' => 'Chandigarh', 'country' => 'India'],
        'solapur' => ['city' => 'Solapur', 'country' => 'India'],
        'bareilly' => ['city' => 'Bareilly', 'country' => 'India'],
        'moradabad' => ['city' => 'Moradabad', 'country' => 'India'],
        'mysore' => ['city' => 'Mysore', 'country' => 'India'],
        'gurgaon' => ['city' => 'Gurgaon', 'country' => 'India'],
        'aligarh' => ['city' => 'Aligarh', 'country' => 'India'],
        'jalandhar' => ['city' => 'Jalandhar', 'country' => 'India'],
        'bhubaneswar' => ['city' => 'Bhubaneswar', 'country' => 'India'],
        'trivandrum' => ['city' => 'Thiruvananthapuram', 'country' => 'India'],
        'kochi' => ['city' => 'Kochi', 'country' => 'India'],
        'dehradun' => ['city' => 'Dehradun', 'country' => 'India'],
        'bikaner' => ['city' => 'Bikaner', 'country' => 'India'],
        'noida' => ['city' => 'Noida', 'country' => 'India'],
        'jamshedpur' => ['city' => 'Jamshedpur', 'country' => 'India'],
        'bhilai' => ['city' => 'Bhilai', 'country' => 'India'],
        'cuttack' => ['city' => 'Cuttack', 'country' => 'India'],
        'ajmer' => ['city' => 'Ajmer', 'country' => 'India'],
        'udaipur' => ['city' => 'Udaipur', 'country' => 'India'],
        'kolhapur' => ['city' => 'Kolhapur', 'country' => 'India'],
        'jammu' => ['city' => 'Jammu', 'country' => 'India'],
        'mangalore' => ['city' => 'Mangalore', 'country' => 'India'],
        'belgaum' => ['city' => 'Belgaum', 'country' => 'India'],

        // Major Global Cities for scaling
        'new-york' => ['city' => 'New York', 'country' => 'USA'],
        'london' => ['city' => 'London', 'country' => 'UK'],
        'dubai' => ['city' => 'Dubai', 'country' => 'UAE'],
        'singapore' => ['city' => 'Singapore', 'country' => 'Singapore'],
        'sydney' => ['city' => 'Sydney', 'country' => 'Australia'],
        'toronto' => ['city' => 'Toronto', 'country' => 'Canada'],
        'tokyo' => ['city' => 'Tokyo', 'country' => 'Japan'],
        'paris' => ['city' => 'Paris', 'country' => 'France'],
        'berlin' => ['city' => 'Berlin', 'country' => 'Germany'],
        'los-angeles' => ['city' => 'Los Angeles', 'country' => 'USA'],
        'chicago' => ['city' => 'Chicago', 'country' => 'USA'],
        'melbourne' => ['city' => 'Melbourne', 'country' => 'Australia'],
        'hong-kong' => ['city' => 'Hong Kong', 'country' => 'Hong Kong'],
        'amsterdam' => ['city' => 'Amsterdam', 'country' => 'Netherlands'],
        'seoul' => ['city' => 'Seoul', 'country' => 'South Korea'],
        'san-francisco' => ['city' => 'San Francisco', 'country' => 'USA'],
        'miami' => ['city' => 'Miami', 'country' => 'USA'],
        'riyadh' => ['city' => 'Riyadh', 'country' => 'Saudi Arabia'],
        'kuala-lumpur' => ['city' => 'Kuala Lumpur', 'country' => 'Malaysia'],
        'johannesburg' => ['city' => 'Johannesburg', 'country' => 'South Africa'],
        'cape-town' => ['city' => 'Cape Town', 'country' => 'South Africa'],
        'nairobi' => ['city' => 'Nairobi', 'country' => 'Kenya'],
        'lagos' => ['city' => 'Lagos', 'country' => 'Nigeria'],
        'abudhabi' => ['city' => 'Abu Dhabi', 'country' => 'UAE'],
        'doha' => ['city' => 'Doha', 'country' => 'Qatar'],
        'dhaka' => ['city' => 'Dhaka', 'country' => 'Bangladesh'],
        'colombo' => ['city' => 'Colombo', 'country' => 'Sri Lanka'],
        'kathmandu' => ['city' => 'Kathmandu', 'country' => 'Nepal'],
    ];

    public function landing($citySlug)
    {
        if (!array_key_exists($citySlug, $this->locations)) {
            // Unmapped slug? Redirect to home.
            return redirect('/');
        }

        $locationInfo = $this->locations[$citySlug];
        $city = $locationInfo['city'];
        $country = $locationInfo['country'];

        return view('seo-landing', compact('city', 'country'));
    }

    public function sitemap()
    {
        $locations = $this->locations;
        return response()->view('sitemap', compact('locations'))
                         ->header('Content-Type', 'text/xml');
    }
}
