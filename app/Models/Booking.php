<?php
namespace App\Models;

use App\Core\Database;

class Booking {
    public static function calculatePrice($serviceId, $packageId = null, array $addonIds = []) {
        $service = Service::find($serviceId);
        if (!$service) {
            return ['status' => false, 'error' => 'Service not found.'];
        }

        $basePrice = 0.00;
        $packageName = '';

        if ($service['pricing_type'] === 'simple') {
            $basePrice = (float)$service['simple_price'];
        } else {
            if ($packageId) {
                $pkg = Package::find($packageId);
                if ($pkg) {
                    $basePrice = (float)$pkg['price'];
                    $packageName = $pkg['name'];
                }
            } else {
                // If package not chosen yet, pick lowest package
                $packages = Package::getByServiceId($serviceId);
                if (!empty($packages)) {
                    $basePrice = (float)$packages[0]['price'];
                    $packageName = $packages[0]['name'];
                }
            }
        }

        $addonsTotal = 0.00;
        $selectedAddonsDetails = [];

        if (!empty($addonIds)) {
            foreach ($addonIds as $addonId) {
                $addon = Addon::find($addonId);
                if ($addon) {
                    $addonsTotal += (float)$addon['price'];
                    $selectedAddonsDetails[] = $addon;
                }
            }
        }

        $totalPrice = $basePrice + $addonsTotal;

        return [
            'status' => true,
            'service_title' => $service['title'],
            'package_name' => $packageName,
            'base_price' => $basePrice,
            'addons_total' => $addonsTotal,
            'total_price' => $totalPrice,
            'addons' => $selectedAddonsDetails
        ];
    }

    public static function create(array $data) {
        $bookingCode = 'BK' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 8));
        $packageId = !empty($data['package_id']) ? (int)$data['package_id'] : null;
        $priceCalculation = self::calculatePrice($data['service_id'], $packageId, $data['addons'] ?? []);

        Database::query(
            "INSERT INTO bookings (booking_code, customer_name, customer_email, customer_phone, event_date, event_time, location, service_id, package_id, base_price, addons_total, total_price, notes, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')",
            [
                $bookingCode,
                $data['customer_name'],
                $data['customer_email'],
                $data['customer_phone'],
                $data['event_date'],
                $data['event_time'],
                $data['location'],
                $data['service_id'],
                $packageId,
                $priceCalculation['base_price'],
                $priceCalculation['addons_total'],
                $priceCalculation['total_price'],
                $data['notes'] ?? ''
            ]
        );

        $bookingId = Database::lastInsertId();

        // Attach Pivot Addons
        if (!empty($data['addons'])) {
            foreach ($data['addons'] as $addonId) {
                $addon = Addon::find($addonId);
                if ($addon) {
                    Database::query(
                        "INSERT INTO booking_addons (booking_id, addon_id, price_at_booking) VALUES (?, ?, ?)",
                        [$bookingId, $addonId, $addon['price']]
                    );
                }
            }
        }

        return [
            'booking_id' => $bookingId,
            'booking_code' => $bookingCode,
            'total_price' => $priceCalculation['total_price']
        ];
    }

    public static function getAllWithDetails() {
        return Database::fetchAll(
            "SELECT b.*, s.title as service_title, p.name as package_name 
             FROM bookings b 
             LEFT JOIN services s ON b.service_id = s.id 
             LEFT JOIN service_packages p ON b.package_id = p.id 
             ORDER BY b.id DESC"
        );
    }

    public static function findWithDetails($id) {
        $booking = Database::fetch(
            "SELECT b.*, s.title as service_title, p.name as package_name 
             FROM bookings b 
             LEFT JOIN services s ON b.service_id = s.id 
             LEFT JOIN service_packages p ON b.package_id = p.id 
             WHERE b.id = ?",
            [$id]
        );

        if ($booking) {
            $booking['addons'] = Database::fetchAll(
                "SELECT a.*, ba.price_at_booking 
                 FROM booking_addons ba 
                 JOIN service_addons a ON ba.addon_id = a.id 
                 WHERE ba.booking_id = ?",
                [$id]
            );
        }

        return $booking;
    }

    public static function updateStatus($id, $status) {
        return Database::query("UPDATE bookings SET status = ? WHERE id = ?", [$status, $id]);
    }
}
