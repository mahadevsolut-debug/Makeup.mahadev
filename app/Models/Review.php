<?php
namespace App\Models;

use App\Core\Database;

class Review {
    public static function getApproved() {
        return Database::fetchAll("SELECT * FROM reviews WHERE status = 'approved' ORDER BY is_featured DESC, id DESC");
    }

    public static function create($data) {
        return Database::query(
            "INSERT INTO reviews (client_name, client_role, rating, review_text, status) VALUES (?, ?, ?, ?, 'approved')",
            [$data['client_name'], $data['client_role'] ?? 'Client', $data['rating'] ?? 5, $data['review_text']]
        );
    }

    public static function getAll() {
        return Database::fetchAll("SELECT * FROM reviews ORDER BY id DESC");
    }

    public static function updateStatus($id, $status) {
        return Database::query("UPDATE reviews SET status = ? WHERE id = ?", [$status, $id]);
    }

    public static function toggleFeatured($id, $isFeatured) {
        return Database::query("UPDATE reviews SET is_featured = ? WHERE id = ?", [$isFeatured, $id]);
    }

    public static function createManually($data) {
        return Database::query(
            "INSERT INTO reviews (client_name, client_role, rating, review_text, status, is_featured) VALUES (?, ?, ?, ?, 'approved', ?)",
            [$data['client_name'], $data['client_role'] ?? 'Happy Bride', $data['rating'] ?? 5, $data['review_text'], $data['is_featured'] ?? 0]
        );
    }

    public static function delete($id) {
        return Database::query("DELETE FROM reviews WHERE id = ?", [$id]);
    }
}
