<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\CSRF;
use App\Core\Session;
use App\Core\Mailer;
use App\Models\Service;
use App\Models\Booking;
use App\Models\Setting;

class BookingController extends Controller {
    public function index() {
        $services = Service::getAllActive();
        $preselectedService = $_GET['service'] ?? null;

        $data = [
            'meta_title' => 'Reserve Your Session | Makeup.mahadev',
            'services' => $services,
            'preselected_service' => $preselectedService
        ];
        $this->view('frontend/booking', $data);
    }

    public function calculatePriceApi() {
        $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
        $serviceId = $input['service_id'] ?? null;
        $packageId = $input['package_id'] ?? null;
        $addons = $input['addons'] ?? [];

        if (!$serviceId) {
            return $this->json(['status' => false, 'error' => 'Service ID is required.'], 400);
        }

        $result = Booking::calculatePrice($serviceId, $packageId, $addons);
        if ($result['status']) {
            $service = Service::find($serviceId);
            if ($service) {
                $service['packages'] = \App\Models\Package::getByServiceId($serviceId);
                $service['addons'] = \App\Models\Addon::getByServiceId($serviceId);
                $result['service'] = $service;
            }
        }
        return $this->json($result);
    }

    public function submit() {
        CSRF::validateRequest();

        $serviceId = $_POST['service_id'] ?? null;
        $customerName = trim($_POST['customer_name'] ?? '');
        $customerEmail = trim($_POST['customer_email'] ?? '');
        $customerPhone = trim($_POST['customer_phone'] ?? '');
        $eventDate = $_POST['event_date'] ?? '';
        $eventTime = $_POST['event_time'] ?? '';
        $location = trim($_POST['location'] ?? '');

        if (!$serviceId || !$customerName || !$customerEmail || !$customerPhone || !$eventDate || !$eventTime || !$location) {
            Session::flash('error', 'Please complete all required fields.');
            $this->redirect('/booking');
        }

        $bookingResult = Booking::create([
            'service_id' => $serviceId,
            'package_id' => !empty($_POST['package_id']) ? (int)$_POST['package_id'] : null,
            'addons' => $_POST['addons'] ?? [],
            'customer_name' => $customerName,
            'customer_email' => $customerEmail,
            'customer_phone' => $customerPhone,
            'event_date' => $eventDate,
            'event_time' => $eventTime,
            'location' => $location,
            'notes' => trim($_POST['notes'] ?? '')
        ]);

        // Send confirmation emails
        $currency = Setting::get('currency_symbol', '₹');
        $adminEmail = Setting::get('contact_email', 'admin@makeupmahadev.com');
        
        $emailSubjectCustomer = "Booking Confirmation - " . $bookingResult['booking_code'] . " | Makeup.mahadev";
        $emailBodyCustomer = "<h3>Thank you for booking with us, {$customerName}!</h3>
            <p>Your booking request <strong>{$bookingResult['booking_code']}</strong> has been received and is pending confirmation.</p>
            <p><strong>Estimated Total:</strong> {$currency}" . number_format($bookingResult['total_price'], 2) . "</p>
            <p>Our team will contact you shortly on {$customerPhone} to confirm details.</p>";
        Mailer::send($customerEmail, $emailSubjectCustomer, $emailBodyCustomer);

        $emailSubjectAdmin = "NEW BOOKING ALERT [{$bookingResult['booking_code']}] - {$customerName}";
        $emailBodyAdmin = "<h3>New Booking Request Received</h3>
            <p><strong>Client:</strong> {$customerName} ({$customerPhone}, {$customerEmail})</p>
            <p><strong>Event Date:</strong> {$eventDate} at {$eventTime}</p>
            <p><strong>Location:</strong> {$location}</p>
            <p><strong>Total Estimated Revenue:</strong> {$currency}" . number_format($bookingResult['total_price'], 2) . "</p>
            <p><a href='" . BASE_URL . "/admin/bookings'>View in Admin Panel</a></p>";
        Mailer::send($adminEmail, $emailSubjectAdmin, $emailBodyAdmin);

        Session::flash('success_booking', [
            'code' => $bookingResult['booking_code'],
            'name' => $customerName,
            'total' => $bookingResult['total_price']
        ]);
        $this->redirect('/booking');
    }
}
