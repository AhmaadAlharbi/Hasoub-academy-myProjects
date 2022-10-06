<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = auth()->user()->projects;
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data = request()->validate([
          'title'=>['required','min:3'],
          'description'=>['required','min:3']
      ]);
      $data['user_id'] = auth()->user()->id;
      Project::create($data);
        session()->flash('add','The Project has been added');

        return redirect('/projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        abort_if(auth()->user()->id != $project->user_id,403);
        return view('projects.show',compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        abort_if(auth()->user()->id != $project->user_id,403);

        return view('projects.edit',compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $data = request()->validate([
            'title' => 'sometimes|required',
            'description' => 'sometimes|required',
            'status' => 'sometimes|required',
        ]);
        $project->update($data);
        session()->flash('edit','The Project has been updated');

        return redirect('/projects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        session()->flash('delete','The Project has been deleted');

        return redirect('/projects');
    }
}
