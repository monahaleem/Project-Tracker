<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Task;
use auth;

class ProjectController extends Controller
{

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       
        $projects =Project::latest()->paginate(5);
        return view('project.index',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user=auth()->user();
        if($request->ajax()){
            $project= new Project;
                $project->project_name = $request->project_name;
                $project->project_description = $request->project_description;
                $project->user_id=$user->id;
                $project->user_name=$user->name;
                $project->save();
            
           
    
            return response([
                'data'      => $project,
                'message'   => 'Projects Added Successfully!'
            ]);
                
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        
        if (request()->ajax()) {
            $project = Project::find($id);
                return response([
                    'data' => $project,
                    'message' => 'Project edit success'
                ]);
                    
            }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        if ($request->ajax()) {
            $project = Project::find($id);
            if (!$project) {
                return response([
                    'data' => '',
                    'message' => 'error'
                ]);
            }
            $project->project_name = $request->project_name;
            $project->project_description = $request->Project_description;
        
            $project->save();
         
            return response([
                'data' => $project,
                'message' => 'Project Updated Successfully!'
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->ajax()) {
            $project  = Project::find($id);
            $id     = $project->id;
            if ($project) {
                $project->delete();

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

