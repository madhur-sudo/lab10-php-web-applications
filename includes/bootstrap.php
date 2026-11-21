<?php
/**
 * bootstrap.php — Global bootstrap for LAB 10 PHP Workspace
 * Loaded on every page; sets up sessions, timezone and helpers.
 */

// -----------------------------------------------------------------
// 1. Timezone
// -----------------------------------------------------------------
date_default_timezone_set('Asia/Kolkata');

// -----------------------------------------------------------------
// 2. Session
// -----------------------------------------------------------------
if (session_status() === PHP_SESSION_NONE) {
    $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https');

    session_set_cookie_params([
        'httponly' => true,
        'secure' => $isHttps,
        'samesite' => 'Lax',
        'path' => '/',
    ]);
    ini_set('session.use_strict_mode', '1');
    session_start();
}

// -----------------------------------------------------------------
// 3. Helpers
// -----------------------------------------------------------------

/**
 * Escape a value for safe HTML output.
 */
function e(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Redirect to a URL and exit.
 */
function redirect(string $url): never {
    header('Location: ' . $url);
    exit;
}

/**
 * Return the current page filename so the sidebar can mark it active.
 */
function current_page(): string {
    return basename($_SERVER['PHP_SELF']);
}

/**
 * Format a duration in seconds as "X min Y sec".
 */
function format_duration(int $seconds): string {
    if ($seconds < 60) {
        return $seconds . ' sec';
    }
    $mins = intdiv($seconds, 60);
    $secs = $seconds % 60;
    return $mins . ' min ' . $secs . ' sec';
}
