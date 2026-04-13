<?php
$pageTitle = 'Chaussures - Astou Global SHOP';
$pageHeading = 'Toutes nos chaussures';
$pageDescription = 'Retrouvez tous les modeles de chaussures disponibles avec prix et commande WhatsApp.';
$pageClass = 'theme-chaussures';
$products = [
    [
        'image' => 'assets/img/C1.jpeg',
        'alt' => 'Chaussures femme',
        'name' => 'Chaussures femme',
        'price' => '2 500 FCFA',
    ],
    [
        'image' => 'assets/img/C2.jpeg',
        'alt' => 'Modele pieds nus',
        'name' => 'Modele pieds nus',
        'price' => ' FCFA',
    ],
    [
        'image' => 'assets/img/C3.jpeg',
        'alt' => 'Chaussures classiques',
        'name' => 'Chaussures classiques',
        'price' => '2  500 FCFA',
    ],
    [
        'image' => null,
        'alt' => 'Image a ajouter',
        'name' => 'Produit a ajouter 1',
        'price' => 'Prix a ajouter',
        'placeholder' => true,
    ],
    [
        'image' => null,
        'alt' => 'Image a ajouter',
        'name' => 'Produit a ajouter 2',
        'price' => 'Prix a ajouter',
        'placeholder' => true,
    ],
    [
        'image' => null,
        'alt' => 'Image a ajouter',
        'name' => 'Produit a ajouter 3',
        'price' => 'Prix a ajouter',
        'placeholder' => true,
    ],
    [
        'image' => null,
        'alt' => 'Image a ajouter',
        'name' => 'Produit a ajouter 4',
        'price' => 'Prix a ajouter',
        'placeholder' => true,
    ],
    [
        'image' => null,
        'alt' => 'Image a ajouter',
        'name' => 'Produit a ajouter 5',
        'price' => 'Prix a ajouter',
        'placeholder' => true,
    ],
    [
        'image' => null,
        'alt' => 'Image a ajouter',
        'name' => 'Produit a ajouter 6',
        'price' => 'Prix a ajouter',
        'placeholder' => true,
    ],
];
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
            --page-bg: #fff7ef;
            --surface: rgba(255, 255, 255, 0.92);
            --nav-bg: #935c0d;
            --primary: #d8841c;
            --text-main: #5f3b14;
            --text-muted: #95704a;
            --shadow-soft: 0 18px 40px rgba(147, 92, 13, 0.12);
            --shadow-card: 0 14px 32px rgba(95, 59, 20, 0.12);
        }

        body {
            background:
                radial-gradient(circle at top left, rgba(216, 132, 28, 0.16), transparent 26%),
                linear-gradient(180deg, #fffaf4 0%, var(--page-bg) 100%);
            color: var(--text-main);
        }

        .navbar {
            background: linear-gradient(135deg, var(--nav-bg), #6e4308) !important;
            box-shadow: 0 10px 28px rgba(110, 67, 8, 0.28);
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
            padding: 0.65rem 0.95rem;
            border-radius: 999px;
        }

        .navbar-nav .nav-link.admin {
            background: linear-gradient(135deg, #ff8a3c, #ff5131);
            color: #fff;
            box-shadow: 0 12px 24px rgba(255, 81, 49, 0.35);
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link:focus,
        .navbar-nav .nav-link.active {
            color: #fff;
            background: rgba(255, 255, 255, 0.14);
        }

        .hero {
            padding: 5rem 0 3rem;
        }

        .hero-card {
            background-image: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(255, 239, 214, 0.85)), url('<?= base_url('assets/img/C2.jpeg') ?>');
            background-size: cover;
            background-position: center;
            border-radius: 28px;
            box-shadow: var(--shadow-soft);
            padding: 2.5rem;
        }

        .product-grid {
            padding-bottom: 4rem;
        }

        .card {
            height: 100%;
            overflow: hidden;
            border: 0;
            border-radius: 22px;
            background: var(--surface);
            box-shadow: var(--shadow-card);
            transition: transform 0.28s ease, box-shadow 0.28s ease;
            position: relative;
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 22px 42px rgba(95, 59, 20, 0.18);
        }

        .card-actions {
            position: absolute;
            top: 1rem;
            right: 1rem;
            z-index: 2;
            display: none;
        }

        .card-actions button {
            font-size: 0.75rem;
            padding: 0.35rem 0.65rem;
        }

        .admin-only {
            display: none;
        }

        body.has-admin .admin-only {
            display: flex;
        }

        .card-img-top {
            width: 100%;
            height: 320px;
            object-fit: cover;
            display: block;
            transition: transform 0.35s ease, object-fit 0.35s ease;
        }

        .card:hover .card-img-top,
        .card:focus-within .card-img-top,
        .card:active .card-img-top {
            object-fit: contain;
            transform: scale(1.05);
        }

        .card-placeholder {
            height: 320px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            background: linear-gradient(135deg, rgba(216, 132, 28, 0.08), rgba(110, 67, 8, 0.12));
            color: var(--text-muted);
            font-weight: 700;
            text-align: center;
            border-bottom: 1px dashed rgba(110, 67, 8, 0.18);
        }

        .admin-upload-form {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 18px;
            padding: 1.25rem;
            box-shadow: 0 12px 28px rgba(110, 67, 8, 0.18);
            flex-direction: column;
            gap: 1rem;
        }

        .admin-upload-form input {
            border-radius: 999px;
            border-color: rgba(110, 67, 8, 0.3);
        }

        .card-body h5 {
            font-weight: 700;
        }

        .card-body p {
            color: var(--text-muted);
            font-weight: 600;
        }

        .btn-success,
        .btn-outline-primary {
            border-radius: 999px;
            font-weight: 700;
            padding: 0.85rem 1.35rem;
        }

        .btn-success {
            background: linear-gradient(135deg, var(--primary), #f3aa46);
            border: 0;
        }

        footer {
            border-top: 1px solid rgba(216, 132, 28, 0.12);
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
                <a class="nav-link active" href="<?= base_url('chaussures') ?>">Chaussures</a>
                <a class="nav-link" href="<?= base_url('jalabe') ?>">Jalabe</a>
                <a class="nav-link" href="<?= base_url('parfum') ?>">Parfum</a>
                <a class="nav-link admin" href="<?= base_url('admin') ?>">Admin</a>
            </div>
        </div>
    </div>
</nav>

<main class="container">
    <section class="hero">
        <div class="hero-card">
            <h1 class="fw-bold mb-3"><?= esc($pageHeading) ?></h1>
            <p class="mb-4 fs-5"><?= esc($pageDescription) ?></p>
            <a href="<?= base_url('/') ?>" class="btn btn-outline-primary">Retour a l'accueil</a>
        </div>
    </section>

    <div class="admin-actions admin-only mt-4">
        <button class="btn btn-outline-primary toggle-add-photo">Ajouter une photo (admin)</button>
    </div>
    <div id="addPhotoForm" class="admin-upload-form admin-only d-none">
        <h5 class="mb-2">Ajouter une photo</h5>
        <form class="d-flex flex-column gap-2" method="post" novalidate>
            <input type="url" class="form-control" placeholder="URL de l'image">
            <input type="text" class="form-control" placeholder="Nom du produit">
            <input type="text" class="form-control" placeholder="Prix">
            <button type="submit" class="btn btn-success">Valider</button>
        </form>
    </div>

    <section class="product-grid">
        <div class="row g-4">
            <?php foreach ($products as $product): ?>
                <div class="col-md-4">
                <div class="card">
                    <div class="card-actions admin-only">
                        <button type="button" class="btn btn-danger btn-sm">Supprimer la photo</button>
                    </div>
                    <?php if (! empty($product['image'])): ?>
                            <img src="<?= base_url($product['image']) ?>" class="card-img-top" alt="<?= esc($product['alt']) ?>">
                        <?php else: ?>
                            <div class="card-placeholder">Image / description / prix a ajouter</div>
                        <?php endif; ?>
                        <div class="card-body text-center p-4">
                            <h5><?= esc($product['name']) ?></h5>
                            <p><?= esc($product['price']) ?></p>
                            <?php if (empty($product['placeholder'])): ?>
                                <?php $message = 'Bonjour, je veux commander : ' . $product['name'] . '. Prix : ' . $product['price'] . '.'; ?>
                                <a href="https://wa.me/221770124307?text=<?= rawurlencode($message) ?>" class="btn btn-success">Commander sur WhatsApp</a>
                            <?php else: ?>
                                <span class="btn btn-outline-primary disabled">A completer</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<footer class="text-center p-3">
    <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-2 gap-md-4">
        <p class="mb-0"><strong>ASTOU GLOBAL BUSINESS</strong></p>
        <p class="mb-0">Adresse : DAKAR/SEBIKOTANE</p>
        <p class="mb-0">Contact : 770124307</p>
    </div>
    <p class="mb-0 mt-2">&copy; 2026 junior-ndiaye tout droit reserve</p>
</footer>

<script>
    (function () {
        const isAdmin = sessionStorage.getItem('agb-admin') === 'true';
        document.body.classList.toggle('has-admin', isAdmin);
        const toggle = document.querySelector('.toggle-add-photo');
        const form = document.getElementById('addPhotoForm');
        if (toggle && form) {
            toggle.addEventListener('click', function () {
                form.classList.toggle('d-none');
            });
        }
        document.querySelectorAll('.admin-upload-form form').forEach(function (uploadForm) {
            uploadForm.addEventListener('submit', function (event) {
                event.preventDefault();
                alert('Ajout simulé : la fonctionnalité sera reliée à la base plus tard.');
            });
        });
    })();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
