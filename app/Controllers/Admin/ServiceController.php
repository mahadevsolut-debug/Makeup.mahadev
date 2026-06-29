<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\CSRF;
use App\Core\Session;
use App\Core\Uploader;
use App\Models\Service;
use App\Models\Package;

class ServiceController extends Controller {
    public function index() {
        $this->requireAdmin();
        $data = [
            'meta_title' => 'Manage Services | Admin Panel',
            'services' => Service::getAllActive()
        ];
        $this->view('admin/services/index', $data, 'admin/layouts/main');
    }

    public function create() {
        $this->requireAdmin();
        $data = [
            'meta_title' => 'Create New Service | Admin Panel'
        ];
        $this->view('admin/services/create', $data, 'admin/layouts/main');
    }

    public function store() {
        $this->requireAdmin();
        CSRF::validateRequest();

        $coverImage = null;
        if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
            $upload = Uploader::upload('cover_image', 'services');
            if ($upload['status']) {
                $coverImage = $upload['filename'];
            }
        }

        $serviceId = Service::create([
            'title' => trim($_POST['title']),
            'description' => trim($_POST['description']),
            'pricing_type' => $_POST['pricing_type'] ?? 'package',
            'simple_price' => $_POST['simple_price'] ?? 0,
            'duration' => $_POST['duration'] ?? '2 Hours',
            'cover_image' => $coverImage,
            'status' => $_POST['status'] ?? 'active',
            'is_featured' => isset($_POST['is_featured']) ? 1 : 0
        ]);

        // Save tier packages if pricing type is package
        if (($_POST['pricing_type'] ?? '') === 'package' && isset($_POST['package_name']) && is_array($_POST['package_name'])) {
            foreach ($_POST['package_name'] as $idx => $pkgName) {
                if (!empty($pkgName) && isset($_POST['package_price'][$idx])) {
                    Package::create([
                        'service_id' => $serviceId,
                        'name' => trim($pkgName),
                        'price' => (float)$_POST['package_price'][$idx],
                        'description' => trim($_POST['package_desc'][$idx] ?? ''),
                        'is_popular' => isset($_POST['package_popular'][$idx]) ? 1 : 0,
                        'sort_order' => $idx
                    ]);
                }
            }
        }

        Session::flash('success', 'Service created successfully!');
        $this->redirect('/admin/services');
    }

    public function edit($id) {
        $this->requireAdmin();
        $service = Service::find($id);
        if (!$service) {
            $this->redirect('/admin/services');
        }
        $data = [
            'meta_title' => 'Edit Service | Admin Panel',
            'service' => $service
        ];
        $this->view('admin/services/edit', $data, 'admin/layouts/main');
    }

    public function update($id) {
        $this->requireAdmin();
        CSRF::validateRequest();

        $coverImage = null;
        if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
            $upload = Uploader::upload('cover_image', 'services');
            if ($upload['status']) {
                $coverImage = $upload['filename'];
            }
        }

        Service::update($id, [
            'title' => trim($_POST['title']),
            'description' => trim($_POST['description']),
            'pricing_type' => $_POST['pricing_type'] ?? 'package',
            'simple_price' => $_POST['simple_price'] ?? 0,
            'duration' => $_POST['duration'] ?? '2 Hours',
            'cover_image' => $coverImage,
            'status' => $_POST['status'] ?? 'active',
            'is_featured' => isset($_POST['is_featured']) ? 1 : 0
        ]);

        // Drop existing packages
        \App\Core\Database::query("DELETE FROM service_packages WHERE service_id = ?", [$id]);

        // Save tier packages if pricing type is package
        if (($_POST['pricing_type'] ?? '') === 'package' && isset($_POST['package_name']) && is_array($_POST['package_name'])) {
            foreach ($_POST['package_name'] as $idx => $pkgName) {
                if (!empty($pkgName) && isset($_POST['package_price'][$idx])) {
                    Package::create([
                        'service_id' => $id,
                        'name' => trim($pkgName),
                        'price' => (float)$_POST['package_price'][$idx],
                        'description' => trim($_POST['package_desc'][$idx] ?? ''),
                        'is_popular' => isset($_POST['package_popular'][$idx]) ? 1 : 0,
                        'sort_order' => $idx
                    ]);
                }
            }
        }

        Session::flash('success', 'Service updated successfully!');
        $this->redirect('/admin/services');
    }

    public function delete($id) {
        $this->requireAdmin();
        Service::delete($id);
        Session::flash('success', 'Service deleted successfully.');
        $this->redirect('/admin/services');
    }
}
