<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function ListUser(Request $request){
        if(isset($request->searching)){
            $searching = $request->searching;
            $field = ['name','username','role'];

            $result = User::where(function($query) use($searching,$field){
                for ($i = 0; $i < count($field); $i++){
                    $query->orwhere($field[$i], 'like',  '%' . $searching .'%');
                } 
            })->sortable()->paginate(5);            
            return view('superuser.user.listuser',['users' => $result,'searching' => $searching]);
        }
        
        $users = User::sortable()->paginate(5);
        return view('superuser.user.listuser',['users' => $users]);
    }

    public function StoreUserData(Request $request){
        try {
            DB::beginTransaction();
            $result = DB::table('users')->insert([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'name' => $request->name,
                'role' => $request->role,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(), 
            ]);
            DB::commit();
            if($result){
                toastr()->success('New User : '.$request->username.'has been added');
                return redirect()->back();
            }
        } catch (\Exception $ex) {
            DB::rollback();
            $data=[
                'status'=>500,
                'message'=>'Cannot Store Data',
                'case_type'=>$ex,
            ];
            toastr()->error('Error : '.$request->username.' '.$ex);
            return redirect()->back();
        }
    }

    public function GetEditUserData(Request $request){
        $result = DB::table('users')->where('id',$request->id)->first();
        $data = [
            'id' => $result->id,
            'username' => $result->username,
            'name' => $result->name,
            'role'=> $result->role,
        ];
        return response()->json($data);
    }

    public function UpdateUserData(Request $request){  
        try {
            
            DB::beginTransaction();
            
            if(isset($request->password)){
                $data_update = [
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'name' => $request->name,
                    'role' => $request->role,
                    'updated_at' => \Carbon\Carbon::now(), 
                ];
            } else {
                $data_update = [
                    'username' => $request->username,
                    'name' => $request->name,
                    'role' => $request->role,
                    'updated_at' => \Carbon\Carbon::now(), 
                ];
            }

            $result = DB::table('users')
                ->where('id',$request->id)
                ->update($data_update);

            DB::commit();

            if($result){
                toastr()->success('User : '.$request->username.' has been updated');
                return redirect()->back();
            }
            else{
                toastr()->error('cannot update data');
                return redirect()->back();
            }
        } catch (\Exception $ex) {
            toastr()->error('Error : '.$ex);
            return redirect()->back();
        }
    }

    public function DeleteUserData(Request $request){
        try {
            DB::beginTransaction();

            $result = DB::table('users')
                ->where('id',$request->id)
                ->delete();

            DB::commit();

            if($result){
                toastr()->success('Delete Success');
                return redirect()->back();
            }
            else{
                toastr()->error('Cannot delete data');
                return redirect()->back();
            }
        } catch (\Exception $ex) {
            toastr()->error('Error : '.$ex);
            return redirect()->back();
        }
    }
}
