<?php

use App\Http\Controllers\FormController;
use App\Models\Users;
use Illuminate\Support\Facades\Route;

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


Route::post('/store', [FormController::class, 'storeOrUpdate'])->name('store');
Route::delete('/delete-record', [FormController::class, 'deleteRecord'])->name('deleteRecord');

Route::get('/users_page', function () {
    $users = Users::all();
 
    return view('user_page', [
        'users' => $users
    ]);
});
