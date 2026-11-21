<?php
require_once 'includes/bootstrap.php';

$now = time();
$currentDate = date('d F Y', $now);
$currentTime = date('h:i:s A', $now);
$currentDay = date('l', $now);
$pageTitle = 'Current Date & Time';
require_once 'includes/header.php';
?>
<section class="time-stage" aria-label="Current date and time">
    <p class="time-overline">Current Time</p>
    <div class="time-readout"><?= e($currentTime) ?></div>
    <p class="date-overline">Current Date</p>
    <div class="date-readout"><?= e($currentDate) ?></div>
    <div class="time-rule"></div>
    <div class="time-details">
        <div><span>Current Day</span><strong><?= e($currentDay) ?></strong></div>
    </div>
</section>
<?php require_once 'includes/footer.php'; ?>
