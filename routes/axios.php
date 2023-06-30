<?php

use App\Http\Controllers\MailSendController;
use App\Http\Controllers\QuoteController;

Route::post('/minimalQuote', [QuoteController::class, 'index'])->name('axios.minimal.quote');
Route::post('/sendQuoteToEmail', [MailSendController::class, 'userQuote'])->name('axios.sendQuoteToEmail');
