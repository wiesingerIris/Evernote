<?php

use Illuminate\Support\Facades\Route;
use App\Models\Register;
use App\Models\Task;
use App\Models\Note;



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
/*
Route::get('/', [\App\Http\Controllers\RegisterController::class, "index"]);
Route::get('/registers/{id}', [\App\Http\Controllers\RegisterController::class, "findRegister"]);
Route::get('/registers', [\App\Http\Controllers\RegisterController::class, "shareList"]);

/*Route::get('/registers/{id}', function ($id) {
    $register = Register::findOrFail($id);
    $users = $register->users()->get();
    $notes = Note::whereIn('id', [1, 2])->get(); // Notizen mit den IDs 1 und 2
    return view('registers.show', compact('register', 'users', 'notes'));
});

Route::get('/registers/notes/{id}', function ($id) {
    $note = Note::findOrFail($id);
    $tasks = $note->tasks()->get();
    return view('notes.show', compact('note','tasks'));
});
*/
