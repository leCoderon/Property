<?php

namespace App\Http\Controllers;

use App\Events\ContactRequestEvent;
use App\Events\TestEvent;
use App\Http\Requests\ContactFormRequest;
use App\Http\Requests\SearchFormRequest;
use App\Mail\PropertyContactMail;
use App\Models\Property;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PropertyController extends Controller
{
    public function index(SearchFormRequest $request)
    {
        // We set a request on our model Property
        $query = Property::query();

        if ($request->validated('price')) {
            $price = $request->input('price');
            $query->where('price', '<=', $price);
        }

        if ($request->validated('rooms')) {
            $rooms = $request->input('rooms');
            $query->where('rooms', '>=', $rooms);
        }

        if ($request->validated('surface')) {
            $surface = $request->input('surface');
            $query->where('surface', '>=', $surface);
        }

        if ($request->validated('title')) {
            $title = $request->input('title');
            $query->where('title', 'like', "%{$title}%");
        }

        $properties = $query->paginate(9);
        $input = $request->validated();
        $propertiesAll = Property::paginate(9);

        return view("property.index", compact('properties', 'propertiesAll', 'input'));
    }

    public function show(string $slug, Property $property)
    {
        if ($slug !== $property->getSlug()) {
            return to_route("property.show", ["slug" => $property->getSlug(), "property" => $property->id]);
        }
        return view('property.show', compact('property'));
    }

    public function contact(ContactFormRequest $request, Property $property)
    {
        event(new ContactRequestEvent($property, $request->validated() ));
        // Mail::send(new PropertyContactMail($property, $request->validated()));
        return back()->with('success', 'Votre message a bien été envoyé');
    }
}
