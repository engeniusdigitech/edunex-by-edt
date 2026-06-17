<?php

namespace Database\Seeders;

use App\Models\LocationPage;
use Illuminate\Database\Seeder;

class LocationPageSeeder extends Seeder
{
    /**
     * Seed the location_pages table.
     *
     * Structure:
     *   – Country records  (type = 'country')
     *   – State records    (type = 'state')
     *   – City records     (type = 'city')
     *
     * All slugs are lowercase-hyphenated for canonical URLs.
     * last_modified reflects the actual content date, not a global date.
     */
    public function run(): void
    {
        LocationPage::truncate();

        // ── 1. Countries ────────────────────────────────────────────────────
        $countries = [
            ['country_name' => 'India',        'country_code' => 'IN', 'country_slug' => 'india',        'last_modified' => '2026-06-17'],
            ['country_name' => 'United States', 'country_code' => 'US', 'country_slug' => 'united-states','last_modified' => '2026-06-17'],
            ['country_name' => 'United Kingdom','country_code' => 'GB', 'country_slug' => 'united-kingdom','last_modified' => '2026-06-17'],
            ['country_name' => 'UAE',           'country_code' => 'AE', 'country_slug' => 'uae',           'last_modified' => '2026-06-17'],
            ['country_name' => 'Canada',        'country_code' => 'CA', 'country_slug' => 'canada',        'last_modified' => '2026-06-17'],
            ['country_name' => 'Australia',     'country_code' => 'AU', 'country_slug' => 'australia',     'last_modified' => '2026-06-17'],
            ['country_name' => 'Singapore',     'country_code' => 'SG', 'country_slug' => 'singapore',     'last_modified' => '2026-06-17'],
            ['country_name' => 'Saudi Arabia',  'country_code' => 'SA', 'country_slug' => 'saudi-arabia',  'last_modified' => '2026-06-17'],
            ['country_name' => 'Qatar',         'country_code' => 'QA', 'country_slug' => 'qatar',         'last_modified' => '2026-06-17'],
            ['country_name' => 'Kuwait',        'country_code' => 'KW', 'country_slug' => 'kuwait',        'last_modified' => '2026-06-17'],
            ['country_name' => 'Oman',          'country_code' => 'OM', 'country_slug' => 'oman',          'last_modified' => '2026-06-17'],
            ['country_name' => 'Bahrain',       'country_code' => 'BH', 'country_slug' => 'bahrain',       'last_modified' => '2026-06-17'],
            ['country_name' => 'Nepal',         'country_code' => 'NP', 'country_slug' => 'nepal',         'last_modified' => '2026-06-17'],
            ['country_name' => 'Bangladesh',    'country_code' => 'BD', 'country_slug' => 'bangladesh',    'last_modified' => '2026-06-17'],
            ['country_name' => 'Sri Lanka',     'country_code' => 'LK', 'country_slug' => 'sri-lanka',     'last_modified' => '2026-06-17'],
            ['country_name' => 'Malaysia',      'country_code' => 'MY', 'country_slug' => 'malaysia',      'last_modified' => '2026-06-17'],
            ['country_name' => 'South Africa',  'country_code' => 'ZA', 'country_slug' => 'south-africa',  'last_modified' => '2026-06-17'],
            ['country_name' => 'Kenya',         'country_code' => 'KE', 'country_slug' => 'kenya',         'last_modified' => '2026-06-17'],
            ['country_name' => 'Nigeria',       'country_code' => 'NG', 'country_slug' => 'nigeria',       'last_modified' => '2026-06-17'],
            ['country_name' => 'Germany',       'country_code' => 'DE', 'country_slug' => 'germany',       'last_modified' => '2026-06-17'],
            ['country_name' => 'France',        'country_code' => 'FR', 'country_slug' => 'france',        'last_modified' => '2026-06-17'],
            ['country_name' => 'Netherlands',   'country_code' => 'NL', 'country_slug' => 'netherlands',   'last_modified' => '2026-06-17'],
            ['country_name' => 'Japan',         'country_code' => 'JP', 'country_slug' => 'japan',         'last_modified' => '2026-06-17'],
            ['country_name' => 'South Korea',   'country_code' => 'KR', 'country_slug' => 'south-korea',   'last_modified' => '2026-06-17'],
            ['country_name' => 'Hong Kong',     'country_code' => 'HK', 'country_slug' => 'hong-kong',     'last_modified' => '2026-06-17'],
            ['country_name' => 'Indonesia',     'country_code' => 'ID', 'country_slug' => 'indonesia',     'last_modified' => '2026-06-17'],
            ['country_name' => 'Philippines',   'country_code' => 'PH', 'country_slug' => 'philippines',   'last_modified' => '2026-06-17'],
            ['country_name' => 'Thailand',      'country_code' => 'TH', 'country_slug' => 'thailand',      'last_modified' => '2026-06-17'],
            ['country_name' => 'Vietnam',       'country_code' => 'VN', 'country_slug' => 'vietnam',       'last_modified' => '2026-06-17'],
            ['country_name' => 'New Zealand',   'country_code' => 'NZ', 'country_slug' => 'new-zealand',   'last_modified' => '2026-06-17'],
        ];

        foreach ($countries as $c) {
            LocationPage::create(array_merge($c, ['type' => 'country']));
        }

        // ── 2. States (India — 28 states + 8 Union Territories) ────────────
        $indianStates = [
            ['state_name' => 'Andhra Pradesh',           'state_code' => 'AP', 'state_slug' => 'andhra-pradesh',      'last_modified' => '2026-06-17'],
            ['state_name' => 'Arunachal Pradesh',         'state_code' => 'AR', 'state_slug' => 'arunachal-pradesh',   'last_modified' => '2026-06-17'],
            ['state_name' => 'Assam',                     'state_code' => 'AS', 'state_slug' => 'assam',               'last_modified' => '2026-06-17'],
            ['state_name' => 'Bihar',                     'state_code' => 'BR', 'state_slug' => 'bihar',               'last_modified' => '2026-06-17'],
            ['state_name' => 'Chhattisgarh',              'state_code' => 'CG', 'state_slug' => 'chhattisgarh',        'last_modified' => '2026-06-17'],
            ['state_name' => 'Goa',                       'state_code' => 'GA', 'state_slug' => 'goa',                 'last_modified' => '2026-06-17'],
            ['state_name' => 'Gujarat',                   'state_code' => 'GJ', 'state_slug' => 'gujarat',             'last_modified' => '2026-06-17'],
            ['state_name' => 'Haryana',                   'state_code' => 'HR', 'state_slug' => 'haryana',             'last_modified' => '2026-06-17'],
            ['state_name' => 'Himachal Pradesh',          'state_code' => 'HP', 'state_slug' => 'himachal-pradesh',    'last_modified' => '2026-06-17'],
            ['state_name' => 'Jharkhand',                 'state_code' => 'JH', 'state_slug' => 'jharkhand',           'last_modified' => '2026-06-17'],
            ['state_name' => 'Karnataka',                 'state_code' => 'KA', 'state_slug' => 'karnataka',           'last_modified' => '2026-06-17'],
            ['state_name' => 'Kerala',                    'state_code' => 'KL', 'state_slug' => 'kerala',              'last_modified' => '2026-06-17'],
            ['state_name' => 'Madhya Pradesh',            'state_code' => 'MP', 'state_slug' => 'madhya-pradesh',      'last_modified' => '2026-06-17'],
            ['state_name' => 'Maharashtra',               'state_code' => 'MH', 'state_slug' => 'maharashtra',         'last_modified' => '2026-06-17'],
            ['state_name' => 'Manipur',                   'state_code' => 'MN', 'state_slug' => 'manipur',             'last_modified' => '2026-06-17'],
            ['state_name' => 'Meghalaya',                 'state_code' => 'ML', 'state_slug' => 'meghalaya',           'last_modified' => '2026-06-17'],
            ['state_name' => 'Mizoram',                   'state_code' => 'MZ', 'state_slug' => 'mizoram',             'last_modified' => '2026-06-17'],
            ['state_name' => 'Nagaland',                  'state_code' => 'NL', 'state_slug' => 'nagaland',            'last_modified' => '2026-06-17'],
            ['state_name' => 'Odisha',                    'state_code' => 'OD', 'state_slug' => 'odisha',              'last_modified' => '2026-06-17'],
            ['state_name' => 'Punjab',                    'state_code' => 'PB', 'state_slug' => 'punjab',              'last_modified' => '2026-06-17'],
            ['state_name' => 'Rajasthan',                 'state_code' => 'RJ', 'state_slug' => 'rajasthan',           'last_modified' => '2026-06-17'],
            ['state_name' => 'Sikkim',                    'state_code' => 'SK', 'state_slug' => 'sikkim',              'last_modified' => '2026-06-17'],
            ['state_name' => 'Tamil Nadu',                'state_code' => 'TN', 'state_slug' => 'tamil-nadu',          'last_modified' => '2026-06-17'],
            ['state_name' => 'Telangana',                 'state_code' => 'TS', 'state_slug' => 'telangana',           'last_modified' => '2026-06-17'],
            ['state_name' => 'Tripura',                   'state_code' => 'TR', 'state_slug' => 'tripura',             'last_modified' => '2026-06-17'],
            ['state_name' => 'Uttar Pradesh',             'state_code' => 'UP', 'state_slug' => 'uttar-pradesh',       'last_modified' => '2026-06-17'],
            ['state_name' => 'Uttarakhand',               'state_code' => 'UK', 'state_slug' => 'uttarakhand',         'last_modified' => '2026-06-17'],
            ['state_name' => 'West Bengal',               'state_code' => 'WB', 'state_slug' => 'west-bengal',         'last_modified' => '2026-06-17'],
            // Union Territories
            ['state_name' => 'Andaman and Nicobar Islands','state_code'=>'AN', 'state_slug' => 'andaman-and-nicobar', 'last_modified' => '2026-06-17'],
            ['state_name' => 'Chandigarh',                'state_code' => 'CH', 'state_slug' => 'chandigarh',          'last_modified' => '2026-06-17'],
            ['state_name' => 'Delhi',                     'state_code' => 'DL', 'state_slug' => 'delhi',               'last_modified' => '2026-06-17'],
            ['state_name' => 'Jammu & Kashmir',           'state_code' => 'JK', 'state_slug' => 'jammu-and-kashmir',   'last_modified' => '2026-06-17'],
            ['state_name' => 'Ladakh',                    'state_code' => 'LA', 'state_slug' => 'ladakh',              'last_modified' => '2026-06-17'],
            ['state_name' => 'Lakshadweep',               'state_code' => 'LD', 'state_slug' => 'lakshadweep',         'last_modified' => '2026-06-17'],
            ['state_name' => 'Puducherry',                'state_code' => 'PY', 'state_slug' => 'puducherry',          'last_modified' => '2026-06-17'],
        ];

        foreach ($indianStates as $s) {
            LocationPage::create(array_merge($s, [
                'type'         => 'state',
                'country_name' => 'India',
                'country_code' => 'IN',
                'country_slug' => 'india',
            ]));
        }

        // International states / provinces
        $intlStates = [
            // USA
            ['country_name'=>'United States','country_code'=>'US','country_slug'=>'united-states','state_name'=>'New York',        'state_code'=>'NY','state_slug'=>'new-york',        'last_modified'=>'2026-06-17'],
            ['country_name'=>'United States','country_code'=>'US','country_slug'=>'united-states','state_name'=>'California',       'state_code'=>'CA','state_slug'=>'california',       'last_modified'=>'2026-06-17'],
            ['country_name'=>'United States','country_code'=>'US','country_slug'=>'united-states','state_name'=>'Illinois',         'state_code'=>'IL','state_slug'=>'illinois',         'last_modified'=>'2026-06-17'],
            ['country_name'=>'United States','country_code'=>'US','country_slug'=>'united-states','state_name'=>'Florida',          'state_code'=>'FL','state_slug'=>'florida',          'last_modified'=>'2026-06-17'],
            ['country_name'=>'United States','country_code'=>'US','country_slug'=>'united-states','state_name'=>'Texas',            'state_code'=>'TX','state_slug'=>'texas',            'last_modified'=>'2026-06-17'],
            // UK
            ['country_name'=>'United Kingdom','country_code'=>'GB','country_slug'=>'united-kingdom','state_name'=>'England',        'state_code'=>'ENG','state_slug'=>'england',         'last_modified'=>'2026-06-17'],
            ['country_name'=>'United Kingdom','country_code'=>'GB','country_slug'=>'united-kingdom','state_name'=>'Scotland',       'state_code'=>'SCT','state_slug'=>'scotland',        'last_modified'=>'2026-06-17'],
            // Australia
            ['country_name'=>'Australia','country_code'=>'AU','country_slug'=>'australia','state_name'=>'New South Wales',          'state_code'=>'NSW','state_slug'=>'new-south-wales', 'last_modified'=>'2026-06-17'],
            ['country_name'=>'Australia','country_code'=>'AU','country_slug'=>'australia','state_name'=>'Victoria',                 'state_code'=>'VIC','state_slug'=>'victoria',        'last_modified'=>'2026-06-17'],
            // Canada
            ['country_name'=>'Canada','country_code'=>'CA','country_slug'=>'canada','state_name'=>'Ontario',                        'state_code'=>'ON','state_slug'=>'ontario',          'last_modified'=>'2026-06-17'],
            ['country_name'=>'Canada','country_code'=>'CA','country_slug'=>'canada','state_name'=>'British Columbia',               'state_code'=>'BC','state_slug'=>'british-columbia', 'last_modified'=>'2026-06-17'],
            // UAE
            ['country_name'=>'UAE','country_code'=>'AE','country_slug'=>'uae','state_name'=>'Dubai',                                'state_code'=>'DXB','state_slug'=>'dubai',          'last_modified'=>'2026-06-17'],
            ['country_name'=>'UAE','country_code'=>'AE','country_slug'=>'uae','state_name'=>'Abu Dhabi',                            'state_code'=>'AUH','state_slug'=>'abu-dhabi',       'last_modified'=>'2026-06-17'],
            ['country_name'=>'UAE','country_code'=>'AE','country_slug'=>'uae','state_name'=>'Sharjah',                              'state_code'=>'SHJ','state_slug'=>'sharjah',         'last_modified'=>'2026-06-17'],
            // Malaysia
            ['country_name'=>'Malaysia','country_code'=>'MY','country_slug'=>'malaysia','state_name'=>'Kuala Lumpur',              'state_code'=>'KL','state_slug'=>'kuala-lumpur',     'last_modified'=>'2026-06-17'],
            // South Africa
            ['country_name'=>'South Africa','country_code'=>'ZA','country_slug'=>'south-africa','state_name'=>'Gauteng',           'state_code'=>'GT','state_slug'=>'gauteng',          'last_modified'=>'2026-06-17'],
            ['country_name'=>'South Africa','country_code'=>'ZA','country_slug'=>'south-africa','state_name'=>'Western Cape',      'state_code'=>'WC','state_slug'=>'western-cape',     'last_modified'=>'2026-06-17'],
            // Sri Lanka
            ['country_name'=>'Sri Lanka','country_code'=>'LK','country_slug'=>'sri-lanka','state_name'=>'Western Province',        'state_code'=>'WP','state_slug'=>'western-province', 'last_modified'=>'2026-06-17'],
            // Nepal
            ['country_name'=>'Nepal','country_code'=>'NP','country_slug'=>'nepal','state_name'=>'Bagmati Province',                'state_code'=>'BA','state_slug'=>'bagmati',          'last_modified'=>'2026-06-17'],
            // Netherlands
            ['country_name'=>'Netherlands','country_code'=>'NL','country_slug'=>'netherlands','state_name'=>'North Holland',       'state_code'=>'NH','state_slug'=>'north-holland',    'last_modified'=>'2026-06-17'],
            // France
            ['country_name'=>'France','country_code'=>'FR','country_slug'=>'france','state_name'=>'Île-de-France',                 'state_code'=>'IDF','state_slug'=>'ile-de-france',  'last_modified'=>'2026-06-17'],
        ];

        foreach ($intlStates as $s) {
            LocationPage::create(array_merge($s, ['type' => 'state']));
        }

        // ── 3. Cities ───────────────────────────────────────────────────────
        // Format: [city_name, city_slug, state_name, state_code, state_slug, country_name, country_code, country_slug, last_modified]
        $cities = [
            // ── India – Maharashtra ───────────────────────────────────────
            ['Mumbai',         'mumbai',         'Maharashtra',   'MH', 'maharashtra',   'India','IN','india','2026-06-17'],
            ['Pune',           'pune',           'Maharashtra',   'MH', 'maharashtra',   'India','IN','india','2026-06-17'],
            ['Nagpur',         'nagpur',         'Maharashtra',   'MH', 'maharashtra',   'India','IN','india','2026-06-17'],
            ['Nashik',         'nashik',         'Maharashtra',   'MH', 'maharashtra',   'India','IN','india','2026-06-17'],
            ['Thane',          'thane',          'Maharashtra',   'MH', 'maharashtra',   'India','IN','india','2026-06-17'],
            ['Aurangabad',     'aurangabad',     'Maharashtra',   'MH', 'maharashtra',   'India','IN','india','2026-06-17'],
            ['Navi Mumbai',    'navi-mumbai',    'Maharashtra',   'MH', 'maharashtra',   'India','IN','india','2026-06-17'],
            ['Solapur',        'solapur',        'Maharashtra',   'MH', 'maharashtra',   'India','IN','india','2026-06-17'],
            ['Kolhapur',       'kolhapur',       'Maharashtra',   'MH', 'maharashtra',   'India','IN','india','2026-06-17'],
            // ── India – Gujarat ───────────────────────────────────────────
            ['Ahmedabad',      'ahmedabad',      'Gujarat',       'GJ', 'gujarat',       'India','IN','india','2026-06-17'],
            ['Surat',          'surat',          'Gujarat',       'GJ', 'gujarat',       'India','IN','india','2026-06-17'],
            ['Vadodara',       'vadodara',       'Gujarat',       'GJ', 'gujarat',       'India','IN','india','2026-06-17'],
            ['Rajkot',         'rajkot',         'Gujarat',       'GJ', 'gujarat',       'India','IN','india','2026-06-17'],
            ['Palanpur',       'palanpur',       'Gujarat',       'GJ', 'gujarat',       'India','IN','india','2026-06-17'],
            ['Gandhinagar',    'gandhinagar',    'Gujarat',       'GJ', 'gujarat',       'India','IN','india','2026-06-17'],
            ['Bhavnagar',      'bhavnagar',      'Gujarat',       'GJ', 'gujarat',       'India','IN','india','2026-06-17'],
            ['Jamnagar',       'jamnagar',       'Gujarat',       'GJ', 'gujarat',       'India','IN','india','2026-06-17'],
            ['Anand',          'anand',          'Gujarat',       'GJ', 'gujarat',       'India','IN','india','2026-06-17'],
            ['Nadiad',         'nadiad',         'Gujarat',       'GJ', 'gujarat',       'India','IN','india','2026-06-17'],
            // ── India – Uttar Pradesh ──────────────────────────────────────
            ['Lucknow',        'lucknow',        'Uttar Pradesh', 'UP', 'uttar-pradesh', 'India','IN','india','2026-06-17'],
            ['Kanpur',         'kanpur',         'Uttar Pradesh', 'UP', 'uttar-pradesh', 'India','IN','india','2026-06-17'],
            ['Agra',           'agra',           'Uttar Pradesh', 'UP', 'uttar-pradesh', 'India','IN','india','2026-06-17'],
            ['Varanasi',       'varanasi',       'Uttar Pradesh', 'UP', 'uttar-pradesh', 'India','IN','india','2026-06-17'],
            ['Meerut',         'meerut',         'Uttar Pradesh', 'UP', 'uttar-pradesh', 'India','IN','india','2026-06-17'],
            ['Ghaziabad',      'ghaziabad',      'Uttar Pradesh', 'UP', 'uttar-pradesh', 'India','IN','india','2026-06-17'],
            ['Allahabad',      'allahabad',      'Uttar Pradesh', 'UP', 'uttar-pradesh', 'India','IN','india','2026-06-17'],
            ['Bareilly',       'bareilly',       'Uttar Pradesh', 'UP', 'uttar-pradesh', 'India','IN','india','2026-06-17'],
            ['Moradabad',      'moradabad',      'Uttar Pradesh', 'UP', 'uttar-pradesh', 'India','IN','india','2026-06-17'],
            ['Aligarh',        'aligarh',        'Uttar Pradesh', 'UP', 'uttar-pradesh', 'India','IN','india','2026-06-17'],
            ['Gorakhpur',      'gorakhpur',      'Uttar Pradesh', 'UP', 'uttar-pradesh', 'India','IN','india','2026-06-17'],
            ['Noida',          'noida',          'Uttar Pradesh', 'UP', 'uttar-pradesh', 'India','IN','india','2026-06-17'],
            // ── India – Rajasthan ──────────────────────────────────────────
            ['Jaipur',         'jaipur',         'Rajasthan',     'RJ', 'rajasthan',     'India','IN','india','2026-06-17'],
            ['Jodhpur',        'jodhpur',        'Rajasthan',     'RJ', 'rajasthan',     'India','IN','india','2026-06-17'],
            ['Udaipur',        'udaipur',        'Rajasthan',     'RJ', 'rajasthan',     'India','IN','india','2026-06-17'],
            ['Kota',           'kota',           'Rajasthan',     'RJ', 'rajasthan',     'India','IN','india','2026-06-17'],
            ['Bikaner',        'bikaner',        'Rajasthan',     'RJ', 'rajasthan',     'India','IN','india','2026-06-17'],
            ['Ajmer',          'ajmer',          'Rajasthan',     'RJ', 'rajasthan',     'India','IN','india','2026-06-17'],
            // ── India – Karnataka ──────────────────────────────────────────
            ['Bangalore',      'bangalore',      'Karnataka',     'KA', 'karnataka',     'India','IN','india','2026-06-17'],
            ['Mysore',         'mysore',         'Karnataka',     'KA', 'karnataka',     'India','IN','india','2026-06-17'],
            ['Mysuru',         'mysuru',         'Karnataka',     'KA', 'karnataka',     'India','IN','india','2026-06-17'],
            ['Hubli',          'hubli',          'Karnataka',     'KA', 'karnataka',     'India','IN','india','2026-06-17'],
            ['Mangalore',      'mangalore',      'Karnataka',     'KA', 'karnataka',     'India','IN','india','2026-06-17'],
            ['Belgaum',        'belgaum',        'Karnataka',     'KA', 'karnataka',     'India','IN','india','2026-06-17'],
            // ── India – Tamil Nadu ─────────────────────────────────────────
            ['Chennai',        'chennai',        'Tamil Nadu',    'TN', 'tamil-nadu',    'India','IN','india','2026-06-17'],
            ['Coimbatore',     'coimbatore',     'Tamil Nadu',    'TN', 'tamil-nadu',    'India','IN','india','2026-06-17'],
            ['Madurai',        'madurai',        'Tamil Nadu',    'TN', 'tamil-nadu',    'India','IN','india','2026-06-17'],
            ['Tiruppur',       'tiruppur',       'Tamil Nadu',    'TN', 'tamil-nadu',    'India','IN','india','2026-06-17'],
            // ── India – Telangana ──────────────────────────────────────────
            ['Hyderabad',      'hyderabad',      'Telangana',     'TS', 'telangana',     'India','IN','india','2026-06-17'],
            // ── India – Andhra Pradesh ─────────────────────────────────────
            ['Visakhapatnam',  'visakhapatnam',  'Andhra Pradesh','AP', 'andhra-pradesh','India','IN','india','2026-06-17'],
            ['Vijayawada',     'vijayawada',     'Andhra Pradesh','AP', 'andhra-pradesh','India','IN','india','2026-06-17'],
            // ── India – West Bengal ────────────────────────────────────────
            ['Kolkata',        'kolkata',        'West Bengal',   'WB', 'west-bengal',   'India','IN','india','2026-06-17'],
            ['Howrah',         'howrah',         'West Bengal',   'WB', 'west-bengal',   'India','IN','india','2026-06-17'],
            ['Siliguri',       'siliguri',       'West Bengal',   'WB', 'west-bengal',   'India','IN','india','2026-06-17'],
            // ── India – Madhya Pradesh ────────────────────────────────────
            ['Indore',         'indore',         'Madhya Pradesh','MP', 'madhya-pradesh','India','IN','india','2026-06-17'],
            ['Bhopal',         'bhopal',         'Madhya Pradesh','MP', 'madhya-pradesh','India','IN','india','2026-06-17'],
            ['Gwalior',        'gwalior',        'Madhya Pradesh','MP', 'madhya-pradesh','India','IN','india','2026-06-17'],
            ['Jabalpur',       'jabalpur',       'Madhya Pradesh','MP', 'madhya-pradesh','India','IN','india','2026-06-17'],
            // ── India – Punjab ─────────────────────────────────────────────
            ['Ludhiana',       'ludhiana',       'Punjab',        'PB', 'punjab',        'India','IN','india','2026-06-17'],
            ['Amritsar',       'amritsar',       'Punjab',        'PB', 'punjab',        'India','IN','india','2026-06-17'],
            ['Jalandhar',      'jalandhar',      'Punjab',        'PB', 'punjab',        'India','IN','india','2026-06-17'],
            ['Patiala',        'patiala',        'Punjab',        'PB', 'punjab',        'India','IN','india','2026-06-17'],
            // ── India – Haryana ────────────────────────────────────────────
            ['Gurgaon',        'gurgaon',        'Haryana',       'HR', 'haryana',       'India','IN','india','2026-06-17'],
            ['Faridabad',      'faridabad',      'Haryana',       'HR', 'haryana',       'India','IN','india','2026-06-17'],
            ['Rohtak',         'rohtak',         'Haryana',       'HR', 'haryana',       'India','IN','india','2026-06-17'],
            ['Hisar',          'hisar',          'Haryana',       'HR', 'haryana',       'India','IN','india','2026-06-17'],
            ['Panipat',        'panipat',        'Haryana',       'HR', 'haryana',       'India','IN','india','2026-06-17'],
            // ── India – Bihar ──────────────────────────────────────────────
            ['Patna',          'patna',          'Bihar',         'BR', 'bihar',         'India','IN','india','2026-06-17'],
            // ── India – Jharkhand ──────────────────────────────────────────
            ['Ranchi',         'ranchi',         'Jharkhand',     'JH', 'jharkhand',     'India','IN','india','2026-06-17'],
            ['Dhanbad',        'dhanbad',        'Jharkhand',     'JH', 'jharkhand',     'India','IN','india','2026-06-17'],
            ['Jamshedpur',     'jamshedpur',     'Jharkhand',     'JH', 'jharkhand',     'India','IN','india','2026-06-17'],
            // ── India – Odisha ─────────────────────────────────────────────
            ['Bhubaneswar',    'bhubaneswar',    'Odisha',        'OD', 'odisha',        'India','IN','india','2026-06-17'],
            ['Cuttack',        'cuttack',        'Odisha',        'OD', 'odisha',        'India','IN','india','2026-06-17'],
            // ── India – Chhattisgarh ───────────────────────────────────────
            ['Raipur',         'raipur',         'Chhattisgarh',  'CG', 'chhattisgarh',  'India','IN','india','2026-06-17'],
            ['Bhilai',         'bhilai',         'Chhattisgarh',  'CG', 'chhattisgarh',  'India','IN','india','2026-06-17'],
            // ── India – Assam ──────────────────────────────────────────────
            ['Guwahati',       'guwahati',       'Assam',         'AS', 'assam',         'India','IN','india','2026-06-17'],
            // ── India – Kerala ─────────────────────────────────────────────
            ['Kochi',          'kochi',          'Kerala',        'KL', 'kerala',        'India','IN','india','2026-06-17'],
            ['Thiruvananthapuram','trivandrum',  'Kerala',        'KL', 'kerala',        'India','IN','india','2026-06-17'],
            // ── India – Uttarakhand ────────────────────────────────────────
            ['Dehradun',       'dehradun',       'Uttarakhand',   'UK', 'uttarakhand',   'India','IN','india','2026-06-17'],
            ['Haridwar',       'haridwar',       'Uttarakhand',   'UK', 'uttarakhand',   'India','IN','india','2026-06-17'],
            // ── India – Himachal Pradesh ───────────────────────────────────
            ['Shimla',         'shimla',         'Himachal Pradesh','HP','himachal-pradesh','India','IN','india','2026-06-17'],
            // ── India – Goa ────────────────────────────────────────────────
            ['Goa',            'goa-city',       'Goa',           'GA', 'goa',           'India','IN','india','2026-06-17'],
            // ── India – Delhi (UT) ─────────────────────────────────────────
            ['Delhi',          'delhi',          'Delhi',         'DL', 'delhi',         'India','IN','india','2026-06-17'],
            ['New Delhi',      'new-delhi',      'Delhi',         'DL', 'delhi',         'India','IN','india','2026-06-17'],
            // ── India – Chandigarh (UT) ────────────────────────────────────
            ['Chandigarh',     'chandigarh',     'Chandigarh',    'CH', 'chandigarh',    'India','IN','india','2026-06-17'],
            // ── India – Puducherry (UT) ────────────────────────────────────
            ['Pondicherry',    'pondicherry',    'Puducherry',    'PY', 'puducherry',    'India','IN','india','2026-06-17'],
            // ── India – Jammu & Kashmir (UT) ──────────────────────────────
            ['Srinagar',       'srinagar',       'Jammu & Kashmir','JK','jammu-and-kashmir','India','IN','india','2026-06-17'],
            ['Jammu',          'jammu',          'Jammu & Kashmir','JK','jammu-and-kashmir','India','IN','india','2026-06-17'],

            // ── USA ───────────────────────────────────────────────────────
            ['New York',       'new-york',       'New York',      'NY', 'new-york',      'United States','US','united-states','2026-06-17'],
            ['Los Angeles',    'los-angeles',    'California',    'CA', 'california',    'United States','US','united-states','2026-06-17'],
            ['San Francisco',  'san-francisco',  'California',    'CA', 'california',    'United States','US','united-states','2026-06-17'],
            ['Chicago',        'chicago',        'Illinois',      'IL', 'illinois',      'United States','US','united-states','2026-06-17'],
            ['Miami',          'miami',          'Florida',       'FL', 'florida',       'United States','US','united-states','2026-06-17'],
            ['Houston',        'houston',        'Texas',         'TX', 'texas',         'United States','US','united-states','2026-06-17'],

            // ── United Kingdom ────────────────────────────────────────────
            ['London',         'london',         'England',       'ENG','england',       'United Kingdom','GB','united-kingdom','2026-06-17'],
            ['Manchester',     'manchester',     'England',       'ENG','england',       'United Kingdom','GB','united-kingdom','2026-06-17'],
            ['Edinburgh',      'edinburgh',      'Scotland',      'SCT','scotland',      'United Kingdom','GB','united-kingdom','2026-06-17'],

            // ── UAE ───────────────────────────────────────────────────────
            ['Dubai',          'dubai',          'Dubai',         'DXB','dubai',         'UAE','AE','uae','2026-06-17'],
            ['Abu Dhabi',      'abu-dhabi',      'Abu Dhabi',     'AUH','abu-dhabi',     'UAE','AE','uae','2026-06-17'],
            ['Sharjah',        'sharjah',        'Sharjah',       'SHJ','sharjah',       'UAE','AE','uae','2026-06-17'],

            // ── Australia ─────────────────────────────────────────────────
            ['Sydney',         'sydney',         'New South Wales','NSW','new-south-wales','Australia','AU','australia','2026-06-17'],
            ['Melbourne',      'melbourne',      'Victoria',      'VIC','victoria',      'Australia','AU','australia','2026-06-17'],

            // ── Canada ────────────────────────────────────────────────────
            ['Toronto',        'toronto',        'Ontario',       'ON', 'ontario',       'Canada','CA','canada','2026-06-17'],
            ['Vancouver',      'vancouver',      'British Columbia','BC','british-columbia','Canada','CA','canada','2026-06-17'],

            // ── Singapore ─────────────────────────────────────────────────
            ['Singapore',      'singapore-city', 'Singapore',     'SG', 'singapore',    'Singapore','SG','singapore','2026-06-17'],

            // ── Saudi Arabia ──────────────────────────────────────────────
            ['Riyadh',         'riyadh',         'Riyadh',        'RIY','riyadh',        'Saudi Arabia','SA','saudi-arabia','2026-06-17'],
            ['Jeddah',         'jeddah',         'Makkah',        'MKH','makkah',        'Saudi Arabia','SA','saudi-arabia','2026-06-17'],

            // ── Qatar ─────────────────────────────────────────────────────
            ['Doha',           'doha',           'Doha',          'DOH','doha-region',   'Qatar','QA','qatar','2026-06-17'],

            // ── Malaysia ──────────────────────────────────────────────────
            ['Kuala Lumpur',   'kuala-lumpur',   'Kuala Lumpur',  'KL', 'kuala-lumpur',  'Malaysia','MY','malaysia','2026-06-17'],

            // ── South Africa ──────────────────────────────────────────────
            ['Johannesburg',   'johannesburg',   'Gauteng',       'GT', 'gauteng',       'South Africa','ZA','south-africa','2026-06-17'],
            ['Cape Town',      'cape-town',      'Western Cape',  'WC', 'western-cape',  'South Africa','ZA','south-africa','2026-06-17'],

            // ── Kenya ─────────────────────────────────────────────────────
            ['Nairobi',        'nairobi',        'Nairobi County','NBI','nairobi-county', 'Kenya','KE','kenya','2026-06-17'],

            // ── Nigeria ───────────────────────────────────────────────────
            ['Lagos',          'lagos',          'Lagos State',   'LA', 'lagos-state',   'Nigeria','NG','nigeria','2026-06-17'],

            // ── Bangladesh ────────────────────────────────────────────────
            ['Dhaka',          'dhaka',          'Dhaka Division','DD','dhaka-division', 'Bangladesh','BD','bangladesh','2026-06-17'],

            // ── Sri Lanka ─────────────────────────────────────────────────
            ['Colombo',        'colombo',        'Western Province','WP','western-province','Sri Lanka','LK','sri-lanka','2026-06-17'],

            // ── Nepal ─────────────────────────────────────────────────────
            ['Kathmandu',      'kathmandu',      'Bagmati Province','BA','bagmati',      'Nepal','NP','nepal','2026-06-17'],

            // ── Germany ───────────────────────────────────────────────────
            ['Berlin',         'berlin',         'Berlin',        'BE', 'berlin-state',  'Germany','DE','germany','2026-06-17'],

            // ── France ────────────────────────────────────────────────────
            ['Paris',          'paris',          'Île-de-France', 'IDF','ile-de-france', 'France','FR','france','2026-06-17'],

            // ── Netherlands ───────────────────────────────────────────────
            ['Amsterdam',      'amsterdam',      'North Holland', 'NH', 'north-holland', 'Netherlands','NL','netherlands','2026-06-17'],

            // ── Japan ─────────────────────────────────────────────────────
            ['Tokyo',          'tokyo',          'Tokyo',         'TKY','tokyo-metro',   'Japan','JP','japan','2026-06-17'],

            // ── South Korea ───────────────────────────────────────────────
            ['Seoul',          'seoul',          'Seoul',         'SEL','seoul-metro',   'South Korea','KR','south-korea','2026-06-17'],

            // ── Hong Kong ─────────────────────────────────────────────────
            ['Hong Kong',      'hong-kong',      'Hong Kong',     'HK', 'hong-kong-sar', 'Hong Kong','HK','hong-kong','2026-06-17'],
        ];

        foreach ($cities as [$city_name, $city_slug, $state_name, $state_code, $state_slug,
                             $country_name, $country_code, $country_slug, $last_modified]) {
            LocationPage::create([
                'type'         => 'city',
                'city_name'    => $city_name,
                'city_slug'    => $city_slug,
                'state_name'   => $state_name,
                'state_code'   => $state_code,
                'state_slug'   => $state_slug,
                'country_name' => $country_name,
                'country_code' => $country_code,
                'country_slug' => $country_slug,
                'last_modified' => $last_modified,
            ]);
        }

        // Seed state records for international states that appear in city records
        // but weren't seeded in $intlStates (e.g. Nairobi County, Lagos State, etc.)
        $extraStates = [
            ['Kenya',    'KE','kenya',    'Nairobi County','NBI','nairobi-county', '2026-06-17'],
            ['Nigeria',  'NG','nigeria',  'Lagos State',   'LA', 'lagos-state',    '2026-06-17'],
            ['Bangladesh','BD','bangladesh','Dhaka Division','DD','dhaka-division', '2026-06-17'],
            ['Germany',  'DE','germany',  'Berlin',        'BE', 'berlin-state',   '2026-06-17'],
            ['Japan',    'JP','japan',    'Tokyo',         'TKY','tokyo-metro',    '2026-06-17'],
            ['South Korea','KR','south-korea','Seoul',     'SEL','seoul-metro',    '2026-06-17'],
            ['Hong Kong','HK','hong-kong','Hong Kong',     'HK', 'hong-kong-sar',  '2026-06-17'],
            ['Singapore','SG','singapore','Singapore',     'SG', 'singapore',      '2026-06-17'],
            ['Qatar',    'QA','qatar',    'Doha',          'DOH','doha-region',    '2026-06-17'],
            ['Saudi Arabia','SA','saudi-arabia','Makkah',  'MKH','makkah',        '2026-06-17'],
            ['Saudi Arabia','SA','saudi-arabia','Riyadh',  'RIY','riyadh',        '2026-06-17'],
        ];

        foreach ($extraStates as [$country_name, $country_code, $country_slug,
                                   $state_name, $state_code, $state_slug, $last_modified]) {
            LocationPage::firstOrCreate(
                ['country_slug' => $country_slug, 'state_slug' => $state_slug, 'city_slug' => null, 'type' => 'state'],
                [
                    'country_name' => $country_name,
                    'country_code' => $country_code,
                    'state_name'   => $state_name,
                    'state_code'   => $state_code,
                    'last_modified' => $last_modified,
                ]
            );
        }
    }
}
