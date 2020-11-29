<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index() 
    {
		$user = Auth::user();
		$tasks = Task::where('user_id', $user->id)
			->orderBy('created_at', 'DESC')
			->get()->all();

		return view('tasks.index', ['tasks' => $tasks]);
	}

	public function create()
	{
		return view('tasks.create');
	}

	public function store(Request $request)
	{
		$user = Auth::user();
		$input = $request->all();

		$task = new Task();
		$task->task = $input['task'];
		$task->iscompleted = false;
		$task->setUser($user);

		$task->save();

		return redirect()->route('home');;
	}

	public function updateCompleted(int $id)
	{
		$task = Task::find($id);
		$currentStatus = (bool) $task->iscompleted;
		$task->iscompleted = !$currentStatus;
		$task->save();

		return response()->json(['success' => true]);
	}
}
