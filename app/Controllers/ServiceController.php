<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Service;

class ServiceController extends Controller {
    public function index() {
        $data = [
            'meta_title' => 'Services & Pricing | Makeup.mahadev',
            'services' => Service::getAllActive()
        ];
        $this->view('frontend/services', $data);
    }

    public function detail($slug) {
        $service = Service::findBySlug($slug);
        if (!$service) {
            $this->redirect('/services');
        }
        $data = [
            'meta_title' => $service['title'] . ' | Makeup.mahadev',
            'service' => $service
        ];
        $this->view('frontend/service_detail', $data);
    }
}
