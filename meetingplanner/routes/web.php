<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserAuth;
use App\Http\Controllers\MenageDataController;
use App\Http\Controllers\RegisterController;


Route::resource('main', ScheduleController::class);
Route::resource('admin', MenageDataController::class);
Route::resource('register', RegisterController::class);

// Route::resource('meetingplanner', Meeting_roomsController::class);
// Route::get('/meetingplanner/accessories', 'ScheduleController@accessories')->name('data');

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

route::post("meetingplanner/main/login", [UserAuth::class, 'userLogin']);
route::get('meetingplanner/main/logout', function () {
    if(session()->has('account')) {
        session()->pull('account');
        session()->pull('empno');
        session()->pull('name');
        session()->pull('department');
        session()->pull('level'); 
 
    }
    return redirect('/main');
});
