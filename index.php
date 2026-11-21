<?php
require_once 'includes/bootstrap.php';
$pageTitle = 'Home';
require_once 'includes/header.php';
?>
<section class="intro-banner">
    <div class="intro-copy">
        <h2>Simple tools for your day.</h2>
        <p>Start a session, check the date and time, or find out if an age requirement is met.</p>
    </div>
</section>

<div class="section-heading">
    <h2>Choose a feature</h2>
</div>

<section class="app-grid" aria-label="Features">
    <a class="app-card" href="session.php">
        <div class="card-top"><span class="app-number">SESSION</span><span class="card-arrow" aria-hidden="true">↗</span></div>
        <div class="app-symbol symbol-user" aria-hidden="true">↗</div>
        <h3>Session greeting</h3>
        <p>Enter your name to begin and end your session when you're ready.</p>
        <div class="card-bottom"><span>Personal greeting</span><span>Open <b aria-hidden="true">→</b></span></div>
    </a>
    <a class="app-card" href="datetime.php">
        <div class="card-top"><span class="app-number">DATE &amp; TIME</span><span class="card-arrow" aria-hidden="true">↗</span></div>
        <div class="app-symbol symbol-clock" aria-hidden="true">◷</div>
        <h3>Date &amp; time</h3>
        <p>See today's date and the current time.</p>
        <div class="card-bottom"><span>Today's snapshot</span><span>Open <b aria-hidden="true">→</b></span></div>
    </a>
    <a class="app-card" href="age-check.php">
        <div class="card-top"><span class="app-number">AGE ACCESS</span><span class="card-arrow" aria-hidden="true">↗</span></div>
        <div class="app-symbol symbol-check" aria-hidden="true">✓</div>
        <h3>Age access</h3>
        <p>Check whether you meet the age requirement.</p>
        <div class="card-bottom"><span>Eligibility check</span><span>Open <b aria-hidden="true">→</b></span></div>
    </a>
</section>
<?php require_once 'includes/footer.php'; ?>
