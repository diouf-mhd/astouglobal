<?php
$isAdmin = session('isLoggedIn') === true;
$successMessage = session()->getFlashdata('success');
$errorMessage = session()->getFlashdata('error');
$validation = session()->getFlashdata('validation');
$oldInput = session()->getFlashdata('old_input') ?? [];
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
            --page-bg: <?= esc($theme['page_bg']) ?>;
            --nav-bg: <?= esc($theme['nav_bg']) ?>;
            --nav-bg-dark: <?= esc($theme['nav_bg_dark']) ?>;
            --primary: <?= esc($theme['primary']) ?>;
            --primary-light: <?= esc($theme['primary_light']) ?>;
            --text-main: <?= esc($theme['text_main']) ?>;
            --text-muted: <?= esc($theme['text_muted']) ?>;
            --shadow-soft: <?= esc($theme['shadow_soft']) ?>;
            --shadow-card: <?= esc($theme['shadow_card']) ?>;
            --surface: rgba(255, 255, 255, 0.92);
        }

        body {
            background: linear-gradient(180deg, #fdfefe 0%, var(--page-bg) 100%);
            color: var(--text-main);
        }

        .navbar {
            background: linear-gradient(135deg, var(--nav-bg), var(--nav-bg-dark)) !important;
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.18);
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
            background-image: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.76)), url('<?= base_url($heroImage) ?>');
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
            box-shadow: 0 22px 42px rgba(0, 0, 0, 0.14);
        }

        .card-actions {
            position: absolute;
            top: 1rem;
            right: 1rem;
            z-index: 2;
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
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.03), rgba(0, 0, 0, 0.08));
            color: var(--text-muted);
            font-weight: 700;
            text-align: center;
        }

        .admin-upload-form {
            background: rgba(255, 255, 255, 0.96);
            border-radius: 18px;
            padding: 1.25rem;
            box-shadow: var(--shadow-soft);
        }

        .admin-upload-form input,
        .btn-success,
        .btn-outline-primary,
        .btn-danger {
            border-radius: 999px;
        }

        .btn-success {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border: 0;
            font-weight: 700;
        }

        .file-picker-label {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 52px;
            padding: 0.85rem 1.2rem;
            border-radius: 999px;
            border: 1px dashed color-mix(in srgb, var(--primary) 55%, white);
            background: rgba(255, 255, 255, 0.92);
            color: var(--text-main);
            font-weight: 600;
            cursor: pointer;
        }

        .file-picker-label:hover {
            background: #fff;
        }

        .file-picker-input {
            display: none;
        }

        .file-picker-name {
            color: var(--text-muted);
            font-size: 0.95rem;
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
                <a class="nav-link <?= $category === 'vetements' ? 'active' : '' ?>" href="<?= base_url('vetements') ?>">Vetements</a>
                <a class="nav-link <?= $category === 'homme' ? 'active' : '' ?>" href="<?= base_url('homme') ?>">Homme</a>
                <a class="nav-link <?= $category === 'chaussures' ? 'active' : '' ?>" href="<?= base_url('chaussures') ?>">Chaussures</a>
                <a class="nav-link <?= $category === 'jalabe' ? 'active' : '' ?>" href="<?= base_url('jalabe') ?>">Jalabe</a>
                <a class="nav-link <?= $category === 'parfum' ? 'active' : '' ?>" href="<?= base_url('parfum') ?>">Parfum</a>
                <a class="nav-link admin" href="<?= base_url('admin') ?>">Admin</a>
                <?php if ($isAdmin): ?>
                    <a class="nav-link" href="<?= base_url('logout') ?>">Deconnexion</a>
                <?php endif; ?>
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

    <?php if ($successMessage): ?>
        <div class="alert alert-success"><?= esc($successMessage) ?></div>
    <?php endif; ?>
    <?php if ($errorMessage): ?>
        <div class="alert alert-danger"><?= esc($errorMessage) ?></div>
    <?php endif; ?>
    <?php if ($validation): ?>
        <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
    <?php endif; ?>

    <?php if ($isAdmin): ?>
        <div class="mt-4 mb-3">
            <button class="btn btn-outline-primary toggle-add-product" type="button">Ajouter un produit</button>
        </div>
        <div id="addProductForm" class="admin-upload-form mb-4 d-none">
            <h5 class="mb-3">Ajouter un produit</h5>
            <form class="d-flex flex-column gap-3" method="post" action="<?= base_url('admin/products/add') ?>" enctype="multipart/form-data">
                <input type="hidden" name="category" value="<?= esc($category) ?>">
                <input type="text" class="form-control" name="name" placeholder="Nom du produit" value="<?= esc($oldInput['name'] ?? '') ?>" required>
                <input type="text" class="form-control" name="price" placeholder="Prix" value="<?= esc($oldInput['price'] ?? '') ?>" required>
                <div>
                    <label class="file-picker-label w-100" for="productImage">
                        Choisir une image depuis la galerie ou les fichiers
                    </label>
                    <input type="file" class="file-picker-input" id="productImage" name="image_file" accept="image/*" required>
                    <div class="file-picker-name mt-2" id="productImageName">Aucune image selectionnee</div>
                </div>
                <input type="text" class="form-control" name="alt" placeholder="Texte alternatif" value="<?= esc($oldInput['alt'] ?? '') ?>">
                <button type="submit" class="btn btn-success align-self-start px-4 py-2">Ajouter sur la liste</button>
            </form>
        </div>
    <?php endif; ?>

    <section class="product-grid">
        <div class="row g-4">
            <?php foreach ($products as $product): ?>
                <div class="col-md-4">
                    <div class="card" id="<?= esc($product['anchor'] ?? 'product-' . $product['id']) ?>">
                        <?php if ($isAdmin): ?>
                            <div class="card-actions">
                                <form method="post" action="<?= base_url('admin/products/delete/' . rawurlencode($category) . '/' . rawurlencode($product['id'])) ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer le produit</button>
                                </form>
                            </div>
                        <?php endif; ?>
                        <?php if (! empty($product['image'])): ?>
                            <img src="<?= base_url($product['image']) ?>" class="card-img-top" alt="<?= esc($product['alt'] ?? $product['name']) ?>">
                        <?php else: ?>
                            <div class="card-placeholder">Image du produit indisponible</div>
                        <?php endif; ?>
                        <div class="card-body text-center p-4">
                            <h5><?= esc($product['name']) ?></h5>
                            <p><?= esc($product['price']) ?></p>
                            <a href="https://wa.me/221770124307?text=<?= rawurlencode($product['whatsapp_message'] ?? '') ?>" class="btn btn-success">Commander sur WhatsApp</a>
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
        const toggle = document.querySelector('.toggle-add-product');
        const form = document.getElementById('addProductForm');
        const imageInput = document.getElementById('productImage');
        const imageName = document.getElementById('productImageName');

        if (toggle && form) {
            toggle.addEventListener('click', function () {
                form.classList.toggle('d-none');
            });
        }

        if (imageInput && imageName) {
            imageInput.addEventListener('change', function () {
                const file = imageInput.files && imageInput.files[0];
                imageName.textContent = file ? file.name : 'Aucune image selectionnee';
            });
        }
    })();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
