<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OptionFormRequest;
use App\Models\Option;
use Illuminate\View\View;

class OptionController extends Controller
{

    public function __construct(){
        $this->authorizeResource(Option::class, 'option');
    }
    
    /**
     * Display a listing of the resource.
     * @return Illuminate\View\View
     */
    public function index():View
    {
        $options = Option::paginate(10);
        return view('admin.options.index', compact('options'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Illuminate\View\View
     * 
     */
    public function create():View
    {
        $option = new Option();
        return view('admin.options.form', compact('option'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Illuminate\Foundation\Http\FormRequest\OptionFormRequest $request
     * @return route
     */
    public function store(OptionFormRequest $request)
    {
        $data = $request->validated();
         Option::create($data);

        return to_route("admin.option.index")->with("success", "L'option à bien été crée");
    }

    /**
     * Show the form for editing the specified resource.
     * @param App\Models\Option $options
     * @return Illuminate\View\View
     * 
     */
    public function edit(Option $option):View
    {
        return view("admin.options.form", compact('option'));
    }

    /**
     * Update the specified resource in storage.
     * @param Illuminate\Foundation\Http\FormRequest\OptionFormRequest $request
     * @param App\Models\Option $options
     *  
     */
    public function update(OptionFormRequest $request, Option $option)
    {
        // dd($request->validated());
        $data = $request->validated();
        $option = $option->update($data);

        return to_route("admin.option.index")->with('success', 'L\'option à bien été mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     * @param App\Models\Option $options
     */
    public function destroy(Option $option)
    {
        $option->delete();
        return to_route("admin.option.index")->with('success', 'L\'option à bien été supprimé');
    }
   
}
