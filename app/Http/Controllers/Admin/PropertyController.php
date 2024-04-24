<?php

namespace App\Http\Controllers\Admin;

use App\Events\DeletePropertyEvent;
use App\Events\PropertyEvent;
use App\Events\StorePropertyEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyFormRequest;
use App\Http\Requests\PropertyUpdateFormRequest as UpdateRequest;
use App\Models\Image;
use App\Models\Option;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PropertyController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Property::class, 'property');
    }

    /*
     * Display a listing of the resource.
     * @return Illuminate\View\View View
     */
    public function index(): View
    {

        $properties = Property::Available()->Recent()->paginate(10);
        return view('admin.properties.index', compact('properties',));
    }

    /**
     * Show the form for creating a new resource.
     * @return Illuminate\View\View view
     */
    public function create(): view
    {
        
        $property = new Property();
        $options = Option::pluck('name', 'id');
        return view('admin.properties.form', compact('property', 'options'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  App\Http\Requests\PropertyFormRequest $request
     * @return route
     */
    public function store(PropertyFormRequest $request)
    {
        $data = $request->validated();
        $options = $request->options;
        $property  = Property::create($data);
        $property->options()->sync($options);

        $this->imageUpload($request, $property);

        event(new StorePropertyEvent($property));
        return to_route("admin.property.index")
            ->with("success", "La propriété à bien été crée");
    }

    /**
     * Store a newly created resource in storage.
     * @param  App\Http\Requests\PropertyFormRequest $request
     * @param  App\Models\Property $property
     */
    protected function imageUpload($request, Property $property): void
    {
        if ($request->has('images')) {
            $images = [];
            $uploadedImages = $request->file('images');

            foreach ($uploadedImages as $key => $uploadedImage) {
                $imageName = time() . rand(1, 99) . '.' . $uploadedImage->extension();
                $imagePath = $uploadedImage->storeAs('photos', $imageName, 'public');

                $images[]['name'] = $imagePath;
            }

            foreach ($images as $key => $value) {
                $image = Image::create($value);
                $image->property()->associate($property);
                $image->save();
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param  App\Http\Requests\PropertyFormRequest $request
     * @param  App\Models\Property $property
     * @return Illuminate\View\View  View
     */
    public function edit(Property $property, Request $request): View
    {
        $options = Option::pluck('name', 'id');

        return view("admin.properties.form", compact('property', 'options'));
    }

    /**
     * Update the specified resource in storage.
     * @param  App\Models\Property $property
     *  @param App\Http\Requests\PropertyUpdateFormRequest $request
     */
    public function update(UpdateRequest $request, Property $property)
    {

        $data = $request->validated();
        $property = $property->update($data);
        $options = $request->options;
        $property->options()->sync($options);

        $this->imageUpload($request, $property);

        return to_route("admin.property.index")->with('success', 'La propriété à bien été mis à jour');
    }

    /**
     * Remove the specified resource from storage.
    //  * @param  App\Models\Propertyf $property
     * @return route
     */
    public function destroy(Property $property)
    {
        event(new DeletePropertyEvent($property));
        $property->delete();
        return to_route("admin.property.index")->with('success', 'La propriété a bien été supprimé');
    }

    /**
     * Remove the specified resource from storage.
     * @param  App\Models\Image $image
     * @return route
     */
    public function deleteImage(Image $image)
    {
        $image->delete();
                return back()->with('success', 'L\'image a bien été supprimé');
    }
}
