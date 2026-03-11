<?php
// app/Http/Controllers/Admin/DashboardController.php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Inquiry;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\VisitorTracking;
use App\Models\MarketingCampaign;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        // Get counts for widgets (ADMIN-09)
        $totalProjects = Project::count();
        $totalInquiries = Inquiry::count();
        $totalBookings = Booking::count();
        $totalInvestors = Customer::count();
        
        // Recent inquiries
        $recentInquiries = Inquiry::with(['customer.user'])
            ->latest()
            ->limit(5)
            ->get()
            ->map(function ($inquiry) {
                return [
                    'id' => $inquiry->id,
                    'customer_name' => $inquiry->customer->user->name,
                    'message' => substr($inquiry->message, 0, 50) . '...',
                    'status' => $inquiry->status,
                    'created_at' => $inquiry->created_at->diffForHumans(),
                ];
            });
        
        // Recent bookings
        $recentBookings = Booking::with(['customer.user'])
            ->latest()
            ->limit(5)
            ->get()
            ->map(function ($booking) {
                return [
                    'id' => $booking->id,
                    'customer_name' => $booking->customer->user->name,
                    'booking_date' => $booking->booking_date->format('Y-m-d'),
                    'booking_time' => $booking->booking_time,
                    'status' => $booking->status,
                ];
            });
        
        // Projects by status
        $projectsByStatus = Project::selectRaw('project_status, count(*) as count')
            ->groupBy('project_status')
            ->get()
            ->pluck('count', 'project_status');
        
        // Projects by type
        $projectsByType = Project::selectRaw('project_type, count(*) as count')
            ->groupBy('project_type')
            ->get()
            ->pluck('count', 'project_type');
        
        // Source distribution (ADMIN-10)
        $sourceDistribution = Customer::selectRaw('source, count(*) as count')
            ->whereNotNull('source')
            ->groupBy('source')
            ->get()
            ->pluck('count', 'source');
        
        // Weekly trends (last 7 days)
        $weeklyInquiries = Inquiry::whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()])
            ->selectRaw('DATE(created_at) as date, count(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        
        $weeklyBookings = Booking::whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()])
            ->selectRaw('DATE(created_at) as date, count(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        
        // UTM tracking summary
        $utmSummary = VisitorTracking::whereBetween('visited_at', [Carbon::now()->subDays(30), Carbon::now()])
            ->selectRaw('utm_source, count(*) as visits')
            ->whereNotNull('utm_source')
            ->groupBy('utm_source')
            ->orderByDesc('visits')
            ->limit(5)
            ->get();
        
        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'totalProjects' => $totalProjects,
                'totalInquiries' => $totalInquiries,
                'totalBookings' => $totalBookings,
                'totalInvestors' => $totalInvestors,
                'newInquiriesToday' => Inquiry::whereDate('created_at', Carbon::today())->count(),
                'newBookingsToday' => Booking::whereDate('created_at', Carbon::today())->count(),
                'activeProjects' => Project::where('is_active', true)->count(),
            ],
            'recentInquiries' => $recentInquiries,
            'recentBookings' => $recentBookings,
            'charts' => [
                'projectsByStatus' => $projectsByStatus,
                'projectsByType' => $projectsByType,
                'sourceDistribution' => $sourceDistribution,
                'weeklyInquiries' => $weeklyInquiries,
                'weeklyBookings' => $weeklyBookings,
            ],
            'utmSummary' => $utmSummary,
            'filters' => request()->all(['period']),
        ]);
    }
}