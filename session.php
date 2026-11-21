<?php
require_once 'includes/bootstrap.php';

$error = '';
$nameInput = '';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $submittedName = $_POST['username'] ?? '';
    $nameInput = is_string($submittedName) ? trim($submittedName) : '';

    if ($nameInput === '') {
        $error = 'Please enter your name to begin.';
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
$pageTitle = 'Session';
require_once 'includes/header.php';
?>
<div class="content-grid single-column">
    <section class="surface main-surface application-panel">
        <?php if ($active): ?>
            <div class="welcome-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M20 21a8 8 0 0 0-16 0M12 13a5 5 0 1 0 0-10 5 5 0 0 0 0 10Z"/></svg></div>
            <h2 class="feature-title">Hello, <span class="accent-text"><?= e($_SESSION['username']) ?></span>!</h2>
            <p class="surface-copy">Your session is active.</p>
            <form method="post" action="logout.php" class="logout-form">
                <button class="button button-outline" type="submit">Logout</button>
            </form>
        <?php else: ?>
            <div class="welcome-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg></div>
            <h2 class="feature-title">Start Session</h2>
            <p class="surface-copy">Enter your name to get started.</p>
            <?php if ($error !== ''): ?><p class="form-error" id="name-error" role="alert"><?= e($error) ?></p><?php endif; ?>
            <form method="post" action="session.php" class="form-stack">
                <label for="username">Your name</label>
                <input id="username" name="username" type="text" maxlength="80" autocomplete="name" placeholder="Enter your name" value="<?= e($nameInput) ?>" class="<?= $error !== '' ? 'has-error' : '' ?>" aria-invalid="<?= $error !== '' ? 'true' : 'false' ?>" <?= $error !== '' ? 'aria-describedby="name-error"' : '' ?> required>
                <button class="button button-primary" type="submit">Start Session</button>
            </form>
        <?php endif; ?>
    </section>
</div>
<?php require_once 'includes/footer.php'; ?>
