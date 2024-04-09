<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AlarmController extends Controller
{
    public function getAlarm(): JsonResponse
    {
        return response()->json([
            'Author' => 'ArdiPutra',
            'Github' => 'https://github.com/ardistory'
        ]);
    }

    public function postAlarm(Request $request)
    {
        $requestAll = $request->all();

        Log::info(json_encode($requestAll, JSON_PRETTY_PRINT));
    }
}
