<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPHtmlParser\Dom;

use App\Models\City;
use App\Helpers\CityHelper;
use App\Helpers\HtmlParserHelper;

class HtmlParseController extends Controller
{

    public function showAllCities()
    {

        $cities = CityHelper::getAllCityNames();

        if (empty($cities)) {

            $message = 'Žiadne záznamy.';

            return view('cities', compact('message'));

        } else {

            return view('cities', compact('cities'));

        }

    }

    public function parseCitiesDetails($district)
    {

        $allLinks = [];

        $linksForDistrict = HtmlParserHelper::parseLinksBydistrict('https://www.e-obce.sk/okres/' . $district . '.html');
            
        preg_match_all('/\/([^\/]+)\.html/', json_encode($linksForDistrict), $matches);
        $allLinks = array_merge($allLinks, $matches[1]);

        $limitLinks = 5; // Počet Obci, ktoré chcete vykonať analyzovať
        foreach ($allLinks as $index => $link) {
            if ($limitLinks !== -1 && $index >= $limitLinks) {
                break; // Ukončiť cyklus, ak sme dosiahli limit
            }
            HtmlParserHelper::parseLinksCityDetails("https://www.e-obce.sk/obec/$link/$link.html");

        }

        return redirect('/cities');

    }

}