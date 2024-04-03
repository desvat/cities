<?php

namespace App\Helpers;

use App\Models\City;

class CityHelper
{
    public static function insertCity($city_type, $cityName, $city_mayor, $city_district, $city_county, $city_region, $city_address, $city_phone, $city_fax, $xcity_email, $city_web, $city_crest_img, $city_parent_id)
    {
        // Vytvorte nový záznam v tabuľke cities
        City::create([
            'city_type' => $city_type,
            'city_name' => $cityName,
            'city_mayor' => $city_mayor,
            'city_district' => $city_district,
            'city_county' => $city_county,
            'city_region' => $city_region,
            'city_address' => $city_address,
            'city_phone' => $city_phone,
            'city_fax' => $city_fax,
            'city_email' => $xcity_email,
            'city_web' => $city_web,
            'city_crest_img' => $city_crest_img,
            'city_parent_id' => $city_parent_id
        ]);
    }



}