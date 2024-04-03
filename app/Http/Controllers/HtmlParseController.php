<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPHtmlParser\Dom;

class HtmlParseController extends Controller
{
    public function parseDistricts()
    {

        $html = file_get_contents('https://www.e-obce.sk/kraj/NR.html');
        
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
        
        return view('district', compact('paragraphs'));
    }


    public function parseCities()
    {

        $html = file_get_contents('https://www.e-obce.sk/okres/levice.html');
        
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
        
        return view('cities', compact('paragraphs'));

    }
    public function parseCitiesBydistrict($disctrict)
    {

        $html = file_get_contents('https://www.e-obce.sk/okres/' . $disctrict . '.html');
        
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
        
        // Kontrola, či je pole $paragraphs prázdne
        if (empty($paragraphs)) {
            $message = 'Nenájdený žiadny záznam.';
            return view('cities', compact('message'));
        } else {
            return view('cities', compact('paragraphs'));
        }

    }

}