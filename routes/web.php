<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AboutController;
use App\Models\User;
use App\Models\Multipic;
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {

    $brands    = DB::table('brands')->get();
    $multipics = Multipic::all();
    $abouts    = DB::table('home_abouts')->first();
    return view('home',compact('brands','abouts','multipics'));

});

Route::middleware('admin:admin')->group(function() {
    Route::get('admin/login',[ AdminController::class,'loginForm' ]);
    Route::post('admin/login',[ AdminController::class,'store' ])->name('admin.login');
});


Route::middleware([ 'auth:sanctum,admin',config('jetstream.auth_session'),'verified'
])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboard');
    })->name('dashboard')->middleware('auth:admin');
});


// category controller

Route::get('/category/all',[CategoryController::class,'AllCategory'])->name('all.category');


Route::post('/category/add',[CategoryController::class,'addCat'])->name('store.category');
Route::post('/category/update/{id}',[CategoryController::class,'CategoryUpdate']);


Route::get('/category/edit/{id}',[CategoryController::class,'CategoryEdit'] );
Route::get('/softdelete/category/{id}',[CategoryController::class,'CategoryDelete'] );
Route::get('/category/restore/{id}',[CategoryController::class,'CatRestore'] );

// perment delete 
Route::get('/pdelete/category/{id}',[CategoryController::class,'PDelete'] );

// brand for route

Route::get('/brand/all',[BrandController::class,'AllBrand'])->name('all.brand');

Route::post('/brand/add',[BrandController::class,'StoreBrand'])->name('store.brand');

Route::get('/brand/edit/{id}',[BrandController::class,'BrandEdit'] );
Route::get('/delete/brand/{id}',[BrandController::class,'BrandDelete'] );

Route::post('/brand/update/{id}',[BrandController::class,'BrandUpdate']);


// multi image route
Route::get('/multi/image',[BrandController::class,'MultiPic'])->name('multi.image');
Route::post('/multiimage/add',[BrandController::class,'Storeimage'])->name('store.multimage');


Route::middleware([ 'auth:sanctum',config('jetstream.auth_session'),'verified'
])->group(function () {
    Route::get('/dashboard', function () {

      //  $users = User::all();  // eloquent orm table fetch data

        $users = DB::table('users')->get();

        return view('admin.index');
    })->name('dashboard');
});

Route::get('/user/logout',[BrandController::class,'Logout'])->name('user.logout');

// slider

Route::get('/slider/all',[SliderController::class,'Allslider'])->name('all.slider');

Route::post('/slider/add',[SliderController::class,'StoreSlider'])->name('store.slider');

Route::get('/slider/edit/{id}',[SliderController::class,'SliderEdit'] );
Route::get('/delete/slider/{id}',[SliderController::class,'SliderDelete'] );

Route::post('/slider/update/{id}',[SliderController::class,'SliderUpdate']);


// home about all route

Route::get('/home/about',[AboutController::class,'HomeAbout'])->name('home.about');

Route::get('/about/add',[AboutController::class,'AddAbout'])->name('add.about');
Route::post('/about/store',[AboutController::class,'StoreAbout'])->name('store.about');

Route::get('/about/edit/{id}',[AboutController::class,'AboutEdit'] );
Route::get('/delete/about/{id}',[AboutController::class,'AboutDelete'] );

Route::post('/about/update/{id}',[AboutController::class,'AboutUpdate']);


//  portfolio page route

Route::get('/portfolio',[AboutController::class,'Portfolio'])->name('portfolio');




