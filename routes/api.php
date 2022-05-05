<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use App\Models\Transaction;
use App\Models\Account;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ping', function (Request $request) {
    return [
        "nam" => "Lahat Dito Test Callback API",
        "env" => "stage",
        "ver" => "1.0.1",
        "srv" => Carbon::now()->toDateTimeString()
    ];
});

Route::post('/transaction', function (Request $request) {

    $transaction = new Transaction;
    $transaction->current_time = $request->input('current_time');
    $transaction->status = $request->input('status');
    $transaction->order_id = $request->input('order_id');
    $transaction->trx_id = $request->input('trx_id');
    $transaction->message = $request->input('message');
    $transaction->save();


    return [
        "message" => "OK"
    ];
});

Route::post('/account', function (Request $request) {

    $email = $request->input('email') ? $request->input('email') : 'no email';
    $phone = $request->input('phone') ? $request->input('phone') : 'no phone';

    $transaction = new Account;
    $transaction->internal_user_id = $request->input('internal_user_id');
    $transaction->token = $request->input('token');
    $transaction->token_id = $request->input('token_id');
    $transaction->email = $email;
    $transaction->phone = $phone;
    $transaction->save();


    return [
        "status" => "OK"
    ];
});