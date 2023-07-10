<?php

use App\Http\Controllers\ScientistController;
use Doctrine\ORM\EntityManager;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/sci'               , [ScientistController::class, 'index']);
Route::get('/sciIndex'          , [ScientistController::class, 'scientistIndex']);
Route::get('/sciIndex/{page}'   , [ScientistController::class, 'scientistIndex']);

Route::get('/login'             , [ScientistController::class, 'login']);
Route::post('/login'            , [ScientistController::class, 'login']);

Route::get('/sci-new'           , [ScientistController::class, 'scientistNew']);
Route::get('/sci-new/{id}'      , [ScientistController::class, 'scientistNew']);
Route::post('/sci-new'          , [ScientistController::class, 'scientistNew']);
Route::get('/sci-delete/{id}'   , [ScientistController::class, 'delete']);

Route::get('/deleteuser/{id}', [AdminController::class, 'deleteuser']);
Route::get('/dashboard' , function() {
    return Inertia::render('Dashboard');
});

// Route::get('/sci', function () {
//     return Inertia::render('Scientist');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
