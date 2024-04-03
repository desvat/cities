<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPHtmlParser\Dom;

use App\Models\City;
use App\Helpers\CityHelper;
use App\Helpers\HtmlParserHelper;

class HtmlParseController extends Controller
{
    public function parseDistricts()
    {

        $paragraphs = HtmlParserHelper::parseLinksDistricts('https://www.e-obce.sk/kraj/NR.html');

        // CityHelper::insertCity('okres', 'xxx', 'xxx', 'xxx', 'xxx', 'xxx', 'xxx', 'xxx', 'xxx', 3);

        return view('district', compact('paragraphs'));
    }


    public function parseCities()
    {

        $paragraphs = HtmlParserHelper::parseLinksCities('komarno', 'levice', 'nitra', 'nove_zamky', 'sala', 'topolcany', 'zlate_moravce');

        return view('cities', compact('paragraphs'));

    }
    public function parseCitiesBydistrict($disctrict)
    {


        $paragraphs = HtmlParserHelper::parseLinksBydistrict('https://www.e-obce.sk/okres/' . $disctrict . '.html');
        
        if (empty($paragraphs)) {
            $message = 'Nenájdený žiadny záznam.';
            return view('cities', compact('message'));
        } else {
            return view('cities', compact('paragraphs'));
        }



    }

}