<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Blog;

class DashboardController extends Controller {
    public function index() {
        $this->requireAdmin();

        $bookings = Booking::getAllWithDetails();
        $totalRevenue = 0;
        $pendingBookingsCount = 0;

        foreach ($bookings as $b) {
            if ($b['status'] === 'confirmed' || $b['status'] === 'completed') {
                $totalRevenue += (float)$b['total_price'];
            }
            if ($b['status'] === 'pending') {
                $pendingBookingsCount++;
            }
        }

        $data = [
            'meta_title' => 'Dashboard Overview | Admin Panel',
            'total_bookings' => count($bookings),
            'pending_count' => $pendingBookingsCount,
            'total_revenue' => $totalRevenue,
            'total_services' => count(Service::getAllActive()),
            'recent_bookings' => array_slice($bookings, 0, 5)
        ];

        $this->view('admin/dashboard', $data, 'admin/layouts/main');
    }
}
