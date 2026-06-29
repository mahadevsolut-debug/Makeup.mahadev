<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\CSRF;
use App\Core\Session;
use App\Models\Review;

class ReviewController extends Controller {
    public function index() {
        $data = [
            'meta_title' => 'Client Testimonials | Makeup.mahadev',
            'reviews' => Review::getApproved()
        ];
        $this->view('frontend/reviews', $data);
    }

    public function submit() {
        CSRF::validateRequest();
        $name = trim($_POST['client_name'] ?? '');
        $role = trim($_POST['client_role'] ?? 'Happy Bride');
        $rating = (int)($_POST['rating'] ?? 5);
        $text = trim($_POST['review_text'] ?? '');

        if ($name && $text) {
            Review::create([
                'client_name' => $name,
                'client_role' => $role,
                'rating' => $rating,
                'review_text' => $text
            ]);
            Session::flash('success', 'Thank you for your valuable feedback!');
        }
        $this->redirect('/reviews');
    }
}
