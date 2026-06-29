<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\CSRF;
use App\Core\Session;
use App\Models\User;

class AuthController extends Controller {
    public function loginForm() {
        if (Session::get('admin_logged_in')) {
            $this->redirect('/admin/dashboard');
        }
        $this->view('admin/login', ['meta_title' => 'Admin Login | Makeup.mahadev'], false);
    }

    public function login() {
        CSRF::validateRequest();
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        $user = User::authenticate($email, $password);
        if ($user) {
            Session::set('admin_logged_in', true);
            Session::set('admin_user_id', $user['id']);
            Session::set('admin_name', $user['name']);
            Session::set('admin_role', $user['role']);
            $this->redirect('/admin/dashboard');
        } else {
            Session::flash('error', 'Invalid email or password.');
            $this->redirect('/admin/login');
        }
    }

    public function logout() {
        Session::destroy();
        $this->redirect('/admin/login');
    }
}
