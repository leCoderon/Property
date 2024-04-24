<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchCityFormRequest;
use App\Models\Property;

class HomeController extends Controller
{
    public function index(SearchCityFormRequest $request)
    {

       
        $query = Property::query();
        if ($request->has('city')) {
            $city = $request->input('city');

            $query->where('city', 'like', "%{$city}%");
        }

        $input = $request->validated('city');

        $properties = $query->orderBy("updated_at", "desc")->limit(9)->get();
        return view("home", compact("properties", "input"));
    }
}
