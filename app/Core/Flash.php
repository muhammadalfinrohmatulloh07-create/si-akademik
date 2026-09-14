<?php
class Flash {
    public static function set($key, $message, $type = 'success') {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['flash'][$key] = [
            'message' => $message,
            'type' => $type
        ];
    }

    public static function get($key) {
        if (isset($_SESSION['flash'][$key])) {
            $data = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
            return $data;
        }
        return null;
    }
}