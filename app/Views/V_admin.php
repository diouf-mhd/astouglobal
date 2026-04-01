<?php
$pageTitle = 'Admin - Astou Global SHOP';
$pageClass = 'theme-admin';
$validation = $validation ?? session()->getFlashdata('validation');
$error = $error ?? session()->getFlashdata('error');
$loginErrorDetails = $loginErrorDetails ?? session()->getFlashdata('loginErrorDetails') ?? [];
$phoneValue = $phoneValue ?? session()->getFlashdata('phoneValue') ?? old('phone');
$isAdmin = session('isLoggedIn') === true;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($pageTitle) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --nav-bg: #16202b;
            --nav-admin: linear-gradient(135deg, #ff8a3c, #ff5131);
            --card-bg: rgba(255, 255, 255, 0.9);
            --text-main: #0f1726;
            --shadow-soft: 0 18px 40px rgba(22, 32, 43, 0.18);
        }

        body {
            background: linear-gradient(180deg, #0f1726, #1e293b);
            color: #fff;
            min-height: 100vh;
        }

        .navbar {
            background: var(--nav-bg) !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
            margin: 0 0.25rem;
            border-radius: 999px;
            padding: 0.65rem 1rem;
        }

        .navbar-nav .nav-link.admin {
            background: var(--nav-admin);
            color: #fff;
            box-shadow: 0 8px 20px rgba(255, 81, 49, 0.35);
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link:focus {
            background: rgba(255, 255, 255, 0.12);
        }

        main {
            margin-top: 4rem;
        }

        .admin-panel {
            max-width: 520px;
            margin: 0 auto;
            padding: 3rem;
            background: var(--card-bg);
            border-radius: 24px;
            box-shadow: var(--shadow-soft);
            color: var(--text-main);
        }

        .form-control:focus {
            border-color: #ff5131;
            box-shadow: 0 0 0 0.25rem rgba(255, 81, 49, 0.25);
        }

        .btn-success {
            border-radius: 999px;
            background: linear-gradient(135deg, #ff8a3c, #ff5131);
            border: 0;
            padding: 0.85rem 2rem;
            font-weight: 700;
        }

        .auth-alert {
            border-radius: 18px;
            border: 0;
        }

        .auth-alert ul {
            margin: 0.5rem 0 0;
            padding-left: 1.25rem;
        }
    </style>
</head>
<body class="<?= esc($pageClass) ?>">
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= base_url('/') ?>">Astou Global SHOP</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Ouvrir la navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="<?= base_url('/') ?>">Accueil</a>
                <a class="nav-link" href="<?= base_url('vetements') ?>">Vetements</a>
                <a class="nav-link" href="<?= base_url('homme') ?>">Homme</a>
                <a class="nav-link" href="<?= base_url('chaussures') ?>">Chaussures</a>
                <a class="nav-link" href="<?= base_url('jalabe') ?>">Jalabe</a>
                <a class="nav-link" href="<?= base_url('parfum') ?>">Parfum</a>
                <a class="nav-link admin" href="<?= base_url('admin') ?>">Admin</a>
            </div>
        </div>
    </div>
</nav>

<main class="container">
    <?php if ($validation): ?>
        <div class="alert alert-danger mt-4"><?= $validation->listErrors() ?></div>
    <?php endif; ?>

   <section class="admin-panel mt-5">
    <h1>Espace Admin</h1>

    <?php if ($error): ?>
        <div class="alert alert-danger auth-alert" role="alert">
            <strong>Connexion admin impossible.</strong><br>
            <?= esc($error) ?>
            <?php if ($loginErrorDetails !== []): ?>
                <ul>
                    <?php foreach ($loginErrorDetails as $detail): ?>
                        <li><?= esc($detail) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if (! $isAdmin): ?>
        <p>Connectez-vous.</p>

        <form method="post" action="<?= base_url('admin') ?>">
    <?= csrf_field() ?>
    <div class="mb-3">
        <label for="adminPhone" class="form-label">Numero</label>
        <input type="tel" id="adminPhone" class="form-control" name="phone" placeholder="+221 77 000 00 00" value="<?= esc($phoneValue) ?>" required>
    </div>
    <div class="mb-4">
        <label for="adminPassword" class="form-label">Mot de passe</label>
        <input type="password" id="adminPassword" class="form-control" name="password" placeholder="********" required>
    </div>
    <button type="submit" class="btn btn-success w-100">Se connecter</button>
</form>

        <p class="small text-muted mt-3">Statut : Deconnecte</p>
    <?php else: ?>
        <p class="small text-muted mt-3">Statut : Connecte</p>

        <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger mt-2 w-100">
            Se deconnecter
        </a>
    <?php endif; ?>
</section>
</main>

<footer class="text-center text-white mt-5 mb-3">
    <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-2 gap-md-4">
        <p class="mb-0"><strong>ASTOU GLOBAL BUSINESS</strong></p>
        <p class="mb-0">Adresse : DAKAR/SEBIKOTANE</p>
        <p class="mb-0">Contact : 770124307</p>
    </div>
    <p class="mb-0 mt-2">&copy; 2026 junior-ndiaye tout droit reserve</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
