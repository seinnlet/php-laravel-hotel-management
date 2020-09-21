<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->get();
        $users = $users->reject(function ($user, $key) {
            return $user->hasRole('Guest');
        });
        return view('backend.staff.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::whereNotIn('name', ['Admin', 'Guest'])->orderBy('name')->get();
        return view('backend.staff.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $messages = [
            'email.unique' => '* This Email Address is already Existed.',
            'name.required' => '* Please enter Staff Name.',
            'email.required' => '* Please enter Email Address.',
            'phone.required' => '* Please enter Phone Number.',
            'address.required' => '* Please enter Address.',
            'role.regex' => '* Please select Role for the Staff.',
        ];

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:App\User,email',
            'phone' => 'required',
            'role' => 'required|regex:/^[\pL\s\-]+$/u',
            'address' => 'required',
        ], $messages);

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make('staff@hotelriza');
        $user->assignRole($request->role);
        $user->save();

        $staff = new Staff;
        $staff->user_id = $user->id;
        $staff->gender = $request->gender;
        $staff->phone = $request->phone;
        $staff->address = $request->address;
        $staff->save();

        return redirect()->route('staff.index')->withSuccessMessage('New Staff is Successfully Added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('backend.staff.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('staff.index')->withSuccessMessage($user->name. ' is Successfully Deleted.');
    }
}
