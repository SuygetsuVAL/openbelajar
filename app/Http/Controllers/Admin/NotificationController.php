<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Services\NotificationService;
use App\Repositories\NotificationRepository;

class NotificationController extends Controller
{
    public function __construct(
        protected NotificationRepository $repository,
        protected NotificationService $service
    ) {}

    public function index()
    {
        $notifications = $this->repository->getPaginatedForUser(auth()->user());
        return view('admin.notifications.index', compact('notifications'));
    }

    public function markAsRead(Notification $notification)
    {
        if ($notification->user_id !== auth()->id()) {
            abort(403);
        }
        
        $this->service->markAsRead($notification);
        return back()->with('success', 'Notification marked as read.');
    }
}
