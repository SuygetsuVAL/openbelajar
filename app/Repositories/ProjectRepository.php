<?php

namespace App\Repositories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProjectRepository
{
    public function getAllOrdered(): Collection
    {
        return Project::ordered()->get();
    }

    public function getPublishedOrdered(): Collection
    {
        return Project::published()->ordered()->get();
    }

    public function getPaginatedAdmin(int $perPage = 15): LengthAwarePaginator
    {
        return Project::ordered()->paginate($perPage);
    }

    public function findBySlug(string $slug): ?Project
    {
        return Project::where('slug', $slug)->first();
    }

    public function create(array $data): Project
    {
        return Project::create($data);
    }

    public function update(Project $project, array $data): bool
    {
        return $project->update($data);
    }

    public function delete(Project $project): bool
    {
        return $project->delete();
    }

    public function updateSortOrder(array $orderMap): void
    {
        foreach ($orderMap as $id => $order) {
            Project::where('id', $id)->update(['sort_order' => $order]);
        }
    }

    public function incrementViews(Project $project): void
    {
        $project->increment('views_count');
    }

    public function getTotalViews(): int
    {
        return Project::sum('views_count');
    }
}
