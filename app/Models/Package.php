<?php
namespace App\Models;

use App\Core\Database;

class Package {
    public static function getByServiceId($serviceId) {
        return Database::fetchAll("SELECT * FROM service_packages WHERE service_id = ? ORDER BY sort_order ASC, price ASC", [$serviceId]);
    }

    public static function find($id) {
        return Database::fetch("SELECT * FROM service_packages WHERE id = ?", [$id]);
    }

    public static function create($data) {
        Database::query(
            "INSERT INTO service_packages (service_id, name, price, description, is_popular, sort_order) VALUES (?, ?, ?, ?, ?, ?)",
            [$data['service_id'], $data['name'], $data['price'], $data['description'] ?? '', $data['is_popular'] ?? 0, $data['sort_order'] ?? 0]
        );
        return Database::lastInsertId();
    }
}
