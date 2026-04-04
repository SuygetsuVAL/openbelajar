<?php

namespace App\Services;

use App\Repositories\AnalyticsRepository;
use Illuminate\Http\Request;
use App\Models\Project;

class AnalyticsService
{
    public function __construct(protected AnalyticsRepository $repository)
    {
    }

    public function trackVisit(Request $request, string $page, ?Project $project = null): void
    {
        $userAgent = $request->header('User-Agent');
        
        $this->repository->create([
            'project_id' => $project?->id,
            'page' => $page,
            'user_ip' => $request->ip(),
            'device' => $this->detectDevice($userAgent),
            'browser' => $this->detectBrowser($userAgent),
        ]);
        
        if ($project) {
            $project->increment('views_count');
        }
    }

    protected function detectDevice(?string $userAgent): string
    {
        if (!$userAgent) return 'Unknown';
        
        $userAgent = strtolower($userAgent);
        
        if (str_contains($userAgent, 'mobile') || str_contains($userAgent, 'android') || str_contains($userAgent, 'iphone')) {
            return 'Mobile';
        }
        
        if (str_contains($userAgent, 'tablet') || str_contains($userAgent, 'ipad')) {
            return 'Tablet';
        }
        
        return 'Desktop';
    }

    protected function detectBrowser(?string $userAgent): string
    {
        if (!$userAgent) return 'Unknown';
        
        $userAgent = strtolower($userAgent);
        
        if (str_contains($userAgent, 'edg/')) return 'Edge';
        if (str_contains($userAgent, 'chrome/')) return 'Chrome';
        if (str_contains($userAgent, 'safari/') && !str_contains($userAgent, 'chrome/')) return 'Safari';
        if (str_contains($userAgent, 'firefox/')) return 'Firefox';
        
        return 'Other';
    }
}
