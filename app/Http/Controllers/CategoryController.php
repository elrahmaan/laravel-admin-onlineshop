<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Google\Cloud\Firestore\FirestoreClient;

class CategoryController extends Controller
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
        // $category = Category::all();
        $docRef = self::$db->collection('categories')->orderBy('category_code');
        $snapshot = $docRef->documents();
        $category = $snapshot;   
        return view('category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.category_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Category::create($request->all());
        $validatedData = $request->validate([
            'category_code' => 'required',
            'category_name' => 'required',
            'category_icon' =>'required|mimes:jpg,jpeg,png|max:5120',
            'category_desc' => 'required'
        ]);
        if($request->file('category_icon')){
            $validatedData['category_icon'] = $request->file('category_icon')->store('category-icons');
            $imageURL = 'http://localhost:8000/storage/' . $validatedData['category_icon'];
        }

        $category = self::$db->collection('categories');
        $category->add([
            'category_code' => $request->category_code,
            'category_name' => $request->category_name,
            'category_icon' => $imageURL,
            'category_desc' => $request->category_desc
        ]);
        return redirect()->route('category.index');
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
        // $category = Category::find($id);
        // $id = $category->id;
        $category = self::$db->collection('categories')->document($id)->snapshot();

        return view('category.category_edit', compact('category'));
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
        // $category = Category::find($id);
        // $category->update($request->all());
        $rules = [
            'category_code' => 'required',
            'category_name' => 'required',
            'category_icon' =>'required|mimes:jpg,jpeg,png|max:5120',
            'category_desc' => 'required'
        ];
        $validatedData = $request->validate($rules);

        if($request->file('category_icon')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['category_icon'] = $request->file('category_icon')->store('category-icons');
            $imageURL = 'http://localhost:8000/storage/' . $validatedData['category_icon'];
        }

        $category = self::$db->collection('categories')->document($id);
        $category->set([
            'category_code' => $request->category_code,
            'category_name' => $request->category_name,
            'category_icon' => $imageURL,
            'category_desc' => $request->category_desc
        ]);
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $category = Category::find($id);
        // $category->delete();
        $category = self::$db->collection('categories')->document($id);
        $categories = self::$db->collection('categories')->documents();

        foreach($categories as $ctg){
            if($ctg->id() == $id){
                $imageCategory = $ctg['category_icon'];
            }
        }
        if($imageCategory){
            Storage::delete(substr($imageCategory, 30, 200));
        }   

        $category->delete();
        return redirect()->route('category.index');
    }
}
