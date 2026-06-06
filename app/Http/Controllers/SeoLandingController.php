<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SeoLandingController extends Controller
{
    // ─── Location Data ─────────────────────────────────────────────────────────

    /**
     * All cities with enriched state + country metadata.
     * state_slug / country_slug are used to build deep URLs.
     */
    public static function getLocations(): array
    {
        return [
            // ── Tier-1 Indian Cities ──────────────────────────────────────────
            'mumbai'        => ['city' => 'Mumbai',        'state' => 'Maharashtra',     'state_slug' => 'maharashtra',     'country' => 'India', 'country_slug' => 'india'],
            'delhi'         => ['city' => 'Delhi',         'state' => 'Delhi',           'state_slug' => 'delhi',           'country' => 'India', 'country_slug' => 'india'],
            'bangalore'     => ['city' => 'Bangalore',     'state' => 'Karnataka',       'state_slug' => 'karnataka',       'country' => 'India', 'country_slug' => 'india'],
            'hyderabad'     => ['city' => 'Hyderabad',     'state' => 'Telangana',       'state_slug' => 'telangana',       'country' => 'India', 'country_slug' => 'india'],
            'chennai'       => ['city' => 'Chennai',       'state' => 'Tamil Nadu',      'state_slug' => 'tamil-nadu',      'country' => 'India', 'country_slug' => 'india'],
            'kolkata'       => ['city' => 'Kolkata',       'state' => 'West Bengal',     'state_slug' => 'west-bengal',     'country' => 'India', 'country_slug' => 'india'],
            'pune'          => ['city' => 'Pune',          'state' => 'Maharashtra',     'state_slug' => 'maharashtra',     'country' => 'India', 'country_slug' => 'india'],
            'ahmedabad'     => ['city' => 'Ahmedabad',     'state' => 'Gujarat',         'state_slug' => 'gujarat',         'country' => 'India', 'country_slug' => 'india'],
            'jaipur'        => ['city' => 'Jaipur',        'state' => 'Rajasthan',       'state_slug' => 'rajasthan',       'country' => 'India', 'country_slug' => 'india'],
            'surat'         => ['city' => 'Surat',         'state' => 'Gujarat',         'state_slug' => 'gujarat',         'country' => 'India', 'country_slug' => 'india'],
            'lucknow'       => ['city' => 'Lucknow',       'state' => 'Uttar Pradesh',   'state_slug' => 'uttar-pradesh',   'country' => 'India', 'country_slug' => 'india'],
            'kanpur'        => ['city' => 'Kanpur',        'state' => 'Uttar Pradesh',   'state_slug' => 'uttar-pradesh',   'country' => 'India', 'country_slug' => 'india'],
            'nagpur'        => ['city' => 'Nagpur',        'state' => 'Maharashtra',     'state_slug' => 'maharashtra',     'country' => 'India', 'country_slug' => 'india'],
            'indore'        => ['city' => 'Indore',        'state' => 'Madhya Pradesh',  'state_slug' => 'madhya-pradesh',  'country' => 'India', 'country_slug' => 'india'],
            'thane'         => ['city' => 'Thane',         'state' => 'Maharashtra',     'state_slug' => 'maharashtra',     'country' => 'India', 'country_slug' => 'india'],
            'bhopal'        => ['city' => 'Bhopal',        'state' => 'Madhya Pradesh',  'state_slug' => 'madhya-pradesh',  'country' => 'India', 'country_slug' => 'india'],
            'visakhapatnam' => ['city' => 'Visakhapatnam', 'state' => 'Andhra Pradesh',  'state_slug' => 'andhra-pradesh',  'country' => 'India', 'country_slug' => 'india'],
            'patna'         => ['city' => 'Patna',         'state' => 'Bihar',           'state_slug' => 'bihar',           'country' => 'India', 'country_slug' => 'india'],
            'vadodara'      => ['city' => 'Vadodara',      'state' => 'Gujarat',         'state_slug' => 'gujarat',         'country' => 'India', 'country_slug' => 'india'],
            'ghaziabad'     => ['city' => 'Ghaziabad',     'state' => 'Uttar Pradesh',   'state_slug' => 'uttar-pradesh',   'country' => 'India', 'country_slug' => 'india'],
            'ludhiana'      => ['city' => 'Ludhiana',      'state' => 'Punjab',          'state_slug' => 'punjab',          'country' => 'India', 'country_slug' => 'india'],
            'agra'          => ['city' => 'Agra',          'state' => 'Uttar Pradesh',   'state_slug' => 'uttar-pradesh',   'country' => 'India', 'country_slug' => 'india'],
            'nashik'        => ['city' => 'Nashik',        'state' => 'Maharashtra',     'state_slug' => 'maharashtra',     'country' => 'India', 'country_slug' => 'india'],
            'faridabad'     => ['city' => 'Faridabad',     'state' => 'Haryana',         'state_slug' => 'haryana',         'country' => 'India', 'country_slug' => 'india'],
            'meerut'        => ['city' => 'Meerut',        'state' => 'Uttar Pradesh',   'state_slug' => 'uttar-pradesh',   'country' => 'India', 'country_slug' => 'india'],
            'rajkot'        => ['city' => 'Rajkot',        'state' => 'Gujarat',         'state_slug' => 'gujarat',         'country' => 'India', 'country_slug' => 'india'],
            'varanasi'      => ['city' => 'Varanasi',      'state' => 'Uttar Pradesh',   'state_slug' => 'uttar-pradesh',   'country' => 'India', 'country_slug' => 'india'],
            'srinagar'      => ['city' => 'Srinagar',      'state' => 'Jammu & Kashmir', 'state_slug' => 'jammu-and-kashmir','country' => 'India', 'country_slug' => 'india'],
            'aurangabad'    => ['city' => 'Aurangabad',    'state' => 'Maharashtra',     'state_slug' => 'maharashtra',     'country' => 'India', 'country_slug' => 'india'],
            'dhanbad'       => ['city' => 'Dhanbad',       'state' => 'Jharkhand',       'state_slug' => 'jharkhand',       'country' => 'India', 'country_slug' => 'india'],
            'amritsar'      => ['city' => 'Amritsar',      'state' => 'Punjab',          'state_slug' => 'punjab',          'country' => 'India', 'country_slug' => 'india'],
            'navi-mumbai'   => ['city' => 'Navi Mumbai',   'state' => 'Maharashtra',     'state_slug' => 'maharashtra',     'country' => 'India', 'country_slug' => 'india'],
            'allahabad'     => ['city' => 'Allahabad',     'state' => 'Uttar Pradesh',   'state_slug' => 'uttar-pradesh',   'country' => 'India', 'country_slug' => 'india'],
            'howrah'        => ['city' => 'Howrah',        'state' => 'West Bengal',     'state_slug' => 'west-bengal',     'country' => 'India', 'country_slug' => 'india'],
            'ranchi'        => ['city' => 'Ranchi',        'state' => 'Jharkhand',       'state_slug' => 'jharkhand',       'country' => 'India', 'country_slug' => 'india'],
            'gwalior'       => ['city' => 'Gwalior',       'state' => 'Madhya Pradesh',  'state_slug' => 'madhya-pradesh',  'country' => 'India', 'country_slug' => 'india'],
            'jabalpur'      => ['city' => 'Jabalpur',      'state' => 'Madhya Pradesh',  'state_slug' => 'madhya-pradesh',  'country' => 'India', 'country_slug' => 'india'],
            'coimbatore'    => ['city' => 'Coimbatore',    'state' => 'Tamil Nadu',      'state_slug' => 'tamil-nadu',      'country' => 'India', 'country_slug' => 'india'],
            'vijayawada'    => ['city' => 'Vijayawada',    'state' => 'Andhra Pradesh',  'state_slug' => 'andhra-pradesh',  'country' => 'India', 'country_slug' => 'india'],
            'jodhpur'       => ['city' => 'Jodhpur',       'state' => 'Rajasthan',       'state_slug' => 'rajasthan',       'country' => 'India', 'country_slug' => 'india'],
            'madurai'       => ['city' => 'Madurai',       'state' => 'Tamil Nadu',      'state_slug' => 'tamil-nadu',      'country' => 'India', 'country_slug' => 'india'],
            'raipur'        => ['city' => 'Raipur',        'state' => 'Chhattisgarh',    'state_slug' => 'chhattisgarh',    'country' => 'India', 'country_slug' => 'india'],
            'kota'          => ['city' => 'Kota',          'state' => 'Rajasthan',       'state_slug' => 'rajasthan',       'country' => 'India', 'country_slug' => 'india'],
            'guwahati'      => ['city' => 'Guwahati',      'state' => 'Assam',           'state_slug' => 'assam',           'country' => 'India', 'country_slug' => 'india'],
            'chandigarh'    => ['city' => 'Chandigarh',    'state' => 'Chandigarh',      'state_slug' => 'chandigarh',      'country' => 'India', 'country_slug' => 'india'],
            'solapur'       => ['city' => 'Solapur',       'state' => 'Maharashtra',     'state_slug' => 'maharashtra',     'country' => 'India', 'country_slug' => 'india'],
            'bareilly'      => ['city' => 'Bareilly',      'state' => 'Uttar Pradesh',   'state_slug' => 'uttar-pradesh',   'country' => 'India', 'country_slug' => 'india'],
            'moradabad'     => ['city' => 'Moradabad',     'state' => 'Uttar Pradesh',   'state_slug' => 'uttar-pradesh',   'country' => 'India', 'country_slug' => 'india'],
            'mysore'        => ['city' => 'Mysore',        'state' => 'Karnataka',       'state_slug' => 'karnataka',       'country' => 'India', 'country_slug' => 'india'],
            'gurgaon'       => ['city' => 'Gurgaon',       'state' => 'Haryana',         'state_slug' => 'haryana',         'country' => 'India', 'country_slug' => 'india'],
            'aligarh'       => ['city' => 'Aligarh',       'state' => 'Uttar Pradesh',   'state_slug' => 'uttar-pradesh',   'country' => 'India', 'country_slug' => 'india'],
            'jalandhar'     => ['city' => 'Jalandhar',     'state' => 'Punjab',          'state_slug' => 'punjab',          'country' => 'India', 'country_slug' => 'india'],
            'bhubaneswar'   => ['city' => 'Bhubaneswar',   'state' => 'Odisha',          'state_slug' => 'odisha',          'country' => 'India', 'country_slug' => 'india'],
            'trivandrum'    => ['city' => 'Thiruvananthapuram','state' => 'Kerala',       'state_slug' => 'kerala',          'country' => 'India', 'country_slug' => 'india'],
            'kochi'         => ['city' => 'Kochi',         'state' => 'Kerala',          'state_slug' => 'kerala',          'country' => 'India', 'country_slug' => 'india'],
            'dehradun'      => ['city' => 'Dehradun',      'state' => 'Uttarakhand',     'state_slug' => 'uttarakhand',     'country' => 'India', 'country_slug' => 'india'],
            'bikaner'       => ['city' => 'Bikaner',       'state' => 'Rajasthan',       'state_slug' => 'rajasthan',       'country' => 'India', 'country_slug' => 'india'],
            'noida'         => ['city' => 'Noida',         'state' => 'Uttar Pradesh',   'state_slug' => 'uttar-pradesh',   'country' => 'India', 'country_slug' => 'india'],
            'jamshedpur'    => ['city' => 'Jamshedpur',    'state' => 'Jharkhand',       'state_slug' => 'jharkhand',       'country' => 'India', 'country_slug' => 'india'],
            'bhilai'        => ['city' => 'Bhilai',        'state' => 'Chhattisgarh',    'state_slug' => 'chhattisgarh',    'country' => 'India', 'country_slug' => 'india'],
            'cuttack'       => ['city' => 'Cuttack',       'state' => 'Odisha',          'state_slug' => 'odisha',          'country' => 'India', 'country_slug' => 'india'],
            'ajmer'         => ['city' => 'Ajmer',         'state' => 'Rajasthan',       'state_slug' => 'rajasthan',       'country' => 'India', 'country_slug' => 'india'],
            'udaipur'       => ['city' => 'Udaipur',       'state' => 'Rajasthan',       'state_slug' => 'rajasthan',       'country' => 'India', 'country_slug' => 'india'],
            'kolhapur'      => ['city' => 'Kolhapur',      'state' => 'Maharashtra',     'state_slug' => 'maharashtra',     'country' => 'India', 'country_slug' => 'india'],
            'jammu'         => ['city' => 'Jammu',         'state' => 'Jammu & Kashmir', 'state_slug' => 'jammu-and-kashmir','country' => 'India', 'country_slug' => 'india'],
            'mangalore'     => ['city' => 'Mangalore',     'state' => 'Karnataka',       'state_slug' => 'karnataka',       'country' => 'India', 'country_slug' => 'india'],
            'belgaum'       => ['city' => 'Belgaum',       'state' => 'Karnataka',       'state_slug' => 'karnataka',       'country' => 'India', 'country_slug' => 'india'],
            'palanpur'      => ['city' => 'Palanpur',      'state' => 'Gujarat',         'state_slug' => 'gujarat',         'country' => 'India', 'country_slug' => 'india'],
            'tiruppur'      => ['city' => 'Tiruppur',      'state' => 'Tamil Nadu',      'state_slug' => 'tamil-nadu',      'country' => 'India', 'country_slug' => 'india'],
            'siliguri'      => ['city' => 'Siliguri',      'state' => 'West Bengal',     'state_slug' => 'west-bengal',     'country' => 'India', 'country_slug' => 'india'],
            'patiala'       => ['city' => 'Patiala',       'state' => 'Punjab',          'state_slug' => 'punjab',          'country' => 'India', 'country_slug' => 'india'],
            'rohtak'        => ['city' => 'Rohtak',        'state' => 'Haryana',         'state_slug' => 'haryana',         'country' => 'India', 'country_slug' => 'india'],
            'hisar'         => ['city' => 'Hisar',         'state' => 'Haryana',         'state_slug' => 'haryana',         'country' => 'India', 'country_slug' => 'india'],
            'panipat'       => ['city' => 'Panipat',       'state' => 'Haryana',         'state_slug' => 'haryana',         'country' => 'India', 'country_slug' => 'india'],
            'gorakhpur'     => ['city' => 'Gorakhpur',     'state' => 'Uttar Pradesh',   'state_slug' => 'uttar-pradesh',   'country' => 'India', 'country_slug' => 'india'],
            'hubli'         => ['city' => 'Hubli',         'state' => 'Karnataka',       'state_slug' => 'karnataka',       'country' => 'India', 'country_slug' => 'india'],
            'mysuru'        => ['city' => 'Mysuru',        'state' => 'Karnataka',       'state_slug' => 'karnataka',       'country' => 'India', 'country_slug' => 'india'],
            'shimla'        => ['city' => 'Shimla',        'state' => 'Himachal Pradesh','state_slug' => 'himachal-pradesh','country' => 'India', 'country_slug' => 'india'],
            'haridwar'      => ['city' => 'Haridwar',      'state' => 'Uttarakhand',     'state_slug' => 'uttarakhand',     'country' => 'India', 'country_slug' => 'india'],
            'pondicherry'   => ['city' => 'Pondicherry',   'state' => 'Puducherry',      'state_slug' => 'puducherry',      'country' => 'India', 'country_slug' => 'india'],
            'goa'           => ['city' => 'Goa',           'state' => 'Goa',             'state_slug' => 'goa',             'country' => 'India', 'country_slug' => 'india'],

            // ── Global Cities ─────────────────────────────────────────────────
            'new-york'      => ['city' => 'New York',      'state' => 'New York',        'state_slug' => 'new-york',        'country' => 'USA',          'country_slug' => 'usa'],
            'london'        => ['city' => 'London',        'state' => 'England',         'state_slug' => 'england',         'country' => 'UK',           'country_slug' => 'uk'],
            'dubai'         => ['city' => 'Dubai',         'state' => 'Dubai',           'state_slug' => 'dubai',           'country' => 'UAE',          'country_slug' => 'uae'],
            'singapore'     => ['city' => 'Singapore',     'state' => 'Singapore',       'state_slug' => 'singapore',       'country' => 'Singapore',    'country_slug' => 'singapore'],
            'sydney'        => ['city' => 'Sydney',        'state' => 'New South Wales', 'state_slug' => 'new-south-wales', 'country' => 'Australia',    'country_slug' => 'australia'],
            'toronto'       => ['city' => 'Toronto',       'state' => 'Ontario',         'state_slug' => 'ontario',         'country' => 'Canada',       'country_slug' => 'canada'],
            'tokyo'         => ['city' => 'Tokyo',         'state' => 'Tokyo',           'state_slug' => 'tokyo',           'country' => 'Japan',        'country_slug' => 'japan'],
            'paris'         => ['city' => 'Paris',         'state' => 'Île-de-France',   'state_slug' => 'ile-de-france',   'country' => 'France',       'country_slug' => 'france'],
            'berlin'        => ['city' => 'Berlin',        'state' => 'Berlin',          'state_slug' => 'berlin',          'country' => 'Germany',      'country_slug' => 'germany'],
            'los-angeles'   => ['city' => 'Los Angeles',   'state' => 'California',      'state_slug' => 'california',      'country' => 'USA',          'country_slug' => 'usa'],
            'chicago'       => ['city' => 'Chicago',       'state' => 'Illinois',        'state_slug' => 'illinois',        'country' => 'USA',          'country_slug' => 'usa'],
            'melbourne'     => ['city' => 'Melbourne',     'state' => 'Victoria',        'state_slug' => 'victoria',        'country' => 'Australia',    'country_slug' => 'australia'],
            'hong-kong'     => ['city' => 'Hong Kong',     'state' => 'Hong Kong',       'state_slug' => 'hong-kong',       'country' => 'Hong Kong',    'country_slug' => 'hong-kong'],
            'amsterdam'     => ['city' => 'Amsterdam',     'state' => 'North Holland',   'state_slug' => 'north-holland',   'country' => 'Netherlands',  'country_slug' => 'netherlands'],
            'seoul'         => ['city' => 'Seoul',         'state' => 'Seoul',           'state_slug' => 'seoul',           'country' => 'South Korea',  'country_slug' => 'south-korea'],
            'san-francisco' => ['city' => 'San Francisco', 'state' => 'California',      'state_slug' => 'california',      'country' => 'USA',          'country_slug' => 'usa'],
            'miami'         => ['city' => 'Miami',         'state' => 'Florida',         'state_slug' => 'florida',         'country' => 'USA',          'country_slug' => 'usa'],
            'riyadh'        => ['city' => 'Riyadh',        'state' => 'Riyadh',          'state_slug' => 'riyadh',          'country' => 'Saudi Arabia', 'country_slug' => 'saudi-arabia'],
            'kuala-lumpur'  => ['city' => 'Kuala Lumpur',  'state' => 'Kuala Lumpur',    'state_slug' => 'kuala-lumpur',    'country' => 'Malaysia',     'country_slug' => 'malaysia'],
            'johannesburg'  => ['city' => 'Johannesburg',  'state' => 'Gauteng',         'state_slug' => 'gauteng',         'country' => 'South Africa', 'country_slug' => 'south-africa'],
            'cape-town'     => ['city' => 'Cape Town',     'state' => 'Western Cape',    'state_slug' => 'western-cape',    'country' => 'South Africa', 'country_slug' => 'south-africa'],
            'nairobi'       => ['city' => 'Nairobi',       'state' => 'Nairobi',         'state_slug' => 'nairobi',         'country' => 'Kenya',        'country_slug' => 'kenya'],
            'lagos'         => ['city' => 'Lagos',         'state' => 'Lagos',           'state_slug' => 'lagos',           'country' => 'Nigeria',      'country_slug' => 'nigeria'],
            'abudhabi'      => ['city' => 'Abu Dhabi',     'state' => 'Abu Dhabi',       'state_slug' => 'abu-dhabi',       'country' => 'UAE',          'country_slug' => 'uae'],
            'doha'          => ['city' => 'Doha',          'state' => 'Doha',            'state_slug' => 'doha',            'country' => 'Qatar',        'country_slug' => 'qatar'],
            'dhaka'         => ['city' => 'Dhaka',         'state' => 'Dhaka',           'state_slug' => 'dhaka',           'country' => 'Bangladesh',   'country_slug' => 'bangladesh'],
            'colombo'       => ['city' => 'Colombo',       'state' => 'Western Province','state_slug' => 'western-province','country' => 'Sri Lanka',    'country_slug' => 'sri-lanka'],
            'kathmandu'     => ['city' => 'Kathmandu',     'state' => 'Bagmati',         'state_slug' => 'bagmati',         'country' => 'Nepal',        'country_slug' => 'nepal'],
        ];
    }

    // ── Legacy property alias so old $this->locations references still work ──
    private $locations = [];

    public function __construct()
    {
        $this->locations = self::getLocations();
    }

    // ─── States (Indian States & Union Territories) ────────────────────────────

    public static function getStates(): array
    {
        return [
            // 28 States
            'andhra-pradesh'      => ['name' => 'Andhra Pradesh',      'country' => 'India', 'country_slug' => 'india'],
            'arunachal-pradesh'   => ['name' => 'Arunachal Pradesh',   'country' => 'India', 'country_slug' => 'india'],
            'assam'               => ['name' => 'Assam',               'country' => 'India', 'country_slug' => 'india'],
            'bihar'               => ['name' => 'Bihar',               'country' => 'India', 'country_slug' => 'india'],
            'chhattisgarh'        => ['name' => 'Chhattisgarh',        'country' => 'India', 'country_slug' => 'india'],
            'goa'                 => ['name' => 'Goa',                 'country' => 'India', 'country_slug' => 'india'],
            'gujarat'             => ['name' => 'Gujarat',             'country' => 'India', 'country_slug' => 'india'],
            'haryana'             => ['name' => 'Haryana',             'country' => 'India', 'country_slug' => 'india'],
            'himachal-pradesh'    => ['name' => 'Himachal Pradesh',    'country' => 'India', 'country_slug' => 'india'],
            'jharkhand'           => ['name' => 'Jharkhand',           'country' => 'India', 'country_slug' => 'india'],
            'karnataka'           => ['name' => 'Karnataka',           'country' => 'India', 'country_slug' => 'india'],
            'kerala'              => ['name' => 'Kerala',              'country' => 'India', 'country_slug' => 'india'],
            'madhya-pradesh'      => ['name' => 'Madhya Pradesh',      'country' => 'India', 'country_slug' => 'india'],
            'maharashtra'         => ['name' => 'Maharashtra',         'country' => 'India', 'country_slug' => 'india'],
            'manipur'             => ['name' => 'Manipur',             'country' => 'India', 'country_slug' => 'india'],
            'meghalaya'           => ['name' => 'Meghalaya',           'country' => 'India', 'country_slug' => 'india'],
            'mizoram'             => ['name' => 'Mizoram',             'country' => 'India', 'country_slug' => 'india'],
            'nagaland'            => ['name' => 'Nagaland',            'country' => 'India', 'country_slug' => 'india'],
            'odisha'              => ['name' => 'Odisha',              'country' => 'India', 'country_slug' => 'india'],
            'punjab'              => ['name' => 'Punjab',              'country' => 'India', 'country_slug' => 'india'],
            'rajasthan'           => ['name' => 'Rajasthan',           'country' => 'India', 'country_slug' => 'india'],
            'sikkim'              => ['name' => 'Sikkim',              'country' => 'India', 'country_slug' => 'india'],
            'tamil-nadu'          => ['name' => 'Tamil Nadu',          'country' => 'India', 'country_slug' => 'india'],
            'telangana'           => ['name' => 'Telangana',           'country' => 'India', 'country_slug' => 'india'],
            'tripura'             => ['name' => 'Tripura',             'country' => 'India', 'country_slug' => 'india'],
            'uttar-pradesh'       => ['name' => 'Uttar Pradesh',       'country' => 'India', 'country_slug' => 'india'],
            'uttarakhand'         => ['name' => 'Uttarakhand',         'country' => 'India', 'country_slug' => 'india'],
            'west-bengal'         => ['name' => 'West Bengal',         'country' => 'India', 'country_slug' => 'india'],
            // 8 Union Territories
            'andaman-and-nicobar' => ['name' => 'Andaman and Nicobar Islands', 'country' => 'India', 'country_slug' => 'india'],
            'chandigarh'          => ['name' => 'Chandigarh',          'country' => 'India', 'country_slug' => 'india'],
            'delhi'               => ['name' => 'Delhi',               'country' => 'India', 'country_slug' => 'india'],
            'jammu-and-kashmir'   => ['name' => 'Jammu & Kashmir',     'country' => 'India', 'country_slug' => 'india'],
            'ladakh'              => ['name' => 'Ladakh',              'country' => 'India', 'country_slug' => 'india'],
            'lakshadweep'         => ['name' => 'Lakshadweep',         'country' => 'India', 'country_slug' => 'india'],
            'puducherry'          => ['name' => 'Puducherry',          'country' => 'India', 'country_slug' => 'india'],
        ];
    }

    // ─── Countries ─────────────────────────────────────────────────────────────

    public static function getCountries(): array
    {
        return [
            'india'        => ['name' => 'India'],
            'usa'          => ['name' => 'USA'],
            'uk'           => ['name' => 'UK'],
            'uae'          => ['name' => 'UAE'],
            'canada'       => ['name' => 'Canada'],
            'australia'    => ['name' => 'Australia'],
            'singapore'    => ['name' => 'Singapore'],
            'saudi-arabia' => ['name' => 'Saudi Arabia'],
            'qatar'        => ['name' => 'Qatar'],
            'kuwait'       => ['name' => 'Kuwait'],
            'oman'         => ['name' => 'Oman'],
            'bahrain'      => ['name' => 'Bahrain'],
            'nepal'        => ['name' => 'Nepal'],
            'bangladesh'   => ['name' => 'Bangladesh'],
            'sri-lanka'    => ['name' => 'Sri Lanka'],
            'malaysia'     => ['name' => 'Malaysia'],
            'south-africa' => ['name' => 'South Africa'],
            'kenya'        => ['name' => 'Kenya'],
            'nigeria'      => ['name' => 'Nigeria'],
            'germany'      => ['name' => 'Germany'],
            'france'       => ['name' => 'France'],
            'netherlands'  => ['name' => 'Netherlands'],
            'japan'        => ['name' => 'Japan'],
            'south-korea'  => ['name' => 'South Korea'],
            'hong-kong'    => ['name' => 'Hong Kong'],
            'indonesia'    => ['name' => 'Indonesia'],
            'philippines'  => ['name' => 'Philippines'],
            'thailand'     => ['name' => 'Thailand'],
            'vietnam'      => ['name' => 'Vietnam'],
            'new-zealand'  => ['name' => 'New Zealand'],
        ];
    }

    // ─── Shared builder ────────────────────────────────────────────────────────

    private function buildView(string $citySlug, string $type, ?string $stateSlug = null, ?string $countrySlug = null)
    {
        $locations = self::getLocations();
        $states    = self::getStates();
        $countries = self::getCountries();

        // Resolve city
        if (isset($locations[$citySlug])) {
            $loc         = $locations[$citySlug];
            $city        = $loc['city'];
            $state       = $loc['state']  ?? null;
            $country     = $loc['country'] ?? 'India';
        } else {
            // Graceful fallback: humanise slug
            $city    = Str::of($citySlug)->replace('-', ' ')->title()->toString();
            $state   = null;
            $country = 'India';
        }

        // Override with explicit URL segments if provided
        if ($stateSlug && isset($states[$stateSlug])) {
            $state = $states[$stateSlug]['name'];
        }
        if ($countrySlug && isset($countries[$countrySlug])) {
            $country = $countries[$countrySlug]['name'];
        }

        return view('seo-landing', compact('city', 'state', 'country', 'type'));
    }

    private function buildStateView(string $stateSlug, string $type)
    {
        $states = self::getStates();
        abort_unless(isset($states[$stateSlug]), 404);

        $s       = $states[$stateSlug];
        $city    = $s['name'];   // treat state name as the "city" variable
        $state   = $s['name'];
        $country = $s['country'];

        return view('seo-landing', compact('city', 'state', 'country', 'type'));
    }

    private function buildCountryView(string $countrySlug, string $type)
    {
        $countries = self::getCountries();
        abort_unless(isset($countries[$countrySlug]), 404);

        $c       = $countries[$countrySlug];
        $city    = $c['name'];   // treat country name as the "city" variable
        $state   = null;
        $country = $c['name'];

        return view('seo-landing', compact('city', 'state', 'country', 'type'));
    }

    // ─── Institute Routes ───────────────────────────────────────────────────────

    public function landing($citySlug)
    {
        return $this->buildView($citySlug, 'institute');
    }

    public function instituteCityStateLanding(string $city, string $state)
    {
        return $this->buildView($city, 'institute', $state);
    }

    public function instituteCityStateCountryLanding(string $city, string $state, string $country)
    {
        return $this->buildView($city, 'institute', $state, $country);
    }

    public function instituteStateLanding(string $state)
    {
        return $this->buildStateView($state, 'institute');
    }

    public function instituteCountryLanding(string $country)
    {
        return $this->buildCountryView($country, 'institute');
    }

    // ─── School Routes ──────────────────────────────────────────────────────────

    public function schoolLanding($citySlug)
    {
        return $this->buildView($citySlug, 'school');
    }

    public function schoolCityStateLanding(string $city, string $state)
    {
        return $this->buildView($city, 'school', $state);
    }

    public function schoolCityStateCountryLanding(string $city, string $state, string $country)
    {
        return $this->buildView($city, 'school', $state, $country);
    }

    public function schoolStateLanding(string $state)
    {
        return $this->buildStateView($state, 'school');
    }

    public function schoolCountryLanding(string $country)
    {
        return $this->buildCountryView($country, 'school');
    }

    // ─── Locations Hub ─────────────────────────────────────────────────────────

    public function locations()
    {
        $locations = self::getLocations();
        $states    = self::getStates();
        $countries = self::getCountries();
        return view('locations', compact('locations', 'states', 'countries'));
    }

    // ─── Sitemap ────────────────────────────────────────────────────────────────

    public function sitemap()
    {
        $locations  = self::getLocations();
        $states     = self::getStates();
        $countries  = self::getCountries();
        $xmlHeader  = '<?xml version="1.0" encoding="UTF-8"?>';
        $lastmod    = now()->toDateString();

        return response()
            ->view('sitemap', compact('locations', 'states', 'countries', 'xmlHeader', 'lastmod'))
            ->header('Content-Type', 'text/xml')
            ->header('Cache-Control', 'public, max-age=86400');
    }
}
