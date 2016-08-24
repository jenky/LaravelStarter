<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function (\Jenky\LaravelPushNotification\Contracts\PushNotification $push) {
    // $r = $push->driver('android')
    //     ->to('dXRZig7lOVA:APA91bF65_YGY7caseP_znzF6eePkACIvIhLjZFKHr6hgaY2Ym7fR4SGJAibfYLmtDyoOHkc9WYk-Whd-PXkh_dfkqg22CfD4nwysEhErd-jyubeGVTSzxjvvLUAvLKYvLCE7FSjpfsW')
    //     ->later(20, 'Test notification #'.str_random(6).' at '. (string) \Carbon\Carbon::now());

    $r = $push->driver('ios')
        ->to('7b3432a5c8bf6018fbd91c8dd99fcc45f70e9841a8597c191b8ac3fef03ac076')
        ->later(20, 'Test notification #'.str_random(6).' at '. (string) \Carbon\Carbon::now());

    // dd();
    return 1;
});

Route::get('notification', function () {
    App\User::find(1)->notify(new \App\Notifications\Test);
});