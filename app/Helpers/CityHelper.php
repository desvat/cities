<?php

namespace App\Helpers;

use App\Models\City;

class CityHelper
{
    public static function insertCity($city_type, $cityName, $city_mayor, $city_district, $city_county, $city_region, $city_address, $city_phone, $city_fax, $xcity_email, $city_web, $city_crest_img)
    {

        // Vytvoriť nový záznam alebo aktualizovať existujúci záznam podľa názvu mesta
        City::updateOrCreate(
            ['city_name' => $cityName], // Podmienka pre vyhľadanie existujúceho záznamu podľa názvu mesta
            [ // Hodnoty, ktoré majú byť aktualizované alebo vložené
                'city_type' => $city_type,
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
                // 'city_parent_id' => $city_parent_id
            ]
        );

    }

    public static function getAllCities()
    {
        return City::all();
    }

    public static function getAllCityNames()
    {
        return City::select('city_id', 'city_type', 'city_name')->get();
    }

}