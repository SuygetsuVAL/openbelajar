<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectCollection;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;

class ProjectApiController extends Controller
{
    public function __construct(protected ProjectRepository $repository)
    {
    }

    public function index()
    {
        return new ProjectCollection($this->repository->getPublishedOrdered());
    }

    public function show(Project $project)
    {
        if ($project->status !== 'published') {
            abort(404);
        }

        return new ProjectResource($project);
    }
}
