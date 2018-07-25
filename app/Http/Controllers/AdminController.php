<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = User::where('role', 1)->get();
        return view('olx.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('olx.admins.single');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|unique:users',
            'name' => 'required|unique:users',
            'phone' => 'required|numeric',
            'password'=>'required',
            'address'=>'required'
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => bcrypt(request('password')),
            'role' => 1,
            'active_code' => str_random(20),
            'tokens' => str_random(150),
            'activate' => 1,
        ]);
        return redirect('olx/admins')->with('success', 'admin added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = User::find($id);
        return view('olx.admins.single', compact('admin'));
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
        $this->validate($request, [
            'email' => 'email',
            'phone' => 'numeric|required'
        ]);
        $admin = User::find($id);
        if ((request('name')) != '') {
            if ((request('name')) != $admin->name) {
                $this->validate($request, [
                    'name' => 'unique:users'
                ]);
            }
            $admin->name = request('name');
        }
        if ((request('email')) != '') {
            if ((request('email')) != $admin->email) {
                $this->validate($request, [
                    'email' => 'email|unique:users'
                ]);
            }
            $admin->email = request('email');
        }
        if ((request('password')) != '') {
            $admin->password = bcrypt(request('password'));
        }
        if ((request('phone')) != '') {
            $admin->phone = request('phone');
        }
        $admin->save();
        return redirect('olx/admins')->with('success', 'admin updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::where('user_id', $id)->delete();
        Contact::where('user_id', $id)->delete();
        User::destroy($id);
    }
}
