<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\CSRF;
use App\Core\Session;
use App\Core\Uploader;
use App\Models\Gallery;

class GalleryController extends Controller {
    public function index() {
        $this->requireAdmin();
        $data = [
            'meta_title' => 'Before & After Manager | Admin Panel',
            'items' => Gallery::getAll()
        ];
        $this->view('admin/gallery/index', $data, 'admin/layouts/main');
    }

    public function store() {
        $this->requireAdmin();
        CSRF::validateRequest();

        $beforeImage = null;
        if (isset($_FILES['before_image']) && $_FILES['before_image']['error'] === UPLOAD_ERR_OK) {
            $uploadBefore = Uploader::upload('before_image', 'gallery');
            if ($uploadBefore['status']) {
                $beforeImage = $uploadBefore['filename'];
            }
        }

        $afterImage = null;
        if (isset($_FILES['after_image']) && $_FILES['after_image']['error'] === UPLOAD_ERR_OK) {
            $uploadAfter = Uploader::upload('after_image', 'gallery');
            if ($uploadAfter['status']) {
                $afterImage = $uploadAfter['filename'];
            }
        }

        if (!$afterImage) {
            Session::flash('error', 'The "After Makeover" image is required.');
            $this->redirect('/admin/gallery');
        }

        Gallery::create([
            'title' => trim($_POST['title']),
            'category' => $_POST['category'] ?? 'Transformation',
            'before_image' => $beforeImage,
            'after_image' => $afterImage
        ]);

        Session::flash('success', 'Transformation image pair uploaded successfully!');
        $this->redirect('/admin/gallery');
    }

    public function delete($id) {
        $this->requireAdmin();
        Gallery::delete($id);
        Session::flash('success', 'Transformation item deleted successfully.');
        $this->redirect('/admin/gallery');
    }
}
