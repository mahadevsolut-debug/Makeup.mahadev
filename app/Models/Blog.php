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
}
