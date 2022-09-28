<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;

class todoController extends Controller
{
    public function index($id)
    {
        $todo = Todo::with('user')->where('id', $id)->firstOrFail();
        $user = User::find($todo->user_id)->name;
        $resources = [
            'post' => $todo,
            'user' => $user,
        ];
        return view('post', $resources, $user);
    }

    public function actions(Request $request)
    {
        if ($request->type == 'addPost') {
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

        if ($request->type == 'finishTodo') {
            Todo::where('id', $request->todoID)->update([
                'done' => 1
            ]);

            return 'success';
        }

        if ($request->type == 'deleteCard') {
            $todo = Todo::where('id', $request->todoID);
            $todo->delete();
        }
        return 'success';
    }
}
