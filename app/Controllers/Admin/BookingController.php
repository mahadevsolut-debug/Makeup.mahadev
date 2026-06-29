<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\CSRF;
use App\Core\Session;
use App\Models\Booking;

class BookingController extends Controller {
    public function index() {
        $this->requireAdmin();
        $data = [
            'meta_title' => 'Manage Booking Requests | Admin Panel',
            'bookings' => Booking::getAllWithDetails()
        ];
        $this->view('admin/bookings/index', $data, 'admin/layouts/main');
    }

    public function view($id) {
        $this->requireAdmin();
        $booking = Booking::findWithDetails($id);
        if (!$booking) {
            $this->redirect('/admin/bookings');
        }
        $data = [
            'meta_title' => 'Booking #' . $booking['booking_code'] . ' | Admin Panel',
            'booking' => $booking
        ];
        $this->view('admin/bookings/view', $data, 'admin/layouts/main');
    }

    public function updateStatus($id) {
        $this->requireAdmin();
        CSRF::validateRequest();
        $status = $_POST['status'] ?? 'pending';
        Booking::updateStatus($id, $status);
        Session::flash('success', 'Booking status updated to ' . ucfirst($status) . '.');
        $this->redirect('/admin/bookings/view/' . $id);
    }
}
