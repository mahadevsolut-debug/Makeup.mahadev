<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\CSRF;
use App\Core\Session;
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
        if (!empty($settingsToSave)) {
            Setting::saveMany($settingsToSave);
            Session::flash('success', 'Website settings saved successfully!');
        }
        $this->redirect('/admin/settings');
    }
}
