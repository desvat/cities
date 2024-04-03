<?php

namespace App\Helpers;

use PHPHtmlParser\Dom;

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

}
