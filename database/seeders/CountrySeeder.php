<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $indiaStates = [
            "AP" => "Andhra Pradesh",
            "AR" => "Arunachal Pradesh",
            "AS" => "Assam",
            "BR" => "Bihar",
            "CT" => "Chhattisgarh",
            "GA" => "Goa",
            "GJ" => "Gujarat",
            "HR" => "Haryana",
            "HP" => "Himachal Pradesh",
            "JH" => "Jharkhand",
            "KA" => "Karnataka",
            "KL" => "Kerala",
            "MP" => "Madhya Pradesh",
            "MH" => "Maharashtra",
            "MN" => "Manipur",
            "ML" => "Meghalaya",
            "MZ" => "Mizoram",
            "NL" => "Nagaland",
            "OD" => "Odisha",
            "PB" => "Punjab",
            "RJ" => "Rajasthan",
            "SK" => "Sikkim",
            "TN" => "Tamil Nadu",
            "TS" => "Telangana",
            "TR" => "Tripura",
            "UP" => "Uttar Pradesh",
            "UK" => "Uttarakhand",
            "WB" => "West Bengal",
            "AN" => "Andaman and Nicobar Islands",
            "CH" => "Chandigarh",
            "DN" => "Dadra and Nagar Haveli and Daman and Diu",
            "DL" => "Delhi",
            "JK" => "Jammu and Kashmir",
            "LA" => "Ladakh",
            "LD" => "Lakshadweep",
            "PY" => "Puducherry"
        ];
        
        $countries = [
            ['code' => 'geo', 'name' => 'Georgia', 'states' => null],
            ['code' => 'ind', 'name' => 'India', 'states' => json_encode($indiaStates)],
            ['code' => 'usa', 'name' => 'United States of America', 'states' => null],
            ['code' => 'ger', 'name' => 'Germany', 'states' => null],
        ];

        Country::insert($countries);
    }
}
