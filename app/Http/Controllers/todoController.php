<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class todoController extends Controller
{
    public function index($id) {
        $todo = Todo::with('user')->where('id', $id)->firstOrFail();

        $resources = [
            'post' => $todo,
        ];
        return view('post', $resources);
    }

    public function actions(Request $request) {
        if($request->type == 'AddPost') {
            $todo = new Todo;
            $todo->user_id = Auth()->id();
            $todo->taskName = $request->todoTaskName;
            $todo->taskDescription = $request->todoTaskDescription;
            $todo->startdate = $request->startDate;
            $todo->enddate = $request->endDate;
            $todo->done = 0;
        }
    }
}
