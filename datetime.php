<?php
require_once 'includes/bootstrap.php';

$now = time();
$currentDate = date('d F Y', $now);
$currentTime = date('h:i:s A', $now);
$currentDay = date('l', $now);
$pageTitle = 'Current Date & Time';
require_once 'includes/header.php';
?>
<section class="datetime-grid" aria-label="Current date and time">
    <article class="datetime-card">
        <div class="app-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18"/></svg></div>
        <p>Current Date</p>
        <strong><?= e($currentDate) ?></strong>
    </article>
    <article class="datetime-card datetime-card-primary">
        <div class="app-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></div>
        <p>Current Time</p>
        <strong><?= e($currentTime) ?></strong>
    </article>
    <article class="datetime-card">
        <div class="app-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 19V5M4 19h17M7 15l4-4 3 2 6-7"/></svg></div>
        <p>Current Day</p>
        <strong><?= e($currentDay) ?></strong>
    </article>
</section>
<?php require_once 'includes/footer.php'; ?>
