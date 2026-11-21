<?php
$pageTitle = $pageTitle ?? 'Home';
$currentPage = current_page();
$navItems = [
    'index.php' => 'Home',
    'session.php' => 'Session',
    'datetime.php' => 'Date & time',
    'age-check.php' => 'Age access',
];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#071b2b">
    <title><?= e($pageTitle) ?> · Everyday</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="site-header">
    <a class="brand" href="index.php" aria-label="Everyday home"><span class="brand-mark">E</span><span>Everyday</span></a>
    <nav class="nav" aria-label="Main navigation">
        <?php foreach ($navItems as $href => $label): ?>
            <a href="<?= e($href) ?>" class="<?= $currentPage === $href ? 'active' : '' ?>"<?= $currentPage === $href ? ' aria-current="page"' : '' ?>><?= e($label) ?></a>
        <?php endforeach; ?>
    </nav>
</header>
<main class="container">
    <div class="page-heading">
        <h1><?= e($pageTitle) ?></h1>
    </div>
