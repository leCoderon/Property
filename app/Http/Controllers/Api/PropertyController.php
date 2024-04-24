<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PropertyCollection;
use App\Http\Resources\PropertyRessource;
use App\Models\property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new PropertyCollection(Property::with('options')->limit(3)->get());
        // return  PropertyRessource::collection(Property::with('options')->paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(property $property)
    {
        return new PropertyRessource(Property::with('options')->find($property->id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(property $property)
    {
        //
    }
}
