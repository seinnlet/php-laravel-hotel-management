<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Foodcategory;

class FoodcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foodcategories = Foodcategory::withCount('food')->get();
        return view('backend.foodcategory.index', compact('foodcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.foodcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => '* Please enter Category Name.',
            'name.unique' => '* This Category Name is already Existed.',
        ];
        $validatedData = $request->validate([
            'name' => 'required|unique:foodcategories',
        ], $messages);

        $foodcategory = new Foodcategory;
        $foodcategory->name = $request->name;
        $foodcategory->save();

        return redirect()->route('foodcategories.index')->withSuccessMessage('New Category is Successfully Added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $foodcategory = Foodcategory::find($id);
        return view('backend.foodcategory.edit', compact('foodcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'name.required' => '* Please enter Category Name.',
            'name.unique' => '* This Category Name is already Existed.',
        ];
        $validatedData = $request->validate([
            'name' => 'required|unique:App\Foodcategory,name,'.$id,
        ], $messages);

        $foodcategory = Foodcategory::find($id);
        $foodcategory->name = $request->name;
        $foodcategory->save();

        return redirect()->route('foodcategories.index')->withSuccessMessage($foodcategory->name . ' is Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $foodcategory = Foodcategory::find($id);
        $foodcategory->delete();

        return redirect()->route('foodcategories.index')->withSuccessMessage($foodcategory->name. ' is Successfully Deleted.');
    }
}
