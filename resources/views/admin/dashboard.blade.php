@extends('layouts.admin')

@section('header', 'Dashboard Overview')

@section('content')
<div class="row g-4 mb-5">
    <div class="col-md-3" data-aos="fade-up" data-aos-duration="600">
        <div class="card bg-transparent border-secondary border-opacity-10 h-100 rounded-4 p-3 shadow-sm hover-elevate transition-all">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h6 class="text-muted fw-semibold tracking-wider text-uppercase mb-0">Visitors Today</h6>
                    <div class="bg-success bg-opacity-10 text-success rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
                <h2 class="display-5 fw-bold mb-0 text-white">{{ number_format($visitorsToday) }}</h2>
            </div>
        </div>
    </div>
    
    <div class="col-md-3" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100">
        <div class="card bg-transparent border-secondary border-opacity-10 h-100 rounded-4 p-3 shadow-sm hover-elevate transition-all">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h6 class="text-muted fw-semibold tracking-wider text-uppercase mb-0">Monthly Visitors</h6>
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-calendar-check-fill"></i>
                    </div>
                </div>
                <h2 class="display-5 fw-bold mb-0 text-white">{{ number_format($visitorsMonth) }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3" data-aos="fade-up" data-aos-duration="600" data-aos-delay="200">
        <div class="card bg-transparent border-secondary border-opacity-10 h-100 rounded-4 p-3 shadow-sm hover-elevate transition-all">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h6 class="text-muted fw-semibold tracking-wider text-uppercase mb-0">Project Views</h6>
                    <div class="bg-info bg-opacity-10 text-info rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-eye-fill"></i>
                    </div>
                </div>
                <h2 class="display-5 fw-bold mb-0 text-white">{{ number_format($totalViews) }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3" data-aos="fade-up" data-aos-duration="600" data-aos-delay="300">
        <div class="card bg-transparent border-secondary border-opacity-10 h-100 rounded-4 p-3 shadow-sm hover-elevate transition-all">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h6 class="text-muted fw-semibold tracking-wider text-uppercase mb-0">Unread Messages</h6>
                    <div class="bg-warning bg-opacity-10 text-warning rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                </div>
                <h2 class="display-5 fw-bold mb-0 text-white">{{ number_format($unreadMessages) }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Main Chart -->
    <div class="col-lg-8" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
        <div class="card bg-transparent border-secondary border-opacity-10 rounded-4 h-100 shadow-sm transition-all hover-elevate">
            <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0">
                <h5 class="fw-bold text-white mb-0">Traffic Overview (Last 7 Days)</h5>
            </div>
            <div class="card-body px-4 pb-4 pt-2" style="height: 300px; position: relative;">
                <canvas id="trafficChart" data-stats='@json($visitorTrend)' style="display:block;width:100%;height:100%;"></canvas>
            </div>
        </div>
    </div>

    <!-- Doughnut Chart -->
    <div class="col-lg-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
        <div class="card bg-transparent border-secondary border-opacity-10 rounded-4 h-100 shadow-sm transition-all hover-elevate">
            <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0">
                <h5 class="fw-bold text-white mb-0">Device Split</h5>
            </div>
            <div class="card-body px-4 pb-4 pt-2 d-flex flex-column justify-content-center align-items-center" style="height: 300px; position: relative;">
                <canvas id="deviceChart" data-stats='@json($deviceSplit)' style="display:block;width:100%;height:100%;"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection
