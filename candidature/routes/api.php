<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\FormationController;

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


Route::post('login',[AuthController::class,'login']);
Route::post('logout',[AuthController::class,'logout']);
Route::post('register_candidat',[AuthController::class,'registerCandidat']);
Route::post('register_admin',[AuthController::class,'registerAdmin']);
Route::apiResource('/formation', FormationController::class);
Route::get('listeFormation', [FormationController::class,'listeFormation']);

Route::middleware(['auth:api', 'acces:candidat'])->group(function (){
    Route::post('candidature', [CandidatureController::class,'postuler']);
    
});

Route::middleware(['auth:api', 'acces:admin'])->group(function (){
  
    Route::put('accepter/{id}', [CandidatureController::class, 'Accepter']);
    Route::put('refuser/{id}', [CandidatureController::class, 'Refuser']);
    Route::get('liste', [CandidatureController::class, 'listeCandidatures']);
    Route::get('listeAcceptes', [CandidatureController::class, 'ListeAcceptes']);
    Route::get('listeRefuses', [CandidatureController::class, 'ListeRefuses']);
    
  
});