<?php
use App\Models\User;
use App\Models\Image;
use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;

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

Route::post('users', [UserController::class,'save']);
Route::delete('users/{id}', [UserController::class,'delete']);
Route::get('registers', [RegisterController::class, 'index']);
Route::get('registers/{id}', [RegisterController::class, 'show']);
Route::post('registers', [RegisterController::class,'save']);
Route::delete('registers/{id}', [RegisterController::class,'delete']);
Route::put('registers/{id}', [RegisterController::class,'update']);

Route::post('tags', [TagController::class,'store']);

Route::post('registers/{id}/notes', [NoteController::class,'save']);
Route::put('registers/{register_id}/notes/{note_id}', [NoteController::class,'update']);
Route::get('registers/{id}/notes', [NoteController::class,'index']);
Route::get('registers/{register_id}/notes/{note_id}', [NoteController::class, 'show']);
Route::delete('registers/{register_id}/notes/{note_id}', [NoteController::class, 'delete']);


Route::get('tasks', [TaskController::class, 'index']);
Route::get('tasks/{id}', [TaskController::class, 'show']);
Route::post('tasks', [TaskController::class, 'save']);
Route::put('tasks/{id}', [TaskController::class, 'update']);
Route::delete('tasks/{id}', [TaskController::class, 'delete']);

/* auth */
Route::post('auth/login', [AuthController::class,'login']);
Route::group(['middleware' => ['api','auth.jwt']], function(){
    Route::post('registers', [RegisterController::class,'save']);
    Route::put('registers/{id}', [RegisterController::class,'update']);
    Route::delete('registers/{id}', [RegisterController::class,'delete']);
    Route::post('auth/logout', [AuthController::class,'logout']);
});

Route::group(['middleware'=>['api','auth.jwt','auth.admin']],function(){
Route::post('registers', [RegisterController::class,'save']);
Route::put('registers/{id}',
    [RegisterController::class,'update']);
Route::delete('registers/{id}',
    [RegisterController::class,'delete']);
Route::post('auth/logout',
    [AuthController::class,'logout']);
});

