<?php

namespace App\Services;

use App\Models\Project;
use App\Models\User;
use App\Repositories\ProjectRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProjectService
{
    public function __construct(protected ProjectRepository $repository)
    {
    }

    public function createWithSlug(User $user, array $data): Project
    {
        $data['user_id'] = $user->id;
        $data['slug'] = $this->generateUniqueSlug($data['title']);

        if (isset($data['thumbnail']) && $data['thumbnail'] instanceof UploadedFile) {
            $data['thumbnail'] = $this->uploadThumbnail($data['thumbnail']);
        }

        return $this->repository->create($data);
    }

    public function updateWithImage(Project $project, array $data): bool
    {
        if (isset($data['title']) && $data['title'] !== $project->title) {
            $data['slug'] = $this->generateUniqueSlug($data['title'], $project->id);
        }

        if (isset($data['thumbnail']) && $data['thumbnail'] instanceof UploadedFile) {
            if ($project->thumbnail && Storage::disk('public')->exists($project->thumbnail)) {
                Storage::disk('public')->delete($project->thumbnail);
            }
            $data['thumbnail'] = $this->uploadThumbnail($data['thumbnail']);
        }

        return $this->repository->update($project, $data);
    }

    protected function uploadThumbnail(UploadedFile $file): string
    {
        $filename = Str::random(40) . '.webp';
        $path = 'projects/' . $filename;
        
        $image = Image::read($file)->toWebp(80);
        
        Storage::disk('public')->put($path, $image->toString());
        
        return $path;
    }

    protected function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        $query = Project::where('slug', $slug);
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        while ($query->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $query = Project::where('slug', $slug);
            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }
            $counter++;
        }

        return $slug;
    }
}
