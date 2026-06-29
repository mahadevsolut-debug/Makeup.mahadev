<?php
namespace App\Core;

class CSRF {
    public static function generateToken() {
        if (!Session::has('csrf_token')) {
            $token = bin2hex(random_bytes(32));
            Session::set('csrf_token', $token);
        }
        return Session::get('csrf_token');
    }

    public static function field() {
        $token = self::generateToken();
        return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '">';
    }

    public static function verifyToken($token) {
        $storedToken = Session::get('csrf_token');
        if (!$storedToken || !$token || !hash_equals($storedToken, $token)) {
            return false;
        }
        return true;
    }

    public static function validateRequest() {
        $token = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
        if (!self::verifyToken($token)) {
            http_response_code(403);
            die('CSRF Token Validation Failed. Please refresh the page and try again.');
        }
    }
}
