<?php
namespace App\Models;

use App\Core\Database;

class Addon {
    public static function getActive($serviceId = null) {
        if ($serviceId) {
            return Database::fetchAll("SELECT * FROM service_addons WHERE (service_id = ? OR service_id IS NULL) AND status = 'active' ORDER BY name ASC", [$serviceId]);
        }
        return Database::fetchAll("SELECT * FROM service_addons WHERE status = 'active' ORDER BY name ASC");
    }

    public static function find($id) {
        return Database::fetch("SELECT * FROM service_addons WHERE id = ?", [$id]);
    }
}
