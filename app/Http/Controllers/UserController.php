<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.user_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // User::create($request->all());
        // return redirect()->route('user.index');
        if ($request->file('image')) {
            $image = $request->file('image')->store('/images', 'public');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'image' => $image,
            // 'role' => $request->role,
            // 'image' => $image,
            // 'address' => $request->address,
            // 'city' => $request->city,
            // 'province' => $request->province,
            // 'pincode' => $request->pincode,
            // 'mobile' => $request->mobile
        ]);
        return redirect('/user')->with('success', 'Data berhasil ditambahkan');
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
        $user = User::find($id);
        $id = $user->id;
        return view('user.user_edit', compact('id', 'user'));
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

        $users = User::find($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = Hash::make($request->password);
        $users->role = $request->role;
        if ($users->image && file_exists(storage_path('app/public/' . $users->image))) {
            \Storage::delete('public' . $users->image);
        }
        $image = $request->file('image')->store('images', 'public');
        $users->image = $image;
        // $users->role = $request->role;
        // if ($users->image && file_exists(storage_path('app/public/' . $users->image))) {
        //     \Storage::delete('public' . $users->image);
        // }
        // $image = $request->file('image')->store('images', 'public');
        // $users->image = $image;
        // $users->address = $request->address;
        // $users->city = $request->city;
        // $users->province = $request->province;
        // $users->pincode = $request->pincode;
        // $users->mobile = $request->mobile;
        $users->save();
        return redirect('/user')->with('success', 'Data berhasil diubah');
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
        return redirect('/user')->with('danger', 'Data telah dihapus');;
    }
}
