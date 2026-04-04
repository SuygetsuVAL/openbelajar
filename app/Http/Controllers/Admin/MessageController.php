<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Repositories\MessageRepository;
use App\Services\MessageService;

class MessageController extends Controller
{
    public function __construct(
        protected MessageRepository $repository,
        protected MessageService $service
    ) {}

    public function index()
    {
        $messages = $this->repository->getPaginatedAdmin();
        return view('admin.messages.index', compact('messages'));
    }

    public function markAsRead(Message $message)
    {
        $this->service->markAsRead($message);
        return back()->with('success', 'Message marked as read.');
    }
}
