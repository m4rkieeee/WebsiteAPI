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
        if($request->type == 'addPost') {
            $todo = new Todo;
            $todo->user_id = Auth()->id();
            $todo->taskName = $request->taskName;
            $todo->taskDescription = $request->taskDescription;
            $todo->startdate = $request->startDate;
            $todo->enddate = $request->endDate;
            $todo->done = 0;
            $todo->save();

            return $todo;

            return 'success';
        }
    }
}
