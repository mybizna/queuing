<?php

use Illuminate\Support\Facades\Route;
use Modules\Queuing\Http\Controllers\TicketController;


Route::get('/queuing/ticket', [TicketController::class,'@ticket'])->name('queuing_ticket')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::get('/queuing/ticket/create', [TicketController::class,'create'])->name('queuing_ticket_create')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::get('/queuing/ticket/fetch', [TicketController::class,'ticket_fetch'])->name('queuing_ticket_fetch')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::match (['get', 'post'], '/queuing/ticket/save', [TicketController::class,'save'])->name('queuing_ticket_save');
Route::match (['get', 'post'], '/queuing/ticket/move', [TicketController::class,'move'])->name('queuing_ticket_move');
Route::post('/queuing/ticket/savemove', [TicketController::class,'savemove'])->name('queuing_ticket_savemove');
