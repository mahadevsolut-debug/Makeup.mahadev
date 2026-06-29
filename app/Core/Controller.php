<?php
namespace App\Core;

abstract class Controller {
    protected function view($viewPath, $data = [], $layout = 'frontend/layouts/main') {
        extract($data);

        // Fetch site global settings for layout headers/footers
        $globalSettings = \App\Models\Setting::getAll();

        ob_start();
        $fullViewFile = APP_DIR . '/Views/' . $viewPath . '.php';
        if (file_exists($fullViewFile)) {
            require $fullViewFile;
        } else {
            die("View file not found: " . $fullViewFile);
        }
        $content = ob_get_clean();

        if ($layout) {
            $layoutFile = APP_DIR . '/Views/' . $layout . '.php';
            if (file_exists($layoutFile)) {
                require $layoutFile;
            } else {
                echo $content;
            }
        } else {
            echo $content;
        }
    }

    protected function json($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function redirect($url) {
        header('Location: ' . BASE_URL . $url);
        exit;
    }

    protected function requireAdmin() {
        if (!Session::get('admin_logged_in')) {
            $this->redirect('/admin/login');
        }
    }
}
