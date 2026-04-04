<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(
        protected ProjectRepository $repository,
        protected ProjectService $service
    ) {}

    public function index()
    {
        $projects = $this->repository->getPaginatedAdmin();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();
        
        if (!empty($data['tech_stack'])) {
            $data['tech_stack'] = array_map('trim', explode(',', $data['tech_stack']));
        } else {
            $data['tech_stack'] = [];
        }

        $this->service->createWithSlug(auth()->user(), $data);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();

        if (array_key_exists('tech_stack', $data)) {
            $data['tech_stack'] = !empty($data['tech_stack']) 
                ? array_map('trim', explode(',', $data['tech_stack'])) 
                : [];
        }

        $this->service->updateWithImage($project, $data);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $this->repository->delete($project);
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }

    public function reorder(Request $request)
    {
        $request->validate(['orderMap' => 'required|array']);
        $this->repository->updateSortOrder($request->orderMap);
        
        return response()->json(['success' => true]);
    }
}
