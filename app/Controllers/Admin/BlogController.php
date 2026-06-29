<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\CSRF;
use App\Core\Session;
use App\Core\Uploader;
use App\Models\Blog;

class BlogController extends Controller {
    public function index() {
        $this->requireAdmin();
        $data = [
            'meta_title' => 'Blog Manager | Admin Panel',
            'posts' => Blog::getAll()
        ];
        $this->view('admin/blogs/index', $data, 'admin/layouts/main');
    }

    public function create() {
        $this->requireAdmin();
        $data = [
            'meta_title' => 'Create New Post | Admin Panel',
            'categories' => Blog::getCategories()
        ];
        $this->view('admin/blogs/create', $data, 'admin/layouts/main');
    }

    public function store() {
        $this->requireAdmin();
        CSRF::validateRequest();

        $featuredImage = null;
        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {
            $upload = Uploader::upload('featured_image', 'blogs');
            if ($upload['status']) {
                $featuredImage = $upload['filename'];
            }
        }

        Blog::create([
            'category_id' => !empty($_POST['category_id']) ? (int)$_POST['category_id'] : null,
            'title' => trim($_POST['title']),
            'content' => $_POST['content'] ?? '',
            'featured_image' => $featuredImage,
            'meta_title' => trim($_POST['meta_title'] ?? ''),
            'meta_description' => trim($_POST['meta_description'] ?? ''),
            'status' => $_POST['status'] ?? 'published'
        ]);

        Session::flash('success', 'Blog article created successfully!');
        $this->redirect('/admin/blogs');
    }

    public function edit($id) {
        $this->requireAdmin();
        $post = Blog::find($id);
        if (!$post) {
            $this->redirect('/admin/blogs');
        }
        $data = [
            'meta_title' => 'Edit Blog Post | Admin Panel',
            'post' => $post,
            'categories' => Blog::getCategories()
        ];
        $this->view('admin/blogs/edit', $data, 'admin/layouts/main');
    }

    public function update($id) {
        $this->requireAdmin();
        CSRF::validateRequest();

        $featuredImage = null;
        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {
            $upload = Uploader::upload('featured_image', 'blogs');
            if ($upload['status']) {
                $featuredImage = $upload['filename'];
            }
        }

        Blog::update($id, [
            'category_id' => !empty($_POST['category_id']) ? (int)$_POST['category_id'] : null,
            'title' => trim($_POST['title']),
            'content' => $_POST['content'] ?? '',
            'featured_image' => $featuredImage,
            'meta_title' => trim($_POST['meta_title'] ?? ''),
            'meta_description' => trim($_POST['meta_description'] ?? ''),
            'status' => $_POST['status'] ?? 'published'
        ]);

        Session::flash('success', 'Blog article updated successfully!');
        $this->redirect('/admin/blogs');
    }

    public function delete($id) {
        $this->requireAdmin();
        Blog::delete($id);
        Session::flash('success', 'Blog article deleted successfully.');
        $this->redirect('/admin/blogs');
    }

    public function uploadImage() {
        $this->requireAdmin();
        // CKEditor expects JSON upload confirmation response
        if (isset($_FILES['upload']) && $_FILES['upload']['error'] === UPLOAD_ERR_OK) {
            $upload = Uploader::upload('upload', 'blogs/editor');
            if ($upload['status']) {
                return $this->json([
                    'uploaded' => true,
                    'url' => BASE_URL . '/uploads/' . $upload['filename']
                ]);
            } else {
                return $this->json([
                    'uploaded' => false,
                    'error' => ['message' => $upload['error']]
                ], 400);
            }
        }
        return $this->json([
            'uploaded' => false,
            'error' => ['message' => 'No file received by the server.']
        ], 400);
    }
}
