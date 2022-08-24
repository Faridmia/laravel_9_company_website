<?php
namespace App\Http\Controllers;
use App\Models\HomeAbout;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use  App\Models\Multipic;
class AboutController extends Controller
{
    //

    public function HomeAbout() {

        $homeabout = HomeAbout::latest()->paginate(5);
        
        return view('admin.home.index',compact('homeabout'));
    }

    public function AddAbout() {

        return view('admin.home.create');

    }

    public function StoreAbout( Request $request ) {

        $validatedData = $request->validate([
            'about_title' => 'required',
            'short_desc'  => 'required',
            'long_desc'   => 'required',
        ],
        [
            'about_title.required'=> 'Please Input About Title',
            'short_desc.required' => 'Please Input Short Description',
            'long_desc.required'  => 'Please Input Long Description',
        ]);

        HomeAbout::insert([
            'title'      =>  $request->about_title,
            'short_desc' =>  $request->short_desc,
            'long_desc'  =>  $request->long_desc,
            'created_at' =>  Carbon::now(),
        ]);

        
        return Redirect()->route('home.about')->with('success','about updated');


    }

    public function AboutEdit( $id ) {
        $homeabouts = HomeAbout::find($id); // elequoent ORM

        return view('admin.home.edit',compact('homeabouts'));
    }

    public function AboutUpdate( Request $request,$id ) {

        $validatedData = $request->validate([
            'about_title' => 'required',
        ],
        [
            'about_title.required'=> 'Please Input About Title',
        ]);
       
        HomeAbout::find($id)->update([
            'title'      => $request->about_title,
            'short_desc' => $request->short_desc,
            'long_desc'  => $request->long_desc
        ]);

        return Redirect()->route('home.about')->with('success','about updated');

       // return Redirect()->back()->with('success','About Delete Success');

    }

    public function AboutDelete( $id ) {

        HomeAbout::find($id)->delete();

        return Redirect()->back()->with('success','About Delete Success');
        
    }

    public function Logout() {
        Auth::logout();
        return Redirect()->route('login')->with('success','User Logout');
    }

    public function Portfolio() {

        $multipics = Multipic::all();
        return view('pages.portfolio',compact('multipics'));
    }
}
