<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'thumbnail' => $this->thumbnail_url,
            'github_link' => $this->github_link,
            'live_demo' => $this->live_demo,
            'tech_stack' => $this->tech_stack,
            'views' => $this->views_count,
            'created_at' => $this->created_at->toISOString(),
        ];
    }
}
