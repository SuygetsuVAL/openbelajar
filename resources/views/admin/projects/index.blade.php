@extends('layouts.admin')

@section('header', 'Manage Projects')

@section('content')
<div class="card bg-transparent border-secondary border-opacity-10 rounded-4 shadow-sm mb-4" data-aos="fade-up" data-aos-duration="800">
    <div class="card-header bg-transparent border-bottom border-secondary border-opacity-10 p-4 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-white fw-bold">All Projects</h5>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="bi bi-plus-lg me-2"></i> New Project
        </a>
    </div>
    
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-borderless table-hover mb-0 align-middle text-body">
                <thead class="border-bottom border-secondary border-opacity-10 text-muted">
                    <tr>
                        <th class="py-3 px-4 fw-medium" style="width: 50px;"></th>
                        <th class="py-3 px-4 fw-medium">Project</th>
                        <th class="py-3 px-4 fw-medium">Status</th>
                        <th class="py-3 px-4 fw-medium">Views</th>
                        <th class="py-3 px-4 text-end fw-medium">Actions</th>
                    </tr>
                </thead>
                <tbody id="projectsSortable" data-url="{{ route('admin.projects.reorder') }}">
                    @forelse($projects as $project)
                        <tr data-id="{{ $project->id }}">
                            <td class="px-4 text-muted" style="cursor: move;">
                                <i class="bi bi-list fs-5 drag-handle"></i>
                            </td>
                            <td class="px-4">
                                <div class="d-flex align-items-center">
                                    <img src="{{ $project->thumbnail_url }}" alt="{{ $project->title }}" class="rounded me-3 object-fit-cover" width="60" height="40">
                                    <div>
                                        <h6 class="mb-0 text-white fw-semibold">{{ $project->title }}</h6>
                                        <small class="text-muted">{{ count($project->tech_stack ?? []) }} tech used</small>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4">
                                @if($project->status === 'published')
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3 py-1">Published</span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 rounded-pill px-3 py-1">Draft</span>
                                @endif
                            </td>
                            <td class="px-4">
                                <span class="text-muted"><i class="bi bi-eye me-1"></i> {{ number_format($project->views_count) }}</span>
                            </td>
                            <td class="px-4 text-end">
                                <div class="btn-group gap-2">
                                    <a href="{{ route('project.show', $project->slug) }}" target="_blank" class="btn btn-sm btn-outline-info rounded px-3" title="View">
                                        <i class="bi bi-box-arrow-up-right"></i>
                                    </a>
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-outline-primary rounded px-3" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this project?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger rounded px-3" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-3 opacity-50"></i>
                                No projects found. Click "New Project" to add your first one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    @if($projects->hasPages())
        <div class="card-footer border-top border-secondary border-opacity-10 p-4 bg-transparent d-flex justify-content-center">
            {{ $projects->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
