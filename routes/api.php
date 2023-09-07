<?php

use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\WelcomeRiderMailNotification;
use App\Notifications\WelcomeUserMailNotification;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/welcome/user/{id}', function ($id) {

    $user = User::find($id);      // จริงๆต้องเช็คว่าเป็น user ที่ login อยู่จริงๆ
    // $user = auth()->user();
    $user->notify(new WelcomeUserMailNotification());

    return response()->json(['message' => 'Welcome user email notification sent.']);
});

Route::get('/welcome/rider/{id}', function ($id) {

    $user = User::find($id);          // จริงๆต้องเช็คว่าเป็น rider ที่ login อยู่จริงๆ
    // $user = auth()->user();
    $user->notify(new WelcomeRiderMailNotification());

    return response()->json(['message' => 'Welcome rider email notification sent.']);
});

Route::get('/reset-password/{id}', function ($id) {

    $user = User::find($id);          // จริงๆต้องเช็คว่าเป็น เมลหรือชื่อนั้น ที่ขอ reset password อยู่จริงๆ
    // $user = auth()->user();
    $user->notify(new ResetPasswordNotification());

    return response()->json(['message' => 'Reset password email notification sent.']);
});