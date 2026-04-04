<?php

namespace App\Listeners;

use App\Events\MessageReceived;
use App\Services\NotificationService;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class SendAdminNotification
{
    public function __construct(protected NotificationService $notificationService)
    {
    }

    public function handle(MessageReceived $event): void
    {
        $message = $event->message;

        // 1. Create in-app notification
        $this->notificationService->createForAdmin(
            "New contact message from {$message->name}",
            'message'
        );

        // 2. Send Email
        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ContactFormMail($message));
    }
}
