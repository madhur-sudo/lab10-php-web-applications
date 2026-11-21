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
    <section class="surface main-surface">
        <?php if ($active): ?>
            <h2 class="feature-title">Hello, <span class="accent-text"><?= e($_SESSION['username']) ?></span>.</h2>
            <p class="surface-copy">Your session began <?= e(date('d F Y, h:i A', $_SESSION['start_time'])) ?>.</p>
            <form method="post" action="logout.php" class="logout-form">
                <button class="button button-outline" type="submit">End session</button>
            </form>
        <?php else: ?>
            <h2 class="feature-title">Session greeting</h2>
            <p class="surface-copy">Enter your name to begin.</p>
            <?php if ($error !== ''): ?><p class="form-error" id="name-error" role="alert"><?= e($error) ?></p><?php endif; ?>
            <form method="post" action="session.php" class="form-stack">
                <label for="username">Your name</label>
                <input id="username" name="username" type="text" maxlength="80" autocomplete="name" placeholder="Enter your name" value="<?= e($nameInput) ?>" class="<?= $error !== '' ? 'has-error' : '' ?>" aria-invalid="<?= $error !== '' ? 'true' : 'false' ?>" <?= $error !== '' ? 'aria-describedby="name-error"' : '' ?> required>
                <button class="button button-primary" type="submit">Begin session</button>
            </form>
        <?php endif; ?>
    </section>
</div>
<?php require_once 'includes/footer.php'; ?>
