<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::where('finished', false)->get();

        $data = [
            'tasks' => $tasks,
        ];

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = Task::create($request->all());

        $data = [
            'task' => $task,
        ];

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Task::where('id', $id)->update($request->all());

        return response()->json([]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::destroy($id);

        return response()->json([]);
    }

    /**
     * Finish task.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function finish($id)
    {
        Task::where('id', $id)->update(['finished' => true]);

        return response()->json([]);
    }

    /**
     * Finished tasks.
     *
     * @return \Illuminate\Http\Response
     */
    public function finishedTasks()
    {
        $finishedTasks = Task::where('finished', true)->paginate(5);

        $data = [
            'finishedTasks' => $finishedTasks,
        ];

        return response()->json($data);
    }
}
