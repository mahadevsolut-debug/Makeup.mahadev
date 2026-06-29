<?php
namespace App\Models;

use App\Core\Database;

class Gallery {
    public static function getAll() {
        return Database::fetchAll("SELECT * FROM gallery ORDER BY id DESC");
    }

    public static function create($data) {
        Database::query(
            "INSERT INTO gallery (title, before_image, after_image, category) VALUES (?, ?, ?, ?)",
            [$data['title'], $data['before_image'] ?? null, $data['after_image'], $data['category'] ?? 'Transformation']
        );
        return Database::lastInsertId();
    }

    public static function delete($id) {
        return Database::query("DELETE FROM gallery WHERE id = ?", [$id]);
    }
}
