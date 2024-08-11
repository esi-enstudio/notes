<?php

use App\Http\Controllers\Auth\LoginUserController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\NoteCompleteController;
use App\Http\Controllers\NoteCompleteProcessController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\NoteRestoreController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function (){
    Route::view('/','notes')->name('notes');
    Route::post('/logout', [LoginUserController::class, 'destroy'])->name('logout');

    Route::post('/notes/delete-all', [NoteController::class, 'deleteAll'])->name('notes.delete.all');
    Route::post('/notes/complete/{note}', [NoteCompleteController::class, 'complete'])->name('notes.complete');

    Route::resources([
        '/notes' => NoteController::class,
        '/complete' => NoteCompleteController::class,
    ]);

    Route::get('/notes/restore/{note}', NoteRestoreController::class)->name('notes.restore');
});

Route::middleware('guest')->group(function (){
    // Login
    Route::controller(LoginUserController::class)->group(function (){
        Route::get('/login','index')->name('login');
        Route::post('/login','store')->name('login.store');
    });

    // Register
    Route::controller(RegisterUserController::class)->group(function (){
        Route::get('/register','index')->name('register');
        Route::post('/register','store')->name('register.store');
    });
});
