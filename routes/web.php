<?php

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

Route::get('/', 'HomeController@index');


Route::get('/register', function() {
    return redirect('/login');    
});
Route::get('/socket_test', function() {
    return view('socket_test');    
});

// to add role 
Route::get('/admin/addrole', [App\Http\Controllers\HomeController::class, 'addRole']);
// to assign role 
Route::get('/admin/assignrole', [App\Http\Controllers\HomeController::class, 'assignRole']);
Auth::routes();
Route::group(['middleware' => ['auth']], function() {
    
    Route::get('admin/dashboard', [App\Http\Controllers\admin\DashboardController::class, 'index'])->name('admin');
    Route::resource('admin/user', App\Http\Controllers\admin\UserController::class);
    Route::get('admin/user/edit/{id}', [App\Http\Controllers\admin\UserController::class, 'edit'])->name('admin.user.edit');
    Route::post('admin/user/update', [App\Http\Controllers\admin\UserController::class, 'update'])->name('admin.user.update');
    Route::post('admin/user/destroy', [App\Http\Controllers\admin\UserController::class, 'destroy'])->name('admin.user.destroy');
    Route::post('admin/user/change_status', [App\Http\Controllers\admin\UserController::class, 'change_status'])->name('admin.user.change_status');
});
