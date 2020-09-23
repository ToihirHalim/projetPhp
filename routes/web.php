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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/acceuil', 'AcceuilController@index');

Route::get('/demandes/traite/', 'DemandesController@indexTraite');
Route::get('/demandes/nontraite/', 'DemandesController@indexNonTraite');

Route::get('/formulaire/{formulaire}/treat', 'FormulaireController@showNonTraite')->name('formulaire.treat');
Route::get('/formulaire/{formulaire}', 'FormulaireController@showTraite')->name('formulaire.show');

Route::get('/create/formular/', 'FormulaireController@show');
Route::patch('/formular/create', 'FormulaireController@create')->name('formulaire.create');
Route::patch('/formulaire/{formulaire}', 'FormulaireController@update')->name('formulaire.update');