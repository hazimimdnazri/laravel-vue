<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    public function tasks(){
        return view('user.tasks');
    }

    public function modalTask(Request $request){
        $task = isset($request->id) ? Task::findorfail($request->id) : new Task;

        if($request->action == 'delete'){
            $task->flag = '0';

            if($task->save()){
                return [
                    'status' => 'success',
                    'message' => 'Task has been deleted.'
                ];
            }
        }

        return view('user.components.modal-task', compact('task'));
    }

    public function storeTask(Request $request){
        $task = isset($request->id) ? Task::findorfail($request->id) : new Task;
        $task->task = strtoupper($request->task);
        $task->uuid = Str::uuid();
        $task->added_by = auth()->user()->id;
        $task->status = $request->status;
        $task->remark = $request->remark;

        if($task->save()){
            return [
                'status' => 'success',
                'message' => 'Task has been saved.'
            ];
        }
    }
}
