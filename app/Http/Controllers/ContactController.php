<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Services\MessageService;

class ContactController extends Controller
{
    public function __construct(protected MessageService $service)
    {
    }

    public function store(StoreMessageRequest $request)
    {
        $this->service->store($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Your message has been sent successfully. I will get back to you soon!'
        ]);
    }
}
