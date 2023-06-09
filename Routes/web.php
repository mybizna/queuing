<?php

use Illuminate\Support\Facades\Route;

Route::get('/queuing/ticket', 'TicketController@ticket')->name('queuing_ticket')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::get('/queuing/ticket/create', 'TicketController@create')->name('queuing_ticket_create')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::get('/queuing/ticket/fetch', 'TicketController@ticket_fetch')->name('queuing_ticket_fetch')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::match (['get', 'post'], '/queuing/ticket/save', 'TicketController@save')->name('queuing_ticket_save');
Route::match (['get', 'post'], '/queuing/ticket/move', 'TicketController@move')->name('queuing_ticket_move');
Route::post('/queuing/ticket/savemove', 'TicketController@savemove')->name('queuing_ticket_savemove');
