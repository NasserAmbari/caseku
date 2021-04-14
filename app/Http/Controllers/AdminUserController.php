<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function homePage(){
        return view('admin.dashboard');
    }
}
