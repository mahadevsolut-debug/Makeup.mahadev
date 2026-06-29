<?php
namespace App\Models;

use App\Core\Database;

class Service {
    public static function getAllActive() {
        return Database::fetchAll("SELECT s.*, c.name as category_name FROM services s LEFT JOIN service_categories c ON s.category_id = c.id WHERE s.status = 'active' ORDER BY s.id DESC");
    }

    public static function getFeatured() {
        return Database::fetchAll("SELECT s.*, c.name as category_name FROM services s LEFT JOIN service_categories c ON s.category_id = c.id WHERE s.status = 'active' AND s.is_featured = 1 ORDER BY s.id DESC LIMIT 6");
    }

    public static function findBySlug($slug) {
        $service = Database::fetch("SELECT s.*, c.name as category_name FROM services s LEFT JOIN service_categories c ON s.category_id = c.id WHERE s.slug = ?", [$slug]);
        if ($service) {
            $service['packages'] = Package::getByServiceId($service['id']);
            $service['addons'] = Addon::getActive($service['id']);
        }
        return $service;
    }

    public static function find($id) {
        $service = Database::fetch("SELECT * FROM services WHERE id = ?", [$id]);
        if ($service) {
            $service['packages'] = Package::getByServiceId($service['id']);
            $service['addons'] = Addon::getActive($service['id']);
        }
        return $service;
    }

    public static function create($data) {
        $slug = preg_replace('/[^a-z0-9-]+/', '-', strtolower(trim($data['title'])));
        Database::query(
            "INSERT INTO services (category_id, title, slug, description, cover_image, duration, pricing_type, simple_price, status, is_featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [$data['category_id'] ?? null, $data['title'], $slug, $data['description'], $data['cover_image'] ?? null, $data['duration'] ?? '2 Hours', $data['pricing_type'] ?? 'package', $data['simple_price'] ?? 0, $data['status'] ?? 'active', $data['is_featured'] ?? 0]
        );
        return Database::lastInsertId();
    }

    public static function update($id, $data) {
        $slug = preg_replace('/[^a-z0-9-]+/', '-', strtolower(trim($data['title'])));
        if (!empty($data['cover_image'])) {
            return Database::query(
                "UPDATE services SET category_id = ?, title = ?, slug = ?, description = ?, cover_image = ?, duration = ?, pricing_type = ?, simple_price = ?, status = ?, is_featured = ? WHERE id = ?",
                [$data['category_id'] ?? null, $data['title'], $slug, $data['description'], $data['cover_image'], $data['duration'] ?? '2 Hours', $data['pricing_type'] ?? 'package', $data['simple_price'] ?? 0, $data['status'] ?? 'active', $data['is_featured'] ?? 0, $id]
            );
        } else {
            return Database::query(
                "UPDATE services SET category_id = ?, title = ?, slug = ?, description = ?, duration = ?, pricing_type = ?, simple_price = ?, status = ?, is_featured = ? WHERE id = ?",
                [$data['category_id'] ?? null, $data['title'], $slug, $data['description'], $data['duration'] ?? '2 Hours', $data['pricing_type'] ?? 'package', $data['simple_price'] ?? 0, $data['status'] ?? 'active', $data['is_featured'] ?? 0, $id]
            );
        }
    }

    public static function delete($id) {
        return Database::query("DELETE FROM services WHERE id = ?", [$id]);
    }
}
