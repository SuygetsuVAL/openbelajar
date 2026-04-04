<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Repositories\ProjectRepository;
use App\Services\AnalyticsService;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function __construct(
        protected ProjectRepository $repository,
        protected AnalyticsService $analytics
    ) {}

    public function home(Request $request)
    {
        $projects = $this->repository->getPublishedOrdered();
        
        $this->analytics->trackVisit($request, 'home');

        return view('home', compact('projects'));
    }

    public function show(Request $request, Project $project)
    {
        if ($project->status !== 'published') {
            abort(404);
        }

        $this->analytics->trackVisit($request, 'project/' . $project->slug, $project);

        return view('project.show', compact('project'));
    }
}
