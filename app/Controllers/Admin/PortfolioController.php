<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\CSRF;
use App\Core\Session;
use App\Core\Uploader;
use App\Models\Portfolio;

class PortfolioController extends Controller {
    public function index() {
        $this->requireAdmin();
        $data = [
            'meta_title' => 'Portfolio Manager | Admin Panel',
            'portfolio' => Portfolio::getAll()
        ];
        $this->view('admin/portfolio/index', $data, 'admin/layouts/main');
    }

    public function store() {
        $this->requireAdmin();
        CSRF::validateRequest();

        if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
            $upload = Uploader::upload('cover_image', 'portfolio');
            if ($upload['status']) {
                Portfolio::create([
                    'title' => trim($_POST['title']),
                    'category' => $_POST['category'] ?? 'Bridal',
                    'client_name' => trim($_POST['client_name'] ?? ''),
                    'cover_image' => $upload['filename'],
                    'description' => trim($_POST['description'] ?? '')
                ]);
                Session::flash('success', 'Portfolio item added successfully!');
            } else {
                Session::flash('error', $upload['error']);
            }
        }
        $this->redirect('/admin/portfolio');
    }

    public function delete($id) {
        $this->requireAdmin();
        Portfolio::delete($id);
        Session::flash('success', 'Item deleted.');
        $this->redirect('/admin/portfolio');
    }
}
