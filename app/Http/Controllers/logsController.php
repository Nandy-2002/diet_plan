<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\log;

class logsController extends Controller
{
    public function index(){
        $logs = log::orderBy('created_at', 'desc')->get();
        return view('admin.logs.index',compact('logs'));
    }
}
