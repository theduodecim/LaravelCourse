<?php

namespace App\Http\Controllers;

use App\project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $projects = Project::where('owner_id', auth()->id())->get(); // select * from projects where owner_id = 4
        // $projects = Project::all();
        return view('projects.index', compact('projects'));

    }

    public function create()
    {

        return view('projects.create');

    }

    public function store(request $project)
    {

        $validation = request()->validate([
            'title' => ['required', 'min:4'],
            'description' => ['required', 'min:6'],
        ]);

        $validation['owner_id'] = auth()->id();
        //Project::create(['title' => request('title'), 'description' => request('description')]);
        Project::create($validation);

        return redirect('/project');

    }

//route module binding

    public function edit(Project $project) //now track the $id // this will responce to example.com/projects/1/edit

    {
        abort_if(\Gate::denies('view', $project), 403);

        return view('projects.edit', compact('project')); // and show this project id to the view
    }
/*
public function show(Project $project) // this will responce to example.com/projects/1/edit

{
return view('projects.show', compact('project'));

}
 */

//FileSystem
    // Filesystemattributes  dd($file*->get()); dd($file*->put()); dd($file*->read()); dd($file*->delete());
    //
    public function show(Project $project)
    {

        abort_if(\Gate::denies('view', $project), 403);

/*
if(\Gate::allows('view', $project))
{
abort(403);
}
 */
        // abort_if($project->owner_id !== auth()->id(), 403);
        // abort_unless($project->owner_id !== auth()->id(), 403);
        //  $this->authorize('view', $project);

        // abort_if(auth()->user()->owns($project), 403);
        //
        /*
        if($project->owner_id !== auth()->id()){
        abort(403);
        }
         */
        // $fileSystem = app('Illuminate\Filesystem\Filesystem');

        return view('projects.show', compact('project'));

    }

/*
public function show($id) // this will responce to example.com/projects/1/edit
{

$project = Project::findorfail($id);
return view('projects.show', compact('project'));

}
 */

    public function update(Project $project)
    {

        request()->validate([
            'title' => ['required', 'min:6'],
            'description' => ['required', 'min:6'],
        ]);

        $project->update(request(['title', 'description']));

        abort_if(\Gate::denies('view', $project), 403);

        return redirect('/project');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        abort_if(\Gate::denies('view', $project), 403);
        return redirect('/project');
    }

}
