<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
use Illuminate\Routing\Controllers\Middleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/search', function (Request $request) {
//    //dd($request);
//    return $request->name;

// });


//single listing
// Route::get('/listings/{id}', function ($id) {
//     $listing = Listing::find($id);

//     if ($listing){
//     return view('listing', [
//         'listing' => $listing
        
//     ]);
//   } else{
//     abort('404');
//   }
// });

// commmon resource route
//index -- show all listing
//show -- show single listing
//create -- show form to create new listing
//store -- store new listing
//edit-- show form to edit new listing
//update -- update listing
//destroy -- delete listing

//All listing
Route::get('/', [ListingController::class, 'index']);

// show create form
Route::get('/listings/create', [ListingController::class, 'create'] )->Middleware('auth');


// store listing data
Route::post('/listings', [ListingController::class, 'store'] )->Middleware('auth');


// show edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'] )->Middleware('auth');


//  updatee listinbgs
Route::put('/listings/{listing}', [ListingController::class, 'update'] )->Middleware('auth');

//  delete listinbgs
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'] )->Middleware('auth');

//  manage listinbgs
Route::get('/listings/manage', [ListingController::class, 'manage'] )->Middleware('auth');


// single listing
Route::get('/listings/{listing}', [ListingController::class, 'show'] );

//show register create form
Route::get('/register', [UserController::class, 'create'])->Middleware('guest');


//show  login form
Route::get('/login', [UserController::class, 'login'])->name('login')->Middleware('guest');

//create new user
Route::post('/users', [UserController::class, 'store']);

//log in user
Route::post('/users/auth', [UserController::class, 'authenticate']);

//log user out
Route::post('/logout', [UserController::class, 'logout'])->Middleware('auth');


