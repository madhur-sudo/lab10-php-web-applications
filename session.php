<?php
require_once 'includes/bootstrap.php';
$error = '';
$nameInput = '';
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $submittedName = $_POST['username'] ?? '';
    $nameInput = is_string($submittedName) ? trim($submittedName) : '';
    if ($nameInput === '') {
        $error = 'Please enter your name to start a session.';
    } elseif (preg_match('//u', $nameInput) !== 1) {
        $error = 'Please enter a name using valid text.';
    } elseif (preg_match_all('/./us', $nameInput) > 80) {
        $error = 'Please keep your name under 80 characters.';
    } else {
        session_regenerate_id(true);
        $_SESSION['username'] = $nameInput;
        $_SESSION['start_time'] = time();
        redirect('session.php');
    }
}
$active = isset($_SESSION['username'], $_SESSION['start_time'])
    && is_string($_SESSION['username'])
    && $_SESSION['username'] !== ''
    && is_int($_SESSION['start_time']);
$pageTitle = 'Session greeting';
$pageDesc = 'A short visit, remembered with a PHP session.';
require_once 'includes/header.php';
?>
<div class="content-grid">
<section class="surface main-surface">
    <?php if ($active): ?>
        <span class="status-label"><span class="pulse"></span> SESSION ACTIVE</span>
        <h2 class="feature-title">Hello, <span class="accent-text"><?= e((string) $_SESSION['username']) ?></span>.</h2>
        <p class="surface-copy">Your name and the time you arrived are held in your PHP session.</p>
        <div class="detail-strip"><div><span>STARTED AT</span><strong><?= e(date('h:i:s A', (int) $_SESSION['start_time'])) ?></strong></div><div><span>START DATE</span><strong><?= e(date('d M Y', (int) $_SESSION['start_time'])) ?></strong></div></div>
        <form method="post" action="logout.php" class="logout-form"><button class="button button-outline" type="submit">End session <span aria-hidden="true">↗</span></button></form>
    <?php else: ?>
        <span class="status-label">APPLICATION 01 <span class="status-divider">/</span> SESSION</span>
        <h2 class="feature-title">Start with your<br><span class="accent-text">name.</span></h2>
        <p class="surface-copy">Submit once to begin a session. Your greeting and start time will stay available until you log out.</p>
        <?php if ($error !== ''): ?><p class="form-error" role="alert"><?= e($error) ?></p><?php endif; ?>
        <form method="post" action="session.php" class="form-stack">
            <label for="username">Your name</label>
            <input id="username" name="username" type="text" maxlength="80" autocomplete="name" placeholder="e.g. Sam Rivera" value="<?= e($nameInput) ?>" required>
            <button class="button button-primary" type="submit">Begin session <span aria-hidden="true">→</span></button>
        </form>
    <?php endif; ?>
</section>
<aside class="side-note"><span class="note-number">01</span><h3>State that stays.</h3><p>PHP stores the username and a Unix timestamp in <code>$_SESSION</code>. The browser only carries the session identifier.</p><div class="note-rule"></div><span class="note-foot">SESSION · TIME · GREETING</span></aside>
</div>
<?php require_once 'includes/footer.php'; ?>
