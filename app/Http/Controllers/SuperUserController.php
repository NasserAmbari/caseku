<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperUserController extends Controller
{
    public function homePage(){
        return view('superuser.dashboard');
    }
}
