<?php
require_once 'includes/bootstrap.php';
$pageTitle = 'Home';
require_once 'includes/header.php';
?>
<section class="app-grid" aria-label="Applications">
    <a class="app-card" href="session.php">
        <h2>Session</h2>
        <span class="card-arrow" aria-hidden="true">→</span>
    </a>
    <a class="app-card" href="datetime.php">
        <h2>Date &amp; Time</h2>
        <span class="card-arrow" aria-hidden="true">→</span>
    </a>
    <a class="app-card" href="age-check.php">
        <h2>Age Access</h2>
        <span class="card-arrow" aria-hidden="true">→</span>
    </a>
</section>
<?php require_once 'includes/footer.php'; ?>
