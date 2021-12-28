<?php

use App\Http\Controllers\ScientistController;
use Doctrine\ORM\EntityManager;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sci', [ScientistController::class, 'index']);

// Route::get('/', function (EntityManager $em) {
//     dd($em);
// });
