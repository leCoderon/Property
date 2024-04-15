<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchCityFormRequest;
use App\Http\Requests\SearchFormRequest;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index(SearchCityFormRequest $request)
    {
        // User::create([
        //     "name" => "John Doe",
        //     "email" => "john@doe.com",
        //     "password" => Hash::make('0000'),
        // ]);
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
