<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    protected static $db;

    protected static function firestoreDatabaseInstance(){
        $db = new FirestoreClient([
        'projectId'=> 'online-shop-ce498'
        ]);

        return $db;
    }
    public function __construct(){
        static::$db = self::firestoreDatabaseInstance();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('role', 'desc')->get();
        return view('user.index', compact('users'));
    }

    public function customer()
    {
        $users = self::$db->collection('users')->orderBy('username')->documents();
        return view('user.customer', compact('users'));
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
        // if ($request->file('image')) {
        //     $image = $request->file('image')->store('/images', 'public');
        // }
        if($request->password != $request->confirmPassword){
            return redirect()->route('user.create')->with('failed', 'Password tidak sama');
        }else{
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'role' => $request->role,
            ]);
            return redirect('/user')->with('success', 'Data berhasil ditambahkan');
        }
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
        return view('user.user_editprofile', compact('id', 'user'));
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
        $users->phone = $request->phone;
        $users->role = $request->role;
        if($request->password){
            $users->password = Hash::make($request->password);
            if($request->password != $request->confirmPassword){
                // return redirect('/user' + '/' + $id + '/edit')->with('failed', 'Password tidak sama');
                return redirect()->route('user.edit', $id)->with('failed', 'Password tidak sama');
            }
        }else{
            $users->save();
        }
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
        return redirect('/user')->with('success', 'Data telah dihapus');;
    }
}
