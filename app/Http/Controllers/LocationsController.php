<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\View\View;

class LocationsController extends Controller
{
    // public function index()

    // {

    //     $locations = Location::all();
    //     return view('locations', ['locations' => $locations]);

    // }

    public function index()
    {
        // Získajte všetky lokality typu kraj (koreňové lokality)
        $regions = Location::where('location_type', 'kraj')->get();

        // Pre každý kraj, získajte jeho okresy a pridajte ich ako potomkov krajov
        foreach ($regions as $region) {
            $region->children = $this->getDistrictsForRegion($region->location_id);
        }

        return view('locations', ['regions' => $regions]);
    }

    private function getDistrictsForRegion($regionId)
    {
        // Získajte okresy pre daný kraj
        $districts = Location::where('location_type', 'okres')
                             ->where('location_parent_id', $regionId)
                             ->get();

        // Pre každý okres, získajte jeho mestá a obce a pridajte ich ako potomkov okresov
        foreach ($districts as $district) {
            $district->children = $this->getCitiesAndTownsForDistrict($district->location_id);
        }

        return $districts;
    }

    private function getCitiesAndTownsForDistrict($districtId)
    {
        // Získajte mestá a obce pre daný okres
        return Location::where('location_type', '!=', 'kraj')
                       ->where('location_parent_id', $districtId)
                       ->get();
    }
}