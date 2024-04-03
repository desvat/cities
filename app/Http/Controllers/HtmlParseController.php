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

    public function parseCitiesDetails()
    {

        // $paragraphs = HtmlParserHelper::parseLinksCities('komarno', 'levice', 'nitra', 'nove_zamky', 'sala', 'topolcany', 'zlate_moravce');


        $html = file_get_contents('https://www.e-obce.sk/obec/levice/levice.html');
        // $html = file_get_contents('https://www.e-obce.sk/obec/nitra/nitra.html');
        // $html = file_get_contents('https://www.e-obce.sk/obec/vrable/vrable.html');
        // $html = file_get_contents('https://www.e-obce.sk/obec/jarok/jarok.html');






        $html = preg_replace('/[;\'":-]|-->/u', '', $html);
        $html = preg_replace('/https\/\//', '', $html);

        $dom = new Dom;

        $dom->loadStr($html);

        $paragraphs = [];





        $tables = $dom->find('table');

        foreach ($tables as $table) {

            /* Lava tabulka */
            if (strpos($table->outerHtml, 'Samosprávny kraj') !== false) {

                $table = $dom->loadStr($table->outerHtml);

                $rows = $table->getElementsByTag('tr');

                $patternPrimator = '/<td>Primátor<\/td>\s*<td>(.*?)<\/td>/';
                $patternStarosta = '/<td>Starosta<\/td>\s*<td>(.*?)<\/td>/';
                $patternPrednosta = '/<td>Prednosta<\/td>\s*<td>(.*?)<\/td>/';
                $patternRegion = '/<td>Región<\/td>\s*<td>(.*?)<\/td>/';

                // Hľadanie hodnôt pre Primátora
                preg_match($patternPrimator, $rows, $matchesPrimator);
                if (!empty($matchesPrimator)) {
                    $paragraphs[] = [
                        'primator' => $matchesPrimator[1]
                    ];
                }

                // Hľadanie hodnôt pre Starosta
                preg_match($patternStarosta, $rows, $matchesStarosta);
                if (!empty($matchesStarosta)) {
                    $paragraphs[] = [
                        'starosta' => $matchesStarosta[1]
                    ];
                }

                // Hľadanie hodnôt pre Prednostu
                preg_match($patternPrednosta, $rows, $matchesPrednosta);
                if (!empty($matchesPrednosta)) {
                    $paragraphs[] = [
                        'prednosta' => $matchesPrednosta[1]
                    ];
                }

                // Hľadanie hodnôt pre Region
                preg_match($patternRegion, $rows, $matchesRegion);
                if (!empty($matchesRegion)) {
                    $paragraphs[] = [
                        'region' => $matchesRegion[1]
                    ];
                }

            }

            /* Prava tabulka */
            if (strpos($table->outerHtml, 'Email') !== false || strpos($table->outerHtml, 'Fax') !== false) {

                $table = $dom->loadStr($table->outerHtml);

                $rows = $table->getElementsByTag('tr');

                // $patternFax = '/\b\d{3}\s\/\s\d{3}\s\d{2}\s\d{2}\b/';

                $patternFax = '/<td>Fax:<\/td>\s*<td>(.*?)<\/td>/';
                $patternFax = '/<td>Fax:<\/td>\s*<td>([^<]+)<\/td>/';


                $patternWeb = '/<td><a href="([^"]+)" target="newwindow">([^<]+)<\/a><\/td>/';


                /* Emaily */
                $emails = [];
                foreach ($rows as $row) {
                    $anchors = $row->find('a[href^=mailto]');
                    foreach ($anchors as $anchor) {
                        $email = $anchor->getAttribute('href');
                        $email = str_replace('mailto', '', $email);
                        $paragraphs[] = [
                            'emails' => $emails[] = $email
                        ];
                    }
                }

                $patternWeb = '/<a\s[^>]*href="([^"]+)"[^>]*target="newwindow"[^>]*>(.*?)<\/a>/';
                preg_match($patternWeb, $rows, $matchesWeb);
                $paragraphs[] = [
                    'web' => $matchesWeb[2]
                ];


                





$patternErb = '/<img\s+src="([^"]*\/erb\/[^"]+)"\s+.*\/>/';
preg_match($patternErb, $rows, $matchesErb);
$erbName = preg_replace('/.*\/(erb\/[^"]+)/', '$1', $matchesErb[1]);
$erbName = str_replace('erb/', '', $erbName);
$paragraphs[] = [
    'erb' => $erbName
];


$patternPhones = '/(\d{3}\s*\/\s*\d{3}\s*\d{2}\s*\d{2}),/';
preg_match_all($patternPhones, $rows, $matchesPhones);

$paragraphs[] = [
    'phones' => $matchesPhones[1]
];


$patternFaxs = '/Fax\s*<\/div>\s*<\/td>\s*<td[^>]*>(.*?)<\/td>/';
preg_match($patternFaxs, $rows, $matchesFaxs);
    $paragraphs[] = [
        'faxs' => $matchesFaxs[1]
    ];





            }

        }

        return view('city-detail-2', compact('paragraphs'));

    }

}