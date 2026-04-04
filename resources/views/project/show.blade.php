@extends('layouts.app')

@section('seo')
    @include('components.seo', [
        'title' => escapeshellcmd($project->title) . ' - ' . config('app.name'),
        'description' => \Illuminate\Support\Str::limit(strip_tags($project->description), 160),
        'image' => $project->thumbnail_url
    ])
@endsection

@section('content')
<section class="py-5 mt-5">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Back button -->
                <a href="{{ route('home') }}#work" class="text-decoration-none text-muted mb-4 d-inline-block hover-primary transition-all">
                    <i class="bi bi-arrow-left me-2"></i>Back to projects
                </a>

                <!-- Header -->
                <h1 class="display-3 fw-bold mb-4" data-aos="fade-up">{{ $project->title }}</h1>
                
                <div class="d-flex flex-wrap gap-4 mb-5" data-aos="fade-up" data-aos-delay="100">
                    @if(!empty($project->tech_stack))
                        <div>
                            <span class="text-muted small text-uppercase fw-bold tracking-wider d-block mb-2">Tech Stack</span>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($project->tech_stack as $tech)
                                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill py-2 px-3 border border-primary border-opacity-25">{{ $tech }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    <div>
                        <span class="text-muted small text-uppercase fw-bold tracking-wider d-block mb-2">Links</span>
                        <div class="d-flex gap-3">
                            @if($project->live_demo)
                                <a href="{{ $project->live_demo }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill px-4 shadow-sm hover-elevate transition-all">
                                    <i class="bi bi-box-arrow-up-right me-2"></i>Live Demo
                                </a>
                            @endif
                            @if($project->github_link)
                                <a href="{{ $project->github_link }}" target="_blank" class="btn btn-outline-secondary btn-sm rounded-pill px-4 shadow-sm hover-elevate transition-all">
                                    <i class="bi bi-github me-2"></i>Source Code
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Featured Image -->
                <div class="mb-5 rounded-4 overflow-hidden shadow-lg border border-secondary border-opacity-25" data-aos="zoom-in" data-aos-delay="200">
                    <img src="{{ $project->thumbnail_url }}" alt="{{ $project->title }}" class="w-100 h-auto">
                </div>

                <!-- Description -->
                <div class="content-body fs-5 text-body-secondary lh-lg" data-aos="fade-up" data-aos-delay="300">
                    {!! nl2br(e($project->description)) !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
