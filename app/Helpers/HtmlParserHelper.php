<?php

namespace App\Helpers;

use PHPHtmlParser\Dom;
use App\Helpers\CityHelper;

class HtmlParserHelper
{
  public static function parseLinksDistricts($url)
  {
    $html = file_get_contents($url);
    $html = preg_replace('/[;\'",:-]|-->/u', '', $html);
    $html = preg_replace('/https\/\//', '', $html);

    $dom = new Dom;
    $dom->loadStr($html);

    $rows = $dom->find('a');
    $paragraphs = [];
    $existingLinks = [];

    foreach ($rows as $row) {
      $href = $row->getAttribute('href');
      if (strpos($href, 'www.eobce.sk/okres/') !== false && !in_array($href, $existingLinks)) {
        $paragraphs[] = [
          'text' => $row->text,
          'href' => $href
        ];
        // Pridajte odkaz do pola existujúcich odkazov
        $existingLinks[] = $href;
      }
    }

    return $paragraphs;
  }

  public static function parseLinksCities(...$districts)
  {


    $paragraphs = [];

    foreach ($districts as $district) {
        $url = 'https://www.e-obce.sk/okres/' . $district . '.html';
        $html = file_get_contents($url);
        $html = preg_replace('/[;\'",:-]|-->/u', '', $html);
        $html = preg_replace('/https\/\//', '', $html);

        $dom = new Dom;
        $dom->loadStr($html);

        $rows = $dom->find('a');
        $existingLinks = [];

        foreach ($rows as $row) {
            $href = $row->getAttribute('href');
            if (strpos($href, 'www.eobce.sk/obec/') !== false && !in_array($href, $existingLinks)) {
              if (strpos($href, '/fotky/') === false) {
                $paragraphs[] = [
                    'text' => $row->text,
                    'href' => $href
                ];
                // Pridajte odkaz do pola existujúcich odkazov
                $existingLinks[] = $href;
              }
            }
        }
    }

    return $paragraphs;
  }

  public static function parseLinksBydistrict($url)
  {
    $html = file_get_contents($url);
    $html = preg_replace('/[;\'",:-]|-->/u', '', $html);
    $html = preg_replace('/https\/\//', '', $html);


    $dom = new Dom;

    $dom->loadStr($html);

    $rows = $dom->find('a');
    $paragraphs = [];

    foreach ($rows as $row) {
      $href = $row->getAttribute('href');
      if (strpos($href, 'www.eobce.sk/obec/') !== false) {
        if (strpos($href, '/fotky/') === false) {
          $paragraphs[] = [
            'text' => $row->text,
            'href' => $href
          ];
        }
      }
    }

    return $paragraphs;
  }


  public static function parseLinksCityDetails($url)
  {
    $html = file_get_contents($url);
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

            // Hľadanie hodnôt pre Primátora
            $patternPrimator = '/<td>Primátor<\/td>\s*<td>(.*?)<\/td>/';
            preg_match($patternPrimator, $rows, $matchesPrimator);
            if (!empty($matchesPrimator)) {
                $paragraphs[] = [
                    'primator' => $matchesPrimator[1]
                ];
            }

            // Hľadanie hodnôt pre Starosta
            $patternStarosta = '/<td>Starosta<\/td>\s*<td>(.*?)<\/td>/';
            preg_match($patternStarosta, $rows, $matchesStarosta);
            if (!empty($matchesStarosta)) {
                $paragraphs[] = [
                    'starosta' => $matchesStarosta[1]
                ];
            }

            if (!empty($matchesPrimator)) {
              $bigBoss = $matchesPrimator[1];
            }
            if (!empty($matchesStarosta)) {
              $bigBoss = $matchesStarosta[1];
            }

            // Hľadanie hodnôt pre Prednostu
            // $patternPrednosta = '/<td>Prednosta<\/td>\s*<td>(.*?)<\/td>/';
            // preg_match($patternPrednosta, $rows, $matchesPrednosta);
            // if (!empty($matchesPrednosta)) {
            //     $paragraphs[] = [
            //         'prednosta' => $matchesPrednosta[1]
            //     ];
            // }

            // Hľadanie hodnôt pre Kraj
            $patternDistrict = '/<td width="167"><a[^>]*>(.*?)<\/a><\/td>/';
            preg_match($patternDistrict, $rows, $matchesDistrict);
            if (!empty($matchesDistrict)) {
                $paragraphs[] = [
                    'district' => $matchesDistrict[1]
                ];
            }

            // Hľadanie hodnôt pre Okres
            $patternCounty = '/<td>Okres<\/td>\s*<td><a[^>]*>(.*?)<\/a><\/td>/';
            preg_match($patternCounty, $rows, $matchesCounty);
            if (!empty($matchesCounty)) {
                $paragraphs[] = [
                    'county' => $matchesCounty[1]
                ];
            }

            // Hľadanie hodnôt pre Region
            $patternRegion = '/<td>Región<\/td>\s*<td>(.*?)<\/td>/';
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

            /* Emaily */
            $emails = []; // Inicializujeme pole emails
            foreach ($rows as $row) {
                $anchors = $row->find('a[href^=mailto]');
                foreach ($anchors as $anchor) {
                    $email = $anchor->getAttribute('href');
                    $email = str_replace('mailto:', '', $email);
                    $emails[] = $email;
                }
            }
            $emailString = implode(', ', $emails);
            $paragraphs[] = [
                'emails' => $emailString
            ];

            /* Weby */
            $patternWeb = '/<a\s[^>]*href="([^"]+)"[^>]*target="newwindow"[^>]*>(.*?)<\/a>/';
            preg_match($patternWeb, $rows, $matchesWeb);
            $paragraphs[] = [
                'web' => $matchesWeb[2]
            ];

            /* Erb */
            $patternErb = '/<img\s+src="([^"]*\/erb\/[^"]+)"\s+.*\/>/';
            preg_match($patternErb, $rows, $matchesErb);
            $erbName = preg_replace('/.*\/(erb\/[^"]+)/', '$1', $matchesErb[1]);
            $erbName = str_replace('erb/', '', $erbName);
            $paragraphs[] = [
                'erb' => $erbName
            ];

            /* Cisla */
            $patternPhones = '/(\d{3}\s*\/\s*\d{3}\s*\d{2}\s*\d{2}),.*$/';
            preg_match_all($patternPhones, $rows, $matchesPhones);
            $paragraphs[] = [
              'phones' => $matchesPhones[1]
            ];
            $phonesString = implode(', ', $matchesPhones[1]);


            /* Fax */
            $patternFaxs = '/Fax\s*<\/div>\s*<\/td>\s*<td[^>]*>(.*?)<\/td>/';
            preg_match($patternFaxs, $rows, $matchesFaxs);
            $paragraphs[] = [
                'faxs' => $matchesFaxs[1]
            ];

            /* Typ */
            $patternTyp = '/<h1>(.*?)<\/h1>/';
            preg_match($patternTyp, $rows, $matchesTyp);
            $wordsExplode = explode(' ', $matchesTyp[1]);
            $paragraphs[] = [
                'typ' => $wordsExplode[0]
            ];

        }

    }




    CityHelper::insertCity($wordsExplode[0], $wordsExplode[1], $bigBoss, $matchesDistrict[1], $matchesCounty[1], $matchesRegion[1], '4d', $phonesString, $matchesFaxs[1], $emailString, $matchesWeb[2], $erbName, 3);

    return $paragraphs;

  }

}
