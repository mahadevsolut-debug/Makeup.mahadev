<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Portfolio;

class PortfolioController extends Controller {
    public function index() {
        $data = [
            'meta_title' => 'Portfolio & Lookbook | Makeup.mahadev',
            'items' => Portfolio::getAll()
        ];
        $this->view('frontend/portfolio', $data);
    }

    public function gallery() {
        $data = [
            'meta_title' => 'Transformation Gallery | Makeup.mahadev',
            'items' => Portfolio::getAll()
        ];
        $this->view('frontend/gallery', $data);
    }
}
