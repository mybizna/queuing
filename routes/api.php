<?php

use Illuminate\Support\Facades\Route;
use Modules\Queuing\Http\Controllers\TicketController;

Route::get('/queuing/ticket', [TicketController::class, 'ticket'])->name('queuing_ticket_api')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
