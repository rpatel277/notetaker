<?php

use App\Http\Controllers\NotesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/notes', [NotesController::class, 'index']); // Retrieves all notes
Route::get('/notes/{id}', [NotesController::class, 'show']); // Retrieves a single note by its ID
Route::post('/notes', [NotesController::class, 'store']); // Creates a new note
Route::put('/notes/{id}', [NotesController::class, 'update']); // Updates an existing note
Route::delete('/notes/{id}', [NotesController::class, 'delete']); // Deletes a note
