<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Blog;

class BlogController extends Controller {
    public function index() {
        $data = [
            'meta_title' => 'Beauty Journal & Tips | Makeup.mahadev',
            'posts' => Blog::getPublished()
        ];
        $this->view('frontend/blog', $data);
    }

    public function detail($slug) {
        $post = Blog::findBySlug($slug);
        if (!$post) {
            $this->redirect('/blog');
        }
        $data = [
            'meta_title' => $post['title'] . ' | Makeup.mahadev',
            'post' => $post
        ];
        $this->view('frontend/blog_detail', $data);
    }
}
