<?php

namespace App\Repositories;

use App\Models\Message;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class MessageRepository
{
    public function getPaginatedAdmin(int $perPage = 15): LengthAwarePaginator
    {
        return Message::orderByDesc('created_at')->paginate($perPage);
    }

    public function create(array $data): Message
    {
        return Message::create($data);
    }

    public function markAsRead(Message $message): bool
    {
        return $message->update(['is_read' => true]);
    }

    public function getUnreadCount(): int
    {
        return Message::where('is_read', false)->count();
    }
}
