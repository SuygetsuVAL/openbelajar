@extends('layouts.admin')

@section('header', 'System Notifications')

@section('content')
<div class="card bg-transparent border-secondary border-opacity-10 rounded-4 shadow-sm" data-aos="fade-up" data-aos-duration="800">
    <div class="card-header bg-transparent border-bottom border-secondary border-opacity-10 p-4 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-white fw-bold">Recent Alerts</h5>
    </div>
    
    <div class="card-body p-0">
        <div class="list-group list-group-flush rounded-bottom-4" id="notificationsList">
            @forelse($notifications as $notification)
                <div class="list-group-item bg-transparent border-secondary border-opacity-10 p-4 {{ !$notification->is_read ? 'bg-info bg-opacity-10 border-start border-info border-3' : '' }}">
                    <div class="d-flex w-100 justify-content-between mb-2">
                        <h6 class="mb-1 text-white d-flex align-items-center">
                            @if($notification->type === 'message')
                                <i class="bi bi-envelope-fill text-warning me-2"></i> New Message
                            @elseif($notification->type === 'system')
                                <i class="bi bi-gear-fill text-info me-2"></i> System Alert
                            @else
                                <i class="bi bi-bell-fill text-primary me-2"></i> Notification
                            @endif
                            
                            @if(!$notification->is_read)
                                <span class="badge bg-info ms-3 rounded-pill">New</span>
                            @endif
                        </h6>
                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                    
                    <div class="mb-3 text-body-secondary ps-4">
                        @if(is_array($notification->data))
                            @if($notification->type === 'message')
                                <strong>{{ $notification->data['name'] ?? 'Someone' }}</strong> sent a message:
                                <p class="fst-italic border-start border-warning border-3 ps-3 mt-2">"{{ \Illuminate\Support\Str::limit($notification->data['message'] ?? '', 100) }}"</p>
                            @else
                                <pre class="bg-dark p-3 rounded mt-2 text-muted small mb-0">{{ json_encode($notification->data, JSON_PRETTY_PRINT) }}</pre>
                            @endif
                        @else
                            {{ config('app.name') }} alert triggered.
                        @endif
                    </div>
                    
                    <div class="d-flex gap-2 ps-4">
                        @if($notification->type === 'message')
                            <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                View Inbox
                            </a>
                        @endif
                        
                        @if(!$notification->is_read)
                            <form action="{{ route('admin.notifications.read', $notification) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                    <i class="bi bi-check2 me-1"></i> Mark as Read
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-bell-slash fs-1 d-block mb-3 opacity-50"></i>
                    No notifications to display.
                </div>
            @endforelse
        </div>
    </div>
    
    @if($notifications->hasPages())
        <div class="card-footer border-top border-secondary border-opacity-10 p-4 bg-transparent d-flex justify-content-center">
            {{ $notifications->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
