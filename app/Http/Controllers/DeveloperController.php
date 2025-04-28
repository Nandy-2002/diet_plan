<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function index()
    {
        $trashedUsers = User::onlyTrashed()->get();
        return view('admin.developer_control.index', compact('trashedUsers'));
    }
}