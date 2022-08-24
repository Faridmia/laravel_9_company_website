<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Expr\FuncCall;

class CategoryController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AllCategory() {

       // $categories = Category::all();
       $categories = Category::latest()->paginate(5);

       $trashcat = Category::onlyTrashed()->latest()->paginate(3);


       // query builder

      // $categories = DB::table('categories')->latest()->get();
      // $categories = DB::table('categories')->latest()->paginate(5);

    //   $categories = DB::table('categories')
    //     ->join('users','categories.user_id','users.id')
    //     ->select('categories.*','users.name')->latest()->paginate(5);


        return view('admin.category.index',compact('categories','trashcat'));
    }

    public function addCat( Request $request ) {
        
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],
        [
            'category_name.required' => 'Please Input Category Name',
            'category_name.max' => 'Category Less Then 255chars',
        ]);

        // $cat = $request->all();
        // $cat->save();

        // $category = new Category;

        // $user_id = Auth::user()->id;
 
        // $category->category_name = $request->category_name;
        // $category->user_id = $user_id;
 
        // $category->save();

        Category::insert([
           'category_name' => $request->category_name,
           'user_id' => Auth::user()->id,
           'created_at' => Carbon::now()
        ]);


        return redirect('/category/all')->with('message','Category Save Successfully..');
    }


    // query builder
    // public function addCat( Request $request ) {

    //     $data = [];

    //     $user_id = Auth::user()->id;

    //     $data['category_name'] = $request->category_name;
    //     $data['user_id'] = $user_id;

    //     $db_inserted = DB::table('categories')->insert($data);

    //     if( $db_inserted) {
    //       // return redirect()->back()->with('message','Category Save Successfully..');
    //         return redirect('/category/all')->with('message','Category Save Successfully..');

    //     } 
    // }


    public function CategoryEdit($id) {
       // $categories = Category::find($id); // elequoent ORM

       $categories = DB::table('categories')->where('id',$id)->first();

        return view('admin.category.edit',compact('categories'));
    }

    public function CategoryUpdate(Request $request,$id ) {

        // eloquent orm
        $update_cat = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id
        ]);

        // query builder

        // $data = array();

        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;

        // DB::table('categories')->where('id',$id)->update($data);

       // return redirect('/category/all')->with('message','Category Update Successfully..');

        return Redirect()->route('all.category')->with('success','category updated');
    }

    public function CategoryDelete($id) {

        $delete = Category::find($id)->delete();

        return Redirect()->back()->with('success','Soft Delete Success');
    }

    public function CatRestore($id) {

        $delete = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success','Category Restore Success');
    }

    public function PDelete($id) {
        $delete = Category::onlyTrashed()->find($id)->forceDelete();

        return Redirect()->back()->with('success','Permanent Delete Success');
    }
}
