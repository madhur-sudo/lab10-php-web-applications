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
        $errors['name'] = 'Enter your name.';
    } elseif (preg_match('//u', $name) !== 1) {
        $errors['name'] = 'Enter a name using valid text.';
    } elseif (preg_match_all('/./us', $name) > 80) {
        $errors['name'] = 'Keep your name under 80 characters.';
    }

    if ($age === '') {
        $errors['age'] = 'Enter your age.';
    } elseif (!ctype_digit($age)) {
        $errors['age'] = 'Age must be a whole number of 0 or more.';
    }

    if (!$errors) {
        $normalizedAge = ltrim($age, '0');
        $normalizedAge = $normalizedAge === '' ? '0' : $normalizedAge;
        $authorized = strlen($normalizedAge) > 2 || (int) $normalizedAge >= 18;
    }
}

$pageTitle = 'Age Verification';
require_once 'includes/header.php';
?>
<div class="content-grid single-column">
    <section class="surface main-surface">
        <h2 class="feature-title">Age Verification</h2>
        <p class="surface-copy">Enter your name and age.</p>

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
            <input id="age" name="age" type="number" min="0" step="1" inputmode="numeric" placeholder="Enter your age" value="<?= e($age) ?>" class="<?= isset($errors['age']) ? 'has-error' : '' ?>" aria-invalid="<?= isset($errors['age']) ? 'true' : 'false' ?>" <?= isset($errors['age']) ? 'aria-describedby="age-errors"' : '' ?> required>
            <button class="button button-primary" type="submit">Check eligibility</button>
        </form>

        <?php if ($authorized === false): ?>
            <p class="access-result denied" role="status">Hello, <?= e($name) ?>, you are not authorized to visit the site.</p>
        <?php elseif ($authorized === true): ?>
            <p class="access-result granted" role="status">Welcome to this site.</p>
        <?php endif; ?>
    </section>
</div>
<?php require_once 'includes/footer.php'; ?>
