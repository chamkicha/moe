<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogController extends Controller
{
    public function viewLog()
    {
        $logPath = storage_path('logs/laravel.log'); 
        $logContent = file_get_contents($logPath);

        return view('log', ['logContent' => $logContent]);
    }
}
