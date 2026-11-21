<?php
require_once 'includes/bootstrap.php';
$pageTitle = 'Applications';
require_once 'includes/header.php';
?>
<section class="app-grid" aria-label="Applications">
    <article class="app-card">
        <div class="app-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M20 21a8 8 0 0 0-16 0M12 13a5 5 0 1 0 0-10 5 5 0 0 0 0 10Z"/></svg></div>
        <h2>Session Application</h2>
        <p>Start a personal session and see how long it lasts.</p>
        <a class="button button-primary" href="session.php">Open application <span aria-hidden="true">→</span></a>
    </article>
    <article class="app-card">
        <div class="app-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18M8 14h.01M12 14h.01M16 14h.01M8 17h.01M12 17h.01"/></svg></div>
        <h2>Date &amp; Time</h2>
        <p>View the current date, time and day.</p>
        <a class="button button-primary" href="datetime.php">Open application <span aria-hidden="true">→</span></a>
    </article>
    <article class="app-card">
        <div class="app-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/><path d="m9 12 2 2 4-4"/></svg></div>
        <h2>Age Verification</h2>
        <p>Enter a name and age to check access.</p>
        <a class="button button-primary" href="age-check.php">Open application <span aria-hidden="true">→</span></a>
    </article>
</section>
<?php require_once 'includes/footer.php'; ?>
