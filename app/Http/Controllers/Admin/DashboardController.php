<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\AnalyticsRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\MessageRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(
        protected AnalyticsRepository $analyticsRepository,
        protected ProjectRepository $projectRepository,
        protected MessageRepository $messageRepository
    ) {}

    public function index()
    {
        $visitorsToday = $this->analyticsRepository->getVisitorsToday();
        $visitorsMonth = $this->analyticsRepository->getVisitorsThisMonth();
        $visitorTrend = $this->analyticsRepository->getVisitorsLast7Days();
        $deviceSplit = $this->analyticsRepository->getDeviceSplit();

        $totalViews = $this->projectRepository->getTotalViews();
        $unreadMessages = $this->messageRepository->getUnreadCount();

        return view('admin.dashboard', compact(
            'visitorsToday', 
            'visitorsMonth', 
            'visitorTrend', 
            'deviceSplit', 
            'totalViews', 
            'unreadMessages'
        ));
    }
}
