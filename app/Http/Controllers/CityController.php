<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\City;

class CityController extends Controller
{

    public function searchByName(Request $request) {

        $query = $request->input('query');
        $results = City::where('city_name', 'like', "%$query%")
                        ->whereNotIn('city_type', ['kraj', 'okres'])
                        ->select('city_name', 'city_id', 'city_type')
                        ->get();
        
        if ($results->isEmpty()) {
            return response()->json(['message' => 'Žiadne záznamy neboli nájdené']);
        }
                        
        return response()->json($results);

    }

    public function showDetail(Request $request, $id) {
    
        $city = City::where('city_id', $id)
                    ->whereNotIn('city_type', ['kraj', 'okres'])
                    ->first();
    
        if (!$city) {
            return view('city-details')->with('message', 'Záznam s ID ' . $id . ' nebol nájdený');
        }
    
        return view('city-details', compact('city'));
    }


}