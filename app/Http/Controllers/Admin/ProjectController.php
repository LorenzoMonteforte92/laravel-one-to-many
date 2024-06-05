<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $projects = Project::all();
       
       $data = [

            'projects' => $projects,
       ];
       return view('admin.projects.index', $data); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|min:6|unique:projects,name', //unique si specifica il nome della tabella e della colonna
                'client_name' => 'required|min:6|',
                'image' => 'nullable|image|'
            ]
        );

        $formData = $request->all();
        //se c'è il file uploudato dall'utente 
        if($request->hasFile('image')){
            //passo il file nella cartella pubblica importando la classe Storage e salvo il path in una variabile
            $img_path = Storage::disk('public')->put('project_covers', $formData['image']);
            //rendo l'imput del form uguale al path salvato nella variabile così che funzionerà coi fillable
            $formData['image'] = $img_path;
            
        };


        $newProject = new Project();
        $newProject->fill($formData);
        $newProject->slug = Str::slug($newProject->name, '-');
        $newProject->save();

        return redirect()->route('admin.projects.show', ['project' => $newProject->slug])->with('success', 'Project: ' . $newProject->name . ' successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $data = [

            'project' => $project,

        ];

        return view('admin.projects.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate(
            [
                'name' => [
                    'required',
                    'min:6',
                    Rule::unique('projects')->ignore($project)
                ],//devo aggiungere 
                
                'client_name' => 'required|min:6|',
                'image' => 'nullable|image',
            ]
        );

        $formData = $request->all();
        //se c'è il file uploudato dall'utente 
        if($request->hasFile('image')){
            //passo il file nella cartella pubblica importando la classe Storage e salvo il path in una variabile
            $img_path = Storage::disk('public')->put('project_covers', $formData['image']);
            //rendo l'imput del form uguale al path salvato nella variabile così che funzionerà coi fillable
            $formData['image'] = $img_path;
            
        };

        
        
        $project->slug = Str::slug($formData['name'], '-');
        $project->update($formData);

        return redirect()->route('admin.projects.show', ['project' => $project->slug])->with('success', 'Project: ' . $project->name . ' successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
