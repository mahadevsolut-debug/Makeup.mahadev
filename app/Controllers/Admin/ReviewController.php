<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\CSRF;
use App\Core\Session;
use App\Models\Review;

class ReviewController extends Controller {
    public function index() {
        $this->requireAdmin();
        $data = [
            'meta_title' => 'Testimonials Manager | Admin Panel',
            'reviews' => Review::getAll()
        ];
        $this->view('admin/reviews/index', $data, 'admin/layouts/main');
    }

    public function store() {
        $this->requireAdmin();
        CSRF::validateRequest();

        $name = trim($_POST['client_name'] ?? '');
        $role = trim($_POST['client_role'] ?? 'Happy Bride');
        $rating = (int)($_POST['rating'] ?? 5);
        $text = trim($_POST['review_text'] ?? '');
        $isFeatured = isset($_POST['is_featured']) ? 1 : 0;

        if ($name && $text) {
            Review::createManually([
                'client_name' => $name,
                'client_role' => $role,
                'rating' => $rating,
                'review_text' => $text,
                'is_featured' => $isFeatured
            ]);
            Session::flash('success', 'Testimonial review added manually!');
        } else {
            Session::flash('error', 'Name and review content are required.');
        }

        $this->redirect('/admin/reviews');
    }

    public function approve($id) {
        $this->requireAdmin();
        Review::updateStatus($id, 'approved');
        Session::flash('success', 'Testimonial review approved successfully.');
        $this->redirect('/admin/reviews');
    }

    public function disapprove($id) {
        $this->requireAdmin();
        Review::updateStatus($id, 'pending');
        Session::flash('success', 'Testimonial review marked as pending.');
        $this->redirect('/admin/reviews');
    }

    public function toggleFeatured($id) {
        $this->requireAdmin();
        $reviews = Review::getAll();
        $target = null;
        foreach ($reviews as $r) {
            if ($r['id'] == $id) {
                $target = $r;
                break;
            }
        }

        if ($target) {
            $newFeatured = $target['is_featured'] ? 0 : 1;
            Review::toggleFeatured($id, $newFeatured);
            Session::flash('success', $newFeatured ? 'Review pinned to featured homepage slider.' : 'Review removed from homepage featured list.');
        }

        $this->redirect('/admin/reviews');
    }

    public function delete($id) {
        $this->requireAdmin();
        Review::delete($id);
        Session::flash('success', 'Testimonial review deleted successfully.');
        $this->redirect('/admin/reviews');
    }
}
