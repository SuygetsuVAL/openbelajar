@extends('layouts.admin')

@section('header', 'Edit Project: ' . $project->title)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card bg-transparent border-secondary border-opacity-10 rounded-4 shadow-sm" data-aos="fade-up" data-aos-duration="800">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="title" class="form-label text-muted small fw-semibold text-uppercase tracking-wider">Project Title</label>
                        <input type="text" name="title" id="title" class="form-control bg-darker border-secondary border-opacity-50 text-white @error('title') is-invalid @enderror" value="{{ old('title', $project->title) }}" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="description" class="form-label text-muted small fw-semibold text-uppercase tracking-wider">Description</label>
                        <textarea name="description" id="description" rows="5" class="form-control bg-darker border-secondary border-opacity-50 text-white @error('description') is-invalid @enderror">{{ old('description', $project->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="github_link" class="form-label text-muted small fw-semibold text-uppercase tracking-wider">GitHub Link</label>
                            <input type="url" name="github_link" id="github_link" class="form-control bg-darker border-secondary border-opacity-50 text-white @error('github_link') is-invalid @enderror" value="{{ old('github_link', $project->github_link) }}">
                            @error('github_link') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mt-4 mt-md-0">
                            <label for="live_demo" class="form-label text-muted small fw-semibold text-uppercase tracking-wider">Live Demo URL</label>
                            <input type="url" name="live_demo" id="live_demo" class="form-control bg-darker border-secondary border-opacity-50 text-white @error('live_demo') is-invalid @enderror" value="{{ old('live_demo', $project->live_demo) }}">
                            @error('live_demo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="tech_stack" class="form-label text-muted small fw-semibold text-uppercase tracking-wider">Tech Stack (comma separated)</label>
                        <input type="text" name="tech_stack" id="tech_stack" class="form-control bg-darker border-secondary border-opacity-50 text-white @error('tech_stack') is-invalid @enderror" value="{{ old('tech_stack', implode(', ', (array) $project->tech_stack)) }}">
                        @error('tech_stack') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label for="thumbnail" class="form-label text-muted small fw-semibold text-uppercase tracking-wider">Thumbnail Image (Leave blank to keep current)</label>
                            <input type="file" name="thumbnail" id="thumbnail" class="form-control bg-darker border-secondary border-opacity-50 text-white @error('thumbnail') is-invalid @enderror" accept="image/*">
                            @error('thumbnail') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            
                            @if($project->thumbnail)
                                <div class="mt-3">
                                    <p class="text-muted small mb-1">Current Thumbnail:</p>
                                    <img src="{{ $project->thumbnail_url }}" alt="Current thumbnail" class="img-thumbnail bg-transparent border-secondary border-opacity-10 mt-2" width="150" style="border-radius: 8px;">
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6 mt-4 mt-md-0">
                            <label for="status" class="form-label text-muted small fw-semibold text-uppercase tracking-wider">Status</label>
                            <select name="status" id="status" class="form-select bg-darker border-secondary border-opacity-50 text-white @error('status') is-invalid @enderror">
                                <option value="draft" {{ old('status', $project->status) === 'draft' ? 'selected' : '' }}>Draft (Hidden)</option>
                                <option value="published" {{ old('status', $project->status) === 'published' ? 'selected' : '' }}>Published (Public)</option>
                            </select>
                            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end gap-3 pt-4 mt-2 border-top border-secondary border-opacity-10">
                        <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary rounded-pill px-5 shadow-sm">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
