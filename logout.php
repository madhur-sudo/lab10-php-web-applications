<?php
require_once 'includes/bootstrap.php';
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST'
    || !isset($_SESSION['username'], $_SESSION['start_time'])
    || !is_string($_SESSION['username'])
    || !is_int($_SESSION['start_time'])) {
    redirect('session.php');
}
$username = (string) $_SESSION['username'];
$start = (int) $_SESSION['start_time'];
$end = time();
$duration = max(0, $end - $start);
$durationText = format_duration($duration);
$_SESSION = [];
if (ini_get('session.use_cookies')) {
    $cookie = session_get_cookie_params();
    setcookie(session_name(), '', ['expires' => time() - 42000, 'path' => $cookie['path'], 'domain' => $cookie['domain'], 'secure' => $cookie['secure'], 'httponly' => $cookie['httponly'], 'samesite' => $cookie['samesite'] ?? 'Lax']);
}
session_destroy();
$pageTitle = 'Until next time';
$pageDesc = 'Your session has ended and its stored data has been cleared.';
require_once 'includes/header.php';
?>
<section class="surface goodbye-surface"><span class="success-mark">✓</span><p class="eyebrow">SESSION COMPLETE</p><h2>Thank you, <span class="accent-text"><?= e($username) ?></span>.</h2><p class="surface-copy">Your visit lasted <strong><?= e($durationText) ?></strong>.</p><div class="detail-strip centered"><div><span>STARTED</span><strong><?= e(date('d M Y · h:i:s A', $start)) ?></strong></div><div><span>ENDED</span><strong><?= e(date('d M Y · h:i:s A', $end)) ?></strong></div><div><span>DURATION</span><strong><?= e($durationText) ?> <small>(<?= e((string) $duration) ?> sec)</small></strong></div></div><a class="button button-primary" href="session.php">Start another session <span aria-hidden="true">→</span></a></section>
<?php require_once 'includes/footer.php'; ?>
