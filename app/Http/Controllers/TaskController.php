<?php

namespace App\Http\Controllers;

use App\Task;
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
        //
        $tasks =Task::latest()->paginate(5);
        return view('task.index',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //
        if($request->ajax()){
            $tasks = Task::create($request->all());
           
    
            return response([
                'data'      => $tasks,
                'message'   => 'Projects Added Successfully!'
            ]);
                
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
        //
        
        if (request()->ajax()) {
            $task = Task::find($id);
                return response([
                    'data' => $task,
                    'message' => 'Task edit success'
                ]);
                    
            }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
        
        if ($request->ajax()) {
            $task = Task::find($id);
            if (!$task) {
                return response([
                    'data' => '',
                    'message' => 'error'
                ]);
            }
            $task->task_name = $request->task_name;
            $task->task_description = $request->task_description;
            $project->save();
         
            return response([
                'data' => $task,
                'message' => 'Project Updated Successfully!'
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->ajax()) {
            $task  = Task::find($id);
            $id     = $task->id;
            if ($task) {
                $task->delete();

                return response([
                    'data'    => $id,
                    'message' => 'success'
                ]);
            }

            return response([
                'data'      => '',
                'message'   => 'error'
            ]);
        }
    }
}
