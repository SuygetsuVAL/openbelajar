@extends('layouts.admin')

@section('header', 'Messages')

@section('content')
<div class="card bg-transparent border-secondary border-opacity-10 rounded-4 shadow-sm" data-aos="fade-up" data-aos-duration="800">
    <div class="card-header bg-transparent border-bottom border-secondary border-opacity-10 p-4 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-white fw-bold">Inbox</h5>
    </div>
    
    <div class="card-body p-0">
        <div class="list-group list-group-flush rounded-bottom-4">
            @forelse($messages as $message)
                <div class="list-group-item bg-transparent border-secondary border-opacity-10 p-4 {{ !$message->is_read ? 'bg-primary bg-opacity-10 border-start border-primary border-3' : '' }}">
                    <div class="d-flex w-100 justify-content-between mb-2">
                        <h6 class="mb-1 text-white d-flex align-items-center">
                            {{ $message->name }} 
                            <span class="text-muted fw-normal ms-2 small">&lt;{{ $message->email }}&gt;</span>
                            @if(!$message->is_read)
                                <span class="badge bg-primary ms-3 rounded-pill">New</span>
                            @endif
                        </h6>
                        <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-3 text-body-secondary">{{ $message->message }}</p>
                    
                    <div class="d-flex gap-2">
                        <a href="mailto:{{ $message->email }}" class="btn btn-sm btn-outline-info rounded-pill px-3">
                            <i class="bi bi-reply me-1"></i> Reply
                        </a>
                        
                        @if(!$message->is_read)
                            <form action="{{ route('admin.messages.read', $message) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                    <i class="bi bi-check2-all me-1"></i> Mark as Read
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-envelope-open fs-1 d-block mb-3 opacity-50"></i>
                    No messages in your inbox.
                </div>
            @endforelse
        </div>
    </div>
    
    @if($messages->hasPages())
        <div class="card-footer border-top border-secondary border-opacity-10 p-4 bg-transparent d-flex justify-content-center">
            {{ $messages->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
