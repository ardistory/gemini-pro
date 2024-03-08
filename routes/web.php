<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->redirectTo('/gemini-pro');
});

Route::get('/eloquent', function () {
    return response()->view('eloquent');
});

Route::get('/gemini-pro', function () {
    return response()->view('gemini-pro');
});

Route::get('/telegram-webhook', function () {
    return response()->json(['message' => 'welcome!']);
});

Route::post('/telegram-webhook', function (Request $request) {
    if ($request->header('X-Telegram-Bot-Api-Secret-Token') == 'berserk') {

        $file = fopen(storage_path('app/public/Request.json'), 'w');
        fwrite($file, json_encode($request->all(), JSON_PRETTY_PRINT));
        fclose($file);

        return response()->json($request->all());
    } else {
        return response(['ok' => false], 404);
    }
});
