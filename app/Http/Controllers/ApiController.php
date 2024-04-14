<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use DataTables;
use App\Http\Resources\TasksResource;

class ApiController extends Controller
{
    public function tasks(Request $request){
        $tasks = Task::with('r_added')->where('flag', '1')->get();
        return DataTables::of(TasksResource::collection($tasks)->toArray($request))->make(true);
    }
}
