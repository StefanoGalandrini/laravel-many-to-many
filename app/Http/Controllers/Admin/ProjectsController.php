<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{

    private $validations =  [
        'title'          => 'required|string|min:5|max:100',
        'type_id'        => 'required|integer|exists:types,id',
        'url_image'      => 'required|url|max:200',
        'description'    => 'required|string',
        'creation_date'  => 'required|date',
        'url_repo'       => 'required|url|max:200',
        'technologies'   => 'nullable|array',
        'technologies.*' => 'integer|exists:technologies,id',
    ];

    private $validation_messages = [
        'required'   => ':attribute is a required field',
        'exists'     => ':attribute is out of range',
        'min'        => ':attribute must be at least :min characters long',
        'max'        => ':attribute must be less than :max characters long',
        'url'        => ':attribute must be a valid URL address',
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(3);
        return view('admin.projects.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types          = Type::all();
        $technologies   = Technology::all();
        return view('admin.projects.create', ['types' => $types, 'technologies' => $technologies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate Data
        $request->validate($this->validations, $this->validation_messages);


        $data = $request->all();

        // Save Data
        $newProject = new Project();

        $newProject->title          = $data['title'];
        $newProject->slug           = Project::slugger($data['title']);
        $newProject->type_id        = $data['type_id'];
        $newProject->url_image      = $data['url_image'];
        $newProject->description    = $data['description'];
        $newProject->creation_date  = $data['creation_date'];
        $newProject->url_repo       = $data['url_repo'];

        $newProject->save();

        $newProject->technologies()->sync($data['technologies'] ?? []);

        return redirect()->route('admin.projects.show', ['project' => $newProject])->with('create_success', $newProject);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        return view('admin.projects.show', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        $types          = Type::all();
        $technologies   = Technology::all();
        return view('admin.projects.edit', ['project' => $project, 'types' => $types, 'technologies' => $technologies]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        // Validate Data
        $request->validate($this->validations, $this->validation_messages);

        $data = $request->all();

        // Update Data
        $updated = $project->update([
            'title'         => $data['title'],
            'type_id'       => $data['type_id'],
            'url_image'     => $data['url_image'],
            'description'   => $data['description'],
            'creation_date' => $data['creation_date'],
            'url_repo'      => $data['url_repo']
        ]);

        $project->technologies()->sync($data['technologies'] ?? []);

        return redirect()->route('admin.projects.show', ['project' => $project])->with('update_success', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */

    public function destroy($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();

        // Soft Delete project
        $project->delete();

        return redirect()->route('admin.projects.index')->with('delete_success', $project);
    }

    public function restore($slug)
    {
        $project = Project::withTrashed()->where('slug', $slug)->firstOrFail();
        $project->restore();

        return redirect()->route('admin.projects.trashed')->with('restore_success', $project);
    }

    public function trashed()
    {
        $projects = Project::onlyTrashed()->paginate(3);
        return view('admin.projects.trashed', ['projects' => $projects]);
    }

    public function forcedelete($slug)
    {
        $project = Project::withTrashed()->where('slug', $slug)->firstOrFail();

        // Detach tecnologies from project
        $project->technologies()->detach();

        // Force delete project
        $project->forceDelete();

        return redirect()->route('admin.projects.trashed')->with('delete_success', $project);
    }
}
