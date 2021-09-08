<?php

use App\Http\Livewire\AllHouseholds;
use App\Http\Livewire\AllTenants;
use App\Http\Livewire\Documents;
use App\Http\Livewire\Home;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Properties;
use App\Http\Livewire\Unverified;
use App\Http\Livewire\ViewProperty;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['verify' => true]);


Route::middleware('auth')->group(function () {
    Route::get('/', Home::class)->name('home');
    Route::get('/tenant/all', AllTenants::class)->name('tetants.all');
    Route::get('/household/all', AllHouseholds::class)->name('households.all');
    Route::get('/unverified/all', Unverified::class)->name('unverified.all');
    Route::get('/profile/{id}', Profile::class)->name('profile');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/properties', Properties::class)->name('properties');
    Route::get('/property/{id}', ViewProperty::class)->name('property');
});

ROute::get('/test', function() {
    $tab = "(G)Raat Dherai (D)Paryo Dherai (Cadd9)Dherai
            (G)Maayaaka Kura Nagara Na (Cadd9)Aye
            
            (G)Raat Dherai (hello)Paryo Dherai (Cadd9)Dherai
            (G)Maayaaka Kura Nagara Na (Cadd9)Aye";
    $output = preg_replace('/(\n)/s','<div class="br"></div>', $tab);
    $output = preg_replace('/\((.*?)\)/',"<div class='chord'>$1</div>", $output);
    return view('chord',compact('output'));
});