<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|max:2048',
            'github_link' => 'nullable|url|max:255',
            'live_demo' => 'nullable|url|max:255',
            'tech_stack' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'sort_order' => 'integer|min:0',
        ];
    }
}
