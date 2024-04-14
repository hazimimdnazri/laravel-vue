<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Hash;

class GuestController extends Controller
{
    public function index() : View | RedirectResponse {
        return redirect('dashboard');
    }

    public function login(){
        return view('guest.login');
    }

    public function submitLogin(Request $request) : array {
        if(auth()->attempt($request->only('email', 'password'))){

            if(auth()->user()->isLocked){
                auth()->logout();
                return [
                    'status' => 'error',
                    'message' => 'Your account has been locked, please contact the administartor.'
                ];
            } else if(!auth()->user()->date_verified){
                auth()->logout();
                return [
                    'status' => 'error',
                    'message' => 'Your account is still inactive, please check your email for activation link.'
                ];
            } else if(auth()->user()->flag == '0'){
                auth()->logout();
                return [
                    'status' => 'error',
                    'message' => 'Your account has been removed, please contact the administrator.'
                ];
            } else {
                return [
                    'status' => 'success',
                    'message' => ''
                ];
            }
        } else {
            return [
                'status' => 'error',
                'message' => 'Invalid login credential.'
            ];
        }
    }

    public function register(){
        return view('guest.register');
    }

    public function submitRegister(Request $request){
        if(User::where('email', $request->email)->first()){
            return [
                'status' => 'error',
                'message' => 'E-mail already exist.'
            ];
        }

        if($request->password !== $request->password_confirm){
            return [
                'status' => 'error',
                'message' => 'Confirmed password is not the same as the password.'
            ];
        }

        $user = new User;
        $user->name = strtoupper($request->name);
        $user->email = strtolower($request->email);
        $user->password = Hash::make($request->password_confirm);
        $user->date_password = date('Y-m-d H:i:s');

        if($user->save()){
            return [
                'status' => 'success',
                'message' => 'User has been registered.'
            ];
        }
    }

    public function submitLogout(Request $request) : RedirectResponse {
        $request->session()->forget('location_id');
        auth()->logout();
        return redirect('guest/login');
    }
}
