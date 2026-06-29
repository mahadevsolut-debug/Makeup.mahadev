<?php
namespace App\Models;

use App\Core\Database;

class Portfolio {
    public static function getAll() {
        return Database::fetchAll("SELECT * FROM portfolio ORDER BY sort_order ASC, id DESC");
    }

    public static function create($data) {
        Database::query(
            "INSERT INTO portfolio (title, category, client_name, event_date, cover_image, description) VALUES (?, ?, ?, ?, ?, ?)",
            [$data['title'], $data['category'] ?? 'Bridal', $data['client_name'] ?? null, $data['event_date'] ?? null, $data['cover_image'], $data['description'] ?? '']
        );
        return Database::lastInsertId();
    }

    public static function delete($id) {
        return Database::query("DELETE FROM portfolio WHERE id = ?", [$id]);
    }
}
