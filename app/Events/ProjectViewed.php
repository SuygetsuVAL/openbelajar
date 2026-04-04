<?php

namespace App\Events;

use App\Models\Project;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProjectViewed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Project $project, public string $ip)
    {
    }
}
