<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\CSRF;
use App\Core\Session;
use App\Core\Uploader;
use App\Models\Setting;

class SettingsController extends Controller {
    public function index() {
        $this->requireAdmin();
        $data = [
            'meta_title' => 'Website & SaaS Settings | Admin Panel',
            'settings' => Setting::getAll()
        ];
        $this->view('admin/settings/index', $data, 'admin/layouts/main');
    }

    public function save() {
        $this->requireAdmin();
        CSRF::validateRequest();

        $settingsToSave = $_POST['settings'] ?? [];

        // Handle Site Logo Upload
        if (isset($_FILES['site_logo']) && $_FILES['site_logo']['error'] === UPLOAD_ERR_OK) {
            $logoUpload = Uploader::upload('site_logo', 'branding');
            if ($logoUpload['status']) {
                $settingsToSave['site_logo'] = $logoUpload['filename'];
            } else {
                Session::flash('error', 'Logo upload error: ' . $logoUpload['error']);
                $this->redirect('/admin/settings');
            }
        }

        // Handle Hero Image Cover Upload
        if (isset($_FILES['hero_image']) && $_FILES['hero_image']['error'] === UPLOAD_ERR_OK) {
            $heroUpload = Uploader::upload('hero_image', 'branding');
            if ($heroUpload['status']) {
                $settingsToSave['hero_image'] = $heroUpload['filename'];
            } else {
                Session::flash('error', 'Hero image upload error: ' . $heroUpload['error']);
                $this->redirect('/admin/settings');
            }
        }

        if (!empty($settingsToSave)) {
            Setting::saveMany($settingsToSave);
            Session::flash('success', 'Website settings saved successfully!');
        }
        $this->redirect('/admin/settings');
    }
}
