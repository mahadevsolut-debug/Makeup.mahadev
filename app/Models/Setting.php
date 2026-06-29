<?php
namespace App\Models;

use App\Core\Database;

class Setting {
    public static function getAll() {
        try {
            $rows = Database::fetchAll("SELECT setting_key, setting_value FROM settings");
            $settings = [];
            foreach ($rows as $row) {
                $settings[$row['setting_key']] = $row['setting_value'];
            }
            return $settings;
        } catch (\Exception $e) {
            return [];
        }
    }

    public static function get($key, $default = '') {
        try {
            $row = Database::fetch("SELECT setting_value FROM settings WHERE setting_key = ?", [$key]);
            return $row ? $row['setting_value'] : $default;
        } catch (\Exception $e) {
            return $default;
        }
    }

    public static function saveMany(array $settingsData) {
        foreach ($settingsData as $key => $val) {
            Database::query(
                "INSERT INTO settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = ?",
                [$key, $val, $val]
            );
        }
    }
}
