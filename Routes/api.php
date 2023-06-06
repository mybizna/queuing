<?php

use Illuminate\Support\Facades\Route;


Route::get('/queuing/ticket', 'TicketController@ticket')->name('queuing_ticket_api')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

