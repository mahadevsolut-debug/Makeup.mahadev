<?php
namespace App\Core;

class Uploader {
    public static function upload($fileKey, $subFolder = '') {
        if (!isset($_FILES[$fileKey]) || $_FILES[$fileKey]['error'] !== UPLOAD_ERR_OK) {
            return ['status' => false, 'error' => 'No file uploaded or upload error occurred.'];
        }

        $file = $_FILES[$fileKey];

        if ($file['size'] > MAX_FILE_SIZE) {
            return ['status' => false, 'error' => 'File size exceeds maximum allowed limit (10MB).'];
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, ALLOWED_IMAGE_EXTENSIONS)) {
            return ['status' => false, 'error' => 'Invalid file format. Allowed formats: JPG, PNG, WEBP.'];
        }

        // Verify MIME type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        $allowedMimes = ['image/jpeg', 'image/png', 'image/webp'];
        if (!in_array($mime, $allowedMimes)) {
            return ['status' => false, 'error' => 'Security check failed: Invalid image content.'];
        }

        $targetDir = UPLOAD_DIR . ($subFolder ? DS . trim($subFolder, '/\\') : '');
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $newFileName = uniqid('img_', true) . '.' . $ext;
        $targetPath = $targetDir . DS . $newFileName;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            $relativePath = ($subFolder ? trim($subFolder, '/\\') . '/' : '') . $newFileName;
            return ['status' => true, 'filename' => $relativePath];
        }

        return ['status' => false, 'error' => 'Failed to save uploaded file on server.'];
    }
}
