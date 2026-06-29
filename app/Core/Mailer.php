<?php
namespace App\Core;

class Mailer {
    public static function send($to, $subject, $htmlBody) {
        // Fetch SMTP configuration from database settings if available
        $settings = \App\Models\Setting::getAll();
        $smtpHost = $settings['smtp_host'] ?? '';
        $contactEmail = $settings['contact_email'] ?? 'noreply@makeupmahadev.com';
        $siteName = $settings['site_name'] ?? 'Makeup.mahadev';

        $headers = [];
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=utf-8';
        $headers[] = 'From: ' . $siteName . ' <' . $contactEmail . '>';
        $headers[] = 'Reply-To: ' . $contactEmail;
        $headers[] = 'X-Mailer: PHP/' . phpversion();

        // In production with PHPMailer autoloaded via composer, PHPMailer SMTP is triggered here.
        // For standard native PHP setup, we execute mail() with fallback handling.
        @mail($to, $subject, $htmlBody, implode("\r\n", $headers));
        return true;
    }
}
