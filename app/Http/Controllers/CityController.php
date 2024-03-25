<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class CityController extends Controller
{
    public function show(string $id): View
    {
        // Tu môžeš definovať kód pre zobrazenie detailov mesta s ID $id
        return view('city.show', ['id' => $id]); // Závisí od toho, ako chceš prezentovať dáta
    }
}