<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function tasks(){
        return view('user.tasks');
    }

    public function modalTask(Request $request){
        return view('user.components.modal-task');
    }
}
