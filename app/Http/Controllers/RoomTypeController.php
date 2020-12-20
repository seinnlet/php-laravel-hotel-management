<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Roomtype;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roomtypes = Roomtype::withCount([
                        'rooms',
                        'rooms as available_rooms' => function (Builder $query) {
                            $query->where('status', 1);
                        },
                    ])->get();
        return view('backend.roomtype.index', compact('roomtypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.roomtype.create');
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
            'name.required' => '* Please enter Room Type Name.',
            'name.unique' => '* This Room Type is already Existed.',
            'pricepernight.required' => '* Please enter Price per Night.',
            'noofpeople.required' => '* Please enter Maximum People for this Room Type.',
            'noofbed.required' => '* Please enter Number of Bed for this Room Type.',
            'description.required' => '* Please enter Description for this Room Type.',
            'images.required' => '* Please upload at least One Image.'
        ];

        // for image restriction
        Validator::extend('max_files_allowed', function ($attribute, $value, $parameters, $validator) {
            //$attribute is now "test" not "test.0" 
            $field_name = $attribute;
            $files = $validator->getData()[$field_name];
            return (count($files) <= $parameters[0]) ? true : false;
        },"* Sorry, 3 Images is the Maximum. Please upload again.");

        $request->validate([
            'name' => 'required|unique:App\Roomtype,name',
            'pricepernight' => 'required|min:0|max:10000|numeric',
            'noofpeople' => 'required|min:1|max:10|numeric',
            'noofbed' => 'required|min:1|max:10|numeric',
            'description' => 'required',
            'images' => 'required|max_files_allowed:3'
        ], $messages);

        $roomtype = new Roomtype;
        $roomtype->name = $request->name;
        $roomtype->slug = Str::slug($request->name);
        $roomtype->pricepernight = $request->pricepernight;
        $roomtype->noofpeople = $request->noofpeople;
        $roomtype->noofbed = $request->noofbed;
        $roomtype->description = $request->description;
        $roomtype->image1 = "";
        $roomtype->image2 = "";
        $roomtype->image3 = "";

        // file upload
        for ($i=0; $i < count($request->images); $i++) {
            $imagename = date('Ymd').time().'_'.$i.'.'.$request->images[$i]->extension();
            $request->images[$i]->move(public_path('backend/img/roomtype/'), $imagename);

            switch ($i) {
                case 0: $roomtype->image1 = 'backend/img/roomtype/'.$imagename;
                    break;
                case 1: $roomtype->image2 = 'backend/img/roomtype/'.$imagename;
                    break;
                case 2: $roomtype->image3 = 'backend/img/roomtype/'.$imagename;
                    break;
            }
        }

        $roomtype->save();

        return redirect()->route('roomtypes.index')->withSuccessMessage('New Room Type is Successfully Added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roomtype = Roomtype::find($id);
        return view('backend.roomtype.show', compact('roomtype'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roomtype = Roomtype::find($id);
        return view('backend.roomtype.edit', compact('roomtype'));
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
        // dd($request->images ? count($request->images) : 0);

        $messages = [
            'name.required' => '* Please enter Room Type Name.',
            'pricepernight.required' => '* Please enter Price per Night.',
            'noofpeople.required' => '* Please enter Maximum People for this Room Type.',
            'noofbed.required' => '* Please enter Number of Bed for this Room Type.',
            'description.required' => '* Please enter Description for this Room Type.',
        ];

        // for image restriction
        $oldimagecount = $request->oldimages ? count($request->oldimages) : 0;
        Validator::extend('max_files_allowed', function ($attribute, $value, $parameters, $validator) {
            //$attribute is now "test" not "test.0" 
            $field_name = $attribute;
            $files = $validator->getData()[$field_name];
            return (count($files)+$parameters[1] <= $parameters[0]) ? true : false;
        },"* Sorry, 3 Images is the Maximum. Please upload again.");

        $request->validate([
            'name' => 'required',
            'pricepernight' => 'required|min:0|max:10000|numeric',
            'noofpeople' => 'required|min:1|max:10|numeric',
            'noofbed' => 'required|min:1|max:10|numeric',
            'description' => 'required',
            'images' => "max_files_allowed:3,$oldimagecount",

        ], $messages);

        $roomtype = Roomtype::find($id);
        $roomtype->name = $request->name;
        $roomtype->pricepernight = $request->pricepernight;
        $roomtype->noofpeople = $request->noofpeople;
        $roomtype->noofbed = $request->noofbed;
        $roomtype->description = $request->description;
        $roomtype->image1 = "";
        $roomtype->image2 = "";
        $roomtype->image3 = "";

        $imagecount = ($request->oldimages ? count($request->oldimages) : 0) + ($request->images ? count($request->images) : 0);
        $oldimagename = array($request->oldimage1, $request->oldimage2, $request->oldimage3);

        // unlink
        $result = $request->oldimages ? array_diff($oldimagename, $request->oldimages) : $oldimagename;
        foreach ($result as $name) {
            $file = public_path($name);
            if (File::exists($file)) {
                File::delete($file);
            }
        }

        // store 
        $i=0;
        if ($request->oldimages) {
            foreach ($request->oldimages as $image) {
                switch ($i) {
                    case 0: $roomtype->image1 = $image;
                        break;
                    case 1: $roomtype->image2 = $image;
                        break;
                    case 2: $roomtype->image3 = $image;
                        break;
                }
                ++$i;
            }
        }

        if ($request->images) {
            foreach ($request->images as $image) {
                $imagename = date('Ymd').time().'_'.$i.'.'.$image->extension();
                $image->move(public_path('backend/img/roomtype/'), $imagename);

                switch ($i) {
                    case 0: $roomtype->image1 = 'backend/img/roomtype/'.$imagename;
                        break;
                    case 1: $roomtype->image2 = 'backend/img/roomtype/'.$imagename;
                        break;
                    case 2: $roomtype->image3 = 'backend/img/roomtype/'.$imagename;
                        break;
                }
                ++$i;
            }
        }
            
        $roomtype->save();

        return redirect()->route('roomtypes.index')->withSuccessMessage($roomtype->name . ' Room Type is Successfully Updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $roomtype = Roomtype::find($id);
        $roomtype->delete();

        $file1 = public_path($roomtype->image1);
        if (File::exists($file1)) {
            File::delete($file1);
        }
        $file2 = public_path($roomtype->image2);
        if (File::exists($file2)) {
            File::delete($file2);
        }
        $file3 = public_path($roomtype->image3);
        if (File::exists($file3)) {
            File::delete($file3);
        }

        return redirect()->route('roomtypes.index')->withSuccessMessage($roomtype->name. ' is Successfully Deleted.');
    }
}
