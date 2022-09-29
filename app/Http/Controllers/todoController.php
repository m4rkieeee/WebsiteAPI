<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class todoController extends Controller
{
    public function index($id)
    {
        $todo = Todo::with('user')->where('id', $id)->orderBy('desc', 'id')->firstOrFail();
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

            return 'success';

        }

        if($request->type == 'editCard') {
            Todo::where('id', $request->todoID)->update([
                'taskName' => $request->taskName,
                'taskDescription' => $request->taskDescription,
                'startdate' => Carbon::parse($request->startDate),
                'enddate' => Carbon::parse($request->endDate),
            ]);
        }
        if ($request->type == 'getCardInfo') {
            return Todo::where('id', $request->todoID)->firstOrFail();
        }
    }
}
