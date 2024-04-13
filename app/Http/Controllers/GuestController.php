<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

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
        return $request;
    }

    public function submitLogout(Request $request) : RedirectResponse {
        $request->session()->forget('location_id');
        auth()->logout();
        return redirect('guest/login');
    }
}
