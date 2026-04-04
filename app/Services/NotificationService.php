<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use App\Repositories\NotificationRepository;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    public function __construct(protected NotificationRepository $repository)
    {
    }

    public function createForAdmin(string $title, string $type = 'info'): ?Notification
    {
        $admin = User::where('role', 'admin')->first();
        
        if (!$admin) {
            return null;
        }

        $notification = $this->repository->create([
            'user_id' => $admin->id,
            'title' => $title,
            'type' => $type,
        ]);

        $this->broadcastToRealtimeServer($notification);

        return $notification;
    }

    public function markAsRead(Notification $notification): bool
    {
        return $this->repository->markAsRead($notification);
    }

    protected function broadcastToRealtimeServer(Notification $notification): void
    {
        $url = env('REALTIME_SERVER_URL', 'http://localhost:3001') . '/broadcast';
        $secret = env('REALTIME_SECRET', 'portfolio-os-secret-2026');

        try {
            Http::timeout(2)->post($url, [
                'secret' => $secret,
                'event' => 'admin-notification',
                'data' => [
                    'id' => $notification->id,
                    'title' => $notification->title,
                    'type' => $notification->type,
                    'created_at' => $notification->created_at->diffForHumans()
                ]
            ]);
        } catch (\Exception $e) {
            Log::warning('Failed to broadcast notification: ' . $e->getMessage());
        }
    }
}
