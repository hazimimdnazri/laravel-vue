<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class UserController extends Controller
{
    public function dashboard(){
        return view('user.dashboard');
    }

    public function modalPassword(Request $request){
        return view('user.components.modal-password');
    }

    public function changePassword(Request $request){
        $user = User::findorfail(auth()->user()->id);
    
        if(Hash::check($request->password, $user->password)){
            if(preg_match_all("/^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[\!@#$%^&+=]).*$/", $request->password_new)){
                if($request->password_new == $request->password_confirm){
                    $user->password = Hash::make($request->password_confirm);
                    $user->date_password = date('Y-m-d H:i:s');
                    if($user->save()){
                        return [
                            'message' => 'New password has been set, please relogin.',
                            'status' => 'success'
                        ];
                    }
                } else {
                    return [
                        'message' => 'Your confirmed password is not the same as your new password. ',
                        'status' => 'error'
                    ];
                }
            } else {
                return [
                    'message' => 'Please ensure that your password contains at least 8 characters, consisting of small letters, capital letters, numbers and symbol.',
                    'status' => 'error'
                ];
            }
        } else {
            return [
                'message' => 'Your password is wrong.',
                'status' => 'error'
            ];
        }
    }
}
