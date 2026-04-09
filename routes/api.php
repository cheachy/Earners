<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmsWebhookController;

Route::post('/sms/incoming', [SmsWebhookController::class, 'handle']);