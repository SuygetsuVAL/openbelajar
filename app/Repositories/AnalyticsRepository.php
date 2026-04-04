<?php

namespace App\Repositories;

use App\Models\Analytics;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AnalyticsRepository
{
    public function create(array $data): Analytics
    {
        return Analytics::create($data);
    }

    public function getVisitorsToday(): int
    {
        return Analytics::whereDate('created_at', Carbon::today())->count();
    }

    public function getVisitorsThisMonth(): int
    {
        return Analytics::whereMonth('created_at', Carbon::now()->month)
                        ->whereYear('created_at', Carbon::now()->year)
                        ->count();
    }

    public function getVisitorsLast7Days(): array
    {
        $startDate = Carbon::today()->subDays(6);
        
        $stats = Analytics::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get()
            ->pluck('count', 'date')
            ->toArray();

        // Fill in missing days with 0, return as array of {date, views} objects
        $result = [];
        for ($i = 0; $i < 7; $i++) {
            $day = Carbon::today()->subDays(6 - $i);
            $dateKey = $day->format('Y-m-d');
            $result[] = [
                'date'  => $day->format('D'),  // Mon, Tue, etc.
                'views' => $stats[$dateKey] ?? 0,
            ];
        }

        return $result;
    }

    public function getDeviceSplit(): array
    {
        $raw = Analytics::select('device', DB::raw('count(*) as count'))
            ->whereNotNull('device')
            ->groupBy('device')
            ->get();

        // Return as array of {device_type, total} objects
        return $raw->map(fn($r) => [
            'device_type' => ucfirst($r->device ?? 'Unknown'),
            'total'       => $r->count,
        ])->toArray();
    }
}
