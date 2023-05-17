<?php

use Illuminate\Support\Facades\Route;

Route::get('/queuing/ticket', 'TicketController@ticket')->name('queuing_ticket')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::get('/queuing/ticket/create', 'TicketController@create')->name('queuing_ticket_create')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::post('/queuing/ticket/save', 'TicketController@save')->name('queuing_ticket_save');
