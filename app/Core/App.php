<?php
namespace App\Core;

class App {
    private Router $router;

    public function __construct() {
        $this->router = new Router();
        $this->registerRoutes();
    }

    private function registerRoutes() {
        // Public Frontend Routes
        $this->router->get('/', [\App\Controllers\HomeController::class, 'index']);
        $this->router->get('/about', [\App\Controllers\HomeController::class, 'about']);
        $this->router->get('/services', [\App\Controllers\ServiceController::class, 'index']);
        $this->router->get('/service/{slug}', [\App\Controllers\ServiceController::class, 'detail']);
        $this->router->get('/portfolio', [\App\Controllers\PortfolioController::class, 'index']);
        $this->router->get('/gallery', [\App\Controllers\PortfolioController::class, 'gallery']);
        $this->router->get('/blog', [\App\Controllers\BlogController::class, 'index']);
        $this->router->get('/blog/{slug}', [\App\Controllers\BlogController::class, 'detail']);
        $this->router->get('/reviews', [\App\Controllers\ReviewController::class, 'index']);
        $this->router->post('/review/submit', [\App\Controllers\ReviewController::class, 'submit']);
        $this->router->get('/contact', [\App\Controllers\HomeController::class, 'contact']);
        $this->router->post('/contact/submit', [\App\Controllers\HomeController::class, 'submitContact']);
        $this->router->get('/booking', [\App\Controllers\BookingController::class, 'index']);
        $this->router->post('/booking/calculate', [\App\Controllers\BookingController::class, 'calculatePriceApi']);
        $this->router->post('/booking/submit', [\App\Controllers\BookingController::class, 'submit']);

        // Admin Routes
        $this->router->get('/admin/login', [\App\Controllers\Admin\AuthController::class, 'loginForm']);
        $this->router->post('/admin/login', [\App\Controllers\Admin\AuthController::class, 'login']);
        $this->router->get('/admin/logout', [\App\Controllers\Admin\AuthController::class, 'logout']);

        $this->router->get('/admin', [\App\Controllers\Admin\DashboardController::class, 'index']);
        $this->router->get('/admin/dashboard', [\App\Controllers\Admin\DashboardController::class, 'index']);
        
        // Admin Services
        $this->router->get('/admin/services', [\App\Controllers\Admin\ServiceController::class, 'index']);
        $this->router->get('/admin/services/create', [\App\Controllers\Admin\ServiceController::class, 'create']);
        $this->router->post('/admin/services/store', [\App\Controllers\Admin\ServiceController::class, 'store']);
        $this->router->get('/admin/services/edit/{id}', [\App\Controllers\Admin\ServiceController::class, 'edit']);
        $this->router->post('/admin/services/update/{id}', [\App\Controllers\Admin\ServiceController::class, 'update']);
        $this->router->get('/admin/services/delete/{id}', [\App\Controllers\Admin\ServiceController::class, 'delete']);

        // Admin Bookings
        $this->router->get('/admin/bookings', [\App\Controllers\Admin\BookingController::class, 'index']);
        $this->router->get('/admin/bookings/view/{id}', [\App\Controllers\Admin\BookingController::class, 'view']);
        $this->router->post('/admin/bookings/update-status/{id}', [\App\Controllers\Admin\BookingController::class, 'updateStatus']);

        // Admin Portfolio
        $this->router->get('/admin/portfolio', [\App\Controllers\Admin\PortfolioController::class, 'index']);
        $this->router->post('/admin/portfolio/store', [\App\Controllers\Admin\PortfolioController::class, 'store']);
        $this->router->get('/admin/portfolio/delete/{id}', [\App\Controllers\Admin\PortfolioController::class, 'delete']);

        // Admin Settings & Content CMS
        $this->router->get('/admin/settings', [\App\Controllers\Admin\SettingsController::class, 'index']);
        $this->router->post('/admin/settings/save', [\App\Controllers\Admin\SettingsController::class, 'save']);
    }

    public function run() {
        $this->router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
    }
}
