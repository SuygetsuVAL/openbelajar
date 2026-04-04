<?php

namespace App\Repositories;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class NotificationRepository
{
    public function getPaginatedForUser(User $user, int $perPage = 15): LengthAwarePaginator
    {
        return $user->notifications()->orderByDesc('created_at')->paginate($perPage);
    }

    public function create(array $data): Notification
    {
        return Notification::create($data);
    }

    public function markAsRead(Notification $notification): bool
    {
        return $notification->update(['is_read' => true]);
    }

    public function getUnreadCount(User $user): int
    {
        return $user->notifications()->where('is_read', false)->count();
    }
}
