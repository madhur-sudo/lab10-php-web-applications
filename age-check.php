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
$pageTitle = 'Age-based access';
$pageDesc = 'A small server-side check against an age threshold of 18.';
require_once 'includes/header.php';
?>
<div class="content-grid age-grid">
<section class="surface main-surface">
    <span class="status-label">APPLICATION 03 <span class="status-divider">/</span> ACCESS CHECK</span>
    <h2 class="feature-title">A clear answer,<br><span class="accent-text">after a check.</span></h2>
    <p class="surface-copy">Enter a name and age. PHP validates both fields before deciding whether access is allowed.</p>
    <?php if ($errors): ?><div class="form-error" role="alert"><strong>Check the highlighted details.</strong><ul><?php foreach ($errors as $error): ?><li><?= e($error) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
    <form method="post" action="age-check.php" class="form-stack">
        <label for="name">Your name</label><input id="name" name="name" type="text" maxlength="80" autocomplete="name" placeholder="e.g. Sam Rivera" value="<?= e($name) ?>" required>
        <label for="age">Your age</label><input id="age" name="age" type="number" min="0" max="130" step="1" inputmode="numeric" placeholder="e.g. 21" value="<?= e($age) ?>" required>
        <button class="button button-primary" type="submit">Check access <span aria-hidden="true">→</span></button>
    </form>
</section>
<aside class="side-note result-note">
    <?php if ($authorized === true): ?><span class="result-icon granted">✓</span><span class="status-label">ACCESS GRANTED</span><h3>Welcome to this site, <span class="accent-text"><?= e($name) ?></span>!</h3><p>At <?= e($age) ?>, this visitor meets the site's minimum age of 18.</p>
    <?php elseif ($authorized === false): ?><span class="result-icon denied">↗</span><span class="status-label">ACCESS NOT GRANTED</span><h3>Hello <?= e($name) ?>, you are not authorized to visit the site.</h3><p>Access requires an age of 18 or above.</p>
    <?php else: ?><span class="note-number">03</span><h3>One threshold.</h3><p>Under 18 is not authorized. At 18 and above, the visitor is welcomed.</p><?php endif; ?>
    <div class="note-rule"></div><span class="note-foot">SERVER-SIDE VALIDATION</span>
</aside>
</div>
<?php require_once 'includes/footer.php'; ?>
