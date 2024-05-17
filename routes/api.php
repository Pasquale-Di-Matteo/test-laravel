<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/breweries', function () {
    // Recupero il token dall'utente autenticato
    $token = Crypt::decryptString(Cookie::get("token"));
    // Effettuo una richiesta HTTP GET 
    $response = Http::withOptions(['verify' => false])->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->get('https://api.openbrewerydb.org/v1/breweries');
    // Gestisco la risposta come desiderato
    return $response->json();
})->name('breweries.index');
