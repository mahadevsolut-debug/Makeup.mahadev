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
}
