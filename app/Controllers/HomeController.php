<?php
namespace AppControllers; // Wait! Let's check namespace format
namespace App\Controllers;

use App\Core\Controller;
use App\Core\CSRF;
use App\Core\Session;
use App\Core\Mailer;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Review;
use App\Models\Blog;
use App\Models\Setting;

class HomeController extends Controller {
    public function index() {
        $data = [
            'meta_title' => Setting::get('site_title', 'Makeup.mahadev | Luxury Bridal & Makeup Studio'),
            'featured_services' => Service::getFeatured(),
            'portfolio_items' => array_slice(Portfolio::getAll(), 0, 6),
            'testimonials' => Review::getApproved(),
            'latest_blogs' => Blog::getPublished()
        ];
        $this->view('frontend/home', $data);
    }

    public function about() {
        $data = [
            'meta_title' => 'About Us | Makeup.mahadev',
        ];
        $this->view('frontend/about', $data);
    }

    public function contact() {
        $data = [
            'meta_title' => 'Contact & Location | Makeup.mahadev',
        ];
        $this->view('frontend/contact', $data);
    }

    public function submitContact() {
        CSRF::validateRequest();
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $message = trim($_POST['message'] ?? '');

        if (!empty($name) && !empty($email) && !empty($message)) {
            $adminEmail = Setting::get('contact_email', 'admin@makeupmahadev.com');
            $subject = "New Contact Inquiry from " . $name;
            $body = "<p><strong>Name:</strong> {$name}</p><p><strong>Email:</strong> {$email}</p><p><strong>Message:</strong><br>{$message}</p>";
            Mailer::send($adminEmail, $subject, $body);

            Session::flash('success', 'Thank you for contacting us! We will get back to you shortly.');
        } else {
            Session::flash('error', 'Please fill in all required fields.');
        }

        $this->redirect('/contact');
    }
}
