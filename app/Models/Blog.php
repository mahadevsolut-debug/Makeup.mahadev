<?php
namespace App\Models;

use App\Core\Database;

class Blog {
    public static function getPublished() {
        return Database::fetchAll("SELECT b.*, c.name as category_name FROM blogs b LEFT JOIN blog_categories c ON b.category_id = c.id WHERE b.status = 'published' ORDER BY b.published_at DESC");
    }

    public static function findBySlug($slug) {
        return Database::fetch("SELECT b.*, c.name as category_name FROM blogs b LEFT JOIN blog_categories c ON b.category_id = c.id WHERE b.slug = ?", [$slug]);
    }

    public static function getAll() {
        return Database::fetchAll("SELECT b.*, c.name as category_name FROM blogs b LEFT JOIN blog_categories c ON b.category_id = c.id ORDER BY b.id DESC");
    }

    public static function find($id) {
        return Database::fetch("SELECT * FROM blogs WHERE id = ?", [$id]);
    }

    public static function create($data) {
        $slug = preg_replace('/[^a-z0-9-]+/', '-', strtolower(trim($data['title'])));
        Database::query(
            "INSERT INTO blogs (category_id, title, slug, content, featured_image, meta_title, meta_description, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
            [$data['category_id'] ?? null, $data['title'], $slug, $data['content'], $data['featured_image'] ?? null, $data['meta_title'] ?? null, $data['meta_description'] ?? null, $data['status'] ?? 'published']
        );
        return Database::lastInsertId();
    }

    public static function update($id, $data) {
        $slug = preg_replace('/[^a-z0-9-]+/', '-', strtolower(trim($data['title'])));
        if (!empty($data['featured_image'])) {
            return Database::query(
                "UPDATE blogs SET category_id = ?, title = ?, slug = ?, content = ?, featured_image = ?, meta_title = ?, meta_description = ?, status = ? WHERE id = ?",
                [$data['category_id'] ?? null, $data['title'], $slug, $data['content'], $data['featured_image'], $data['meta_title'] ?? null, $data['meta_description'] ?? null, $data['status'] ?? 'published', $id]
            );
        } else {
            return Database::query(
                "UPDATE blogs SET category_id = ?, title = ?, slug = ?, content = ?, meta_title = ?, meta_description = ?, status = ? WHERE id = ?",
                [$data['category_id'] ?? null, $data['title'], $slug, $data['content'], $data['meta_title'] ?? null, $data['meta_description'] ?? null, $data['status'] ?? 'published', $id]
            );
        }
    }

    public static function delete($id) {
        return Database::query("DELETE FROM blogs WHERE id = ?", [$id]);
    }

    public static function getCategories() {
        return Database::fetchAll("SELECT * FROM blog_categories ORDER BY name ASC");
    }
}
