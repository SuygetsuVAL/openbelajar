<?php

namespace App\Services;

use App\Models\Message;
use App\Repositories\MessageRepository;
use App\Events\MessageReceived;

class MessageService
{
    public function __construct(protected MessageRepository $repository)
    {
    }

    public function store(array $data): Message
    {
        $message = $this->repository->create($data);
        
        event(new MessageReceived($message));
        
        return $message;
    }

    public function markAsRead(Message $message): bool
    {
        return $this->repository->markAsRead($message);
    }
}
