<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Food;
use App\Foodcategory;
use Illuminate\Support\Facades\File;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $food = Food::all();
        $foodcategories = Foodcategory::all();
        return view('backend.menu.index', compact('food', 'foodcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $foodcategories = Foodcategory::orderBy('name')->get();
        return view('backend.menu.create', compact('foodcategories'));
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
            'name.required' => '* Please enter Menu Name.',
            'image.required' => '* Please choose Menu Image.',
            'unitprice.required' => '* Please enter Menu Price.',
            'unitprice.numeric' => 'Please enter number value for Price.',
            'unitprice.min' => 'Price should be greater than 0.',
            'unitprice.max' => 'Price should be greater than 100000.',
            'foodcategory_id.numeric' => '* Please choose Menu Category.'
        ];

        // validation
        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'unitprice' => 'required|min:0|max:1000000|numeric',
            'foodcategory_id' => 'required|numeric'
        ], $messages);

        // image upload
        $imagename = date('Ymd').time().'.'.$request->image->extension();
        $request->image->move(public_path('backend/img/menu/'), $imagename);

        $food = new Food;
        $food->name = $request->name;
        $food->unitprice = $request->unitprice;
        $food->image = 'backend/img/menu/'.$imagename;
        $food->foodcategory_id = $request->foodcategory_id;
        $food->save();

        return redirect()->route('menus.index')->withSuccessMessage('New Menu is Successfully Added.');
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
        $food = Food::find($id);
        $foodcategories = Foodcategory::orderBy('name')->get();
        return view('backend.menu.edit', compact('food', 'foodcategories'));
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
        // dd($request);
        $messages = [
            'name.required' => '* Please enter Menu Name.',
            'image.required' => '* Please choose Menu Image.',
            'unitprice.required' => '* Please enter Menu Price.',
            'unitprice.numeric' => 'Please enter number value for Price.',
            'unitprice.min' => 'Price should be greater than 0.',
            'unitprice.max' => 'Price should be greater than 100000.',
            'foodcategory_id.numeric' => '* Please choose Menu Category.'
        ];

        // validation
        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg',
            'unitprice' => 'required|min:0|max:1000000|numeric',
            'foodcategory_id' => 'required|numeric'
        ], $messages);

        $filePath = $request->old_image;
        if ($request->hasfile('image')) 
        {
            $photoName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('backend/img/menu/'), $photoName);
            // remove photo
            $file = public_path($filePath);
            if (File::exists($file)) {
                File::delete($file);
            }
            $filePath = 'backend/img/menu/'.$photoName;
        }

        $food = Food::find($id);
        $food->name = $request->name;
        $food->unitprice = $request->unitprice;
        $food->image = $filePath;
        $food->foodcategory_id = $request->foodcategory_id;
        $food->save();

        return redirect()->route('menus.index')->withSuccessMessage($food->name . ' is Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $food = Food::find($id);

        $file = public_path($food->image);
        if (File::exists($file)) {
            File::delete($file);
        }
        $food->delete();
        return redirect()->route('menus.index')->withSuccessMessage($food->name. ' is Successfully Deleted.');
    }
}
