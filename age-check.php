<?php
require_once 'includes/bootstrap.php';
$name = '';
$age = '';
$errors = [];
$authorized = null;
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $submittedName = $_POST['name'] ?? '';
    $submittedAge = $_POST['age'] ?? '';
    $name = is_string($submittedName) ? trim($submittedName) : '';
    $age = is_string($submittedAge) ? trim($submittedAge) : '';
    if ($name === '') {
        $errors['name'] = 'Enter your name to continue.';
    } elseif (preg_match('//u', $name) !== 1) {
        $errors['name'] = 'Enter a name using valid text.';
    } elseif (preg_match_all('/./us', $name) > 80) {
        $errors['name'] = 'Please keep your name under 80 characters.';
    }
    if ($age === '') {
        $errors['age'] = 'Enter your age to continue.';
    } elseif (!ctype_digit($age)) {
        $errors['age'] = 'Enter a whole number between 0 and 130.';
    } elseif (strlen(ltrim($age, '0')) > 3 || (int) ltrim($age, '0') > 130) {
        $errors['age'] = 'Enter a whole number between 0 and 130.';
    }
    if (!$errors) {
        $authorized = (int) $age >= 18;
    }
}
$pageTitle = 'Age access';
require_once 'includes/header.php';
?>
<div class="content-grid age-grid">
    <section class="surface main-surface">
        <h2 class="feature-title">Check eligibility</h2>
        <p class="surface-copy">Enter your name and age to see whether you are eligible.</p>
        <?php if ($errors): ?>
            <div class="form-error" id="age-errors" role="alert">
                <strong>Please check your details.</strong>
                <ul><?php foreach ($errors as $error): ?><li><?= e($error) ?></li><?php endforeach; ?></ul>
            </div>
        <?php endif; ?>
        <form method="post" action="age-check.php" class="form-stack">
            <label for="name">Your name</label>
            <input id="name" name="name" type="text" maxlength="80" autocomplete="name" placeholder="Enter your name" value="<?= e($name) ?>" class="<?= isset($errors['name']) ? 'has-error' : '' ?>" aria-invalid="<?= isset($errors['name']) ? 'true' : 'false' ?>" <?= isset($errors['name']) ? 'aria-describedby="age-errors"' : '' ?> required>
            <label for="age">Your age</label>
            <input id="age" name="age" type="number" min="0" max="130" step="1" inputmode="numeric" placeholder="Enter your age" value="<?= e($age) ?>" class="<?= isset($errors['age']) ? 'has-error' : '' ?>" aria-invalid="<?= isset($errors['age']) ? 'true' : 'false' ?>" <?= isset($errors['age']) ? 'aria-describedby="age-errors"' : '' ?> required>
            <button class="button button-primary" type="submit">Check eligibility</button>
        </form>
    </section>
    <aside class="side-note result-note" aria-live="polite">
        <?php if ($authorized === true): ?>
            <span class="result-icon granted" aria-hidden="true">✓</span>
            <span class="status-label">ELIGIBLE</span>
            <h3>You're eligible, <span class="accent-text"><?= e($name) ?></span>.</h3>
            <p>The minimum age is 18.</p>
        <?php elseif ($authorized === false): ?>
            <span class="result-icon denied" aria-hidden="true">×</span>
            <span class="status-label">NOT ELIGIBLE</span>
            <h3>You're not eligible yet, <?= e($name) ?>.</h3>
            <p>The minimum age is 18.</p>
        <?php else: ?>
            <h3>Age access</h3>
            <p>Eligibility begins at age 18.</p>
        <?php endif; ?>
    </aside>
</div>
<?php require_once 'includes/footer.php'; ?>
