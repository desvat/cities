<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPHtmlParser\Dom;

class HtmlParseController extends Controller
{
    public function parseHtml()
    {

        $html = file_get_contents('https://www.e-obce.sk/okres/levice.html');
        $html = file_get_contents('https://www.e-obce.sk/okres/nitra.html');


        
        $html = preg_replace('/[;\'",:-]|-->/u', '', $html);

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
        
        return view('welcome', compact('paragraphs'));

    }
}