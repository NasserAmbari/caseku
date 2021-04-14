<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller
{
    public function loginPage(){
        return view('auth.login');
    }

    public function checkAuth(Request $request){
        $user = User::where('username','=', $request->username)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $dataSession = [
                    'userId' => $user->id,
                    'username' => $user->username,
                    'roles' => $user->role,
                    'name' => $user->name
                ];
                if($user->role == "superuser"){
                    session($dataSession);
                    return redirect()->route('superUser');
                }
                elseif($user->role == "admin"){
                    session($dataSession);
                    return redirect()->route('admin');
                }
            }
            else{
                return back()->with('fail','Login Gagal');
            }
        } else {
            return back()->with('fail','Login Gagal');
        }
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect()->route('login');
    }
}
