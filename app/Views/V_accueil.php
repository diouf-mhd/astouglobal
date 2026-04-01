<?php
$success = session()->getFlashdata('success');
$error = $error ?? session()->getFlashdata('error');
$validation = $validation ?? session()->getFlashdata('validation');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Astou Global Business</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --page-bg: #eef4ff;
            --surface: #ffffff;
            --surface-soft: rgba(255, 255, 255, 0.82);
            --nav-bg: #0d3b8e;
            --primary: #1f6bff;
            --primary-dark: #1147b7;
            --text-main: #14305f;
            --text-muted: #55709f;
            --shadow-soft: 0 18px 40px rgba(17, 71, 183, 0.12);
            --shadow-card: 0 14px 32px rgba(20, 48, 95, 0.12);
        }

        body {
            background:
                radial-gradient(circle at top left, rgba(31, 107, 255, 0.14), transparent 28%),
                linear-gradient(180deg, #f7faff 0%, var(--page-bg) 100%);
            color: var(--text-main);
            scroll-behavior: smooth;
        }

        .bg-light {
            background: linear-gradient(135deg, #ffffff, #e7f0ff) !important;
            border-bottom: 1px solid rgba(31, 107, 255, 0.08);
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
            padding: 0.65rem 0.95rem;
            border-radius: 999px;
            transition: background-color 0.25s ease, color 0.25s ease, transform 0.25s ease;
        }

        .navbar-nav .nav-link.admin {
            background: linear-gradient(135deg, #ff8a3c, #ff5131);
            color: #fff;
            box-shadow: 0 12px 24px rgba(255, 81, 49, 0.35);
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link:focus {
            color: #fff;
            background: rgba(255, 255, 255, 0.14);
            transform: translateY(-1px);
        }

        .navbar {
            background: linear-gradient(135deg, var(--nav-bg), #082a6b) !important;
            box-shadow: 0 10px 28px rgba(8, 42, 107, 0.28);
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        .product-section {
            padding: 2rem;
            margin-top: 3rem;
            border-radius: 28px;
            position: relative;
            overflow: hidden;
            background-size: cover;
            background-position: center;
            box-shadow: var(--shadow-soft);
        }

        .product-section::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.62), rgba(231, 240, 255, 0.8));
        }

        .product-section > * {
            position: relative;
            z-index: 1;
        }

        .section-title {
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .section-title h2 {
            margin-bottom: 0.5rem;
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .section-title p {
            margin: 0;
            color: var(--text-muted);
        }

        .section-vetements {
            background-image: url('<?= base_url('assets/img/HF2.jpeg') ?>');
        }

        .section-dialabe {
            background-image: url('<?= base_url('assets/img/jalabe2.jpg') ?>');
        }

        .section-chaussures {
            background-image: url('<?= base_url('assets/img/C2.jpeg') ?>');
        }

        .section-parfums {
            background-image: url('<?= base_url('assets/img/blue_chanel.jpg') ?>');
        }

        .card {
            height: 100%;
            overflow: hidden;
            border: 0;
            border-radius: 22px;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: var(--shadow-card);
            transition: transform 0.28s ease, box-shadow 0.28s ease;
        }


        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 22px 42px rgba(20, 48, 95, 0.18);
        }

        .card-image-wrapper {
            position: relative;
            overflow: hidden;
            background: linear-gradient(180deg, #f4f8ff, #dfeaff);
        }

        .card-img-top {
            width: 100%;
            height: 280px;
            object-fit: cover;
            display: block;
            transition: transform 0.35s ease, object-fit 0.35s ease;
        }

        .card:hover .card-img-top,
        .card:focus-within .card-img-top,
        .card-image-wrapper:active .card-img-top {
            object-fit: contain;
            transform: scale(1.05);
        }

        .card-body h5 {
            color: var(--text-main);
            font-weight: 700;
        }

        .card-body p {
            color: var(--text-muted);
            font-weight: 600;
        }

        .btn-success {
            background: linear-gradient(135deg, var(--primary), #49a2ff);
            border: 0;
            border-radius: 999px;
            padding: 0.85rem 1.35rem;
            font-weight: 700;
            letter-spacing: 0.01em;
            box-shadow: 0 14px 28px rgba(31, 107, 255, 0.28);
            transition: transform 0.25s ease, box-shadow 0.25s ease, background 0.25s ease;
        }

        .btn-success:hover,
        .btn-success:focus {
            background: linear-gradient(135deg, #2f7dff, var(--primary-dark));
            transform: translateY(-2px);
            box-shadow: 0 18px 32px rgba(17, 71, 183, 0.34);
        }

        .btn-success:active {
            transform: translateY(0);
            box-shadow: 0 10px 20px rgba(17, 71, 183, 0.24);
        }

        footer.bg-light {
            background: transparent !important;
            border-top: 1px solid rgba(31, 107, 255, 0.1);
        }

        .category-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-top: 0.75rem;
            text-decoration: none;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <img src="<?=base_url('assets/img/logo1.jpeg')?>" width="50">
       <!-- <a class="navbar-brand mb-0 h1" href="<?= base_url('/') ?>">Astou Global SHOP</a>-->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Ouvrir la navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="<?= base_url('/') ?>">Accueil</a>
                <a class="nav-link" href="<?= base_url('vetements') ?>">Vetement</a>
                <a class="nav-link" href="<?= base_url('homme') ?>">Homme</a>
                <a class="nav-link" href="<?= base_url('jalabe') ?>">Jalabe</a>
                <a class="nav-link" href="<?= base_url('chaussures') ?>">Chaussures</a>
                <a class="nav-link" href="<?= base_url('parfum') ?>">Parfum</a>
                <a class="nav-link admin" href="<?= base_url('admin') ?>">Admin</a>
            </div>
        </div>
    </div>
</nav>
   
<?php if ($success): ?>
    <div class="container mt-4">
        <div class="alert alert-success"><?= esc($success) ?></div>
    </div>
<?php endif; ?>

<?php if(isset($validation)): ?>
    <div class="alert alert-danger">
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>

<?php if(isset($error)): ?>
    <div class="alert alert-danger">
        <?= $error ?>
    </div>
<?php endif; ?>


<div id="accueil" class="bg-light p-5 text-center">
    <h1>Bienvenue sur ma boutique</h1>
    <p>Vetements tendance + services digitaux</p>
</div>

<div id="vetements" class="container product-section section-vetements">
    <div class="section-title">
            <h2>Vetements</h2>
            <p>Des ensembles modernes et elegants pour donner du style a votre boutique.</p>
            <a href="<?= base_url('vetements') ?>" class="btn btn-success category-link">Voir toute la vue Vetement</a>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-image-wrapper">
                    <img src="<?= base_url('assets/img/HF1.jpeg') ?>" class="card-img-top" alt="Ensemble chemise et robe">
                </div>
                <div class="card-body text-center">
                    <h5>Ensemble chemise et robe</h5>
                    <p>6 000 FCFA</p>
                    <a href="https://wa.me/221770124307?text=Bonjour%2C%20je%20veux%20commander%20%3A%20Ensemble%20chemise%20et%20robe.%0APrix%20%3A%206%20000%20FCFA." class="btn btn-success">Commander WhatsApp</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-image-wrapper">
                    <img src="<?= base_url('assets/img/HF2.jpeg') ?>" class="card-img-top" alt="Ensemble chemise et pantalon">
                </div>
                <div class="card-body text-center">
                    <h5>Ensemble chemise et pantalon</h5>
                    <p>6 000 FCFA</p>
                    <a href="https://wa.me/221770124307?text=Bonjour%2C%20je%20veux%20commander%20%3A%20Ensemble%20chemise%20et%20pantalon.%0APrix%20%3A%206%20000%20FCFA." class="btn btn-success">Commander WhatsApp</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-image-wrapper">
                    <img src="<?= base_url('assets/img/HF3.jpeg') ?>" class="card-img-top" alt="Ensemble robe et manteau">
                </div>
                <div class="card-body text-center">
                    <h5>Ensemble robe et manteau</h5>
                    <p>6 000 FCFA</p>
                    <a href="https://wa.me/221770124307?text=Bonjour%2C%20je%20veux%20commander%20%3A%20Ensemble%20robe%20et%20manteau.%0APrix%20%3A%206%20000%20FCFA." class="btn btn-success">Commander WhatsApp</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="dialabe" class="container product-section section-dialabe">
    <div class="section-title">
            <h2>Dialabe</h2>
            <p>Une selection traditionnelle chic, ideale pour les grandes occasions et le quotidien.</p>
            <a href="<?= base_url('jalabe') ?>" class="btn btn-success category-link">Voir toute la vue Jalabe</a>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-image-wrapper">
                    <img src="<?= base_url('assets/img/jalabe2.jpg') ?>" class="card-img-top" alt="Dialabe modele 1">
                </div>
                <div class="card-body text-center">
                    <h5>Ensemble chemise et robe</h5>
                    <p>9 000 FCFA</p>
                    <a href="https://wa.me/221770124307?text=Bonjour%2C%20je%20veux%20commander%20%3A%20Ensemble%20chemise%20et%20robe.%0APrix%20%3A%209%20000%20FCFA." class="btn btn-success">Commander WhatsApp</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-image-wrapper">
                    <img src="<?= base_url('assets/img/HF4.jpeg') ?>" class="card-img-top" alt="Dialabe modele 2">
                </div>
                <div class="card-body text-center">
                    <h5>Dialabe</h5>
                    <p>12 000 FCFA</p>
                    <a href="https://wa.me/221770124307?text=Bonjour%2C%20je%20veux%20commander%20%3A%20Dialabe.%0APrix%20%3A%2012%20000%20FCFA." class="btn btn-success">Commander WhatsApp</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-image-wrapper">
                    <img src="<?= base_url('assets/img/dialabe.jpg') ?>" class="card-img-top" alt="Dialabe modele 3">
                </div>
                <div class="card-body text-center">
                    <h5>Dialabe</h5>
                    <p>6 000 FCFA</p>
                    <a href="https://wa.me/221770124307?text=Bonjour%2C%20je%20veux%20commander%20%3A%20Dialabe.%0APrix%20%3A%206%20000%20FCFA." class="btn btn-success">Commander WhatsApp</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="chaussures" class="container product-section section-chaussures">
    <div class="section-title">
            <h2>Nos Chaussures</h2>
            <p>Des modeles feminins et tendances pour completer chaque tenue avec caractere.</p>
            <a href="<?= base_url('chaussures') ?>" class="btn btn-success category-link">Voir toute la vue Chaussures</a>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-image-wrapper">
                    <img src="<?= base_url('assets/img/C1.jpeg') ?>" class="card-img-top" alt="Chaussures femme">
                </div>
                <div class="card-body text-center">
                    <h5>Chaussures femme</h5>
                    <p>2 500 FCFA</p>
                    <a href="https://wa.me/221770124307?text=Bonjour%2C%20je%20veux%20commander%20%3A%20Chaussures%20femme.%0APrix%20%3A%202%20500%20FCFA." class="btn btn-success">Commander WhatsApp</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-image-wrapper">
                    <img src="<?= base_url('assets/img/C2.jpeg') ?>" class="card-img-top" alt="Modele pieds nus">
                </div>
                <div class="card-body text-center">
                    <h5>Modele pieds nus</h5>
                    <p>2 500 FCFA</p>
                    <a href="https://wa.me/221770124307?text=Bonjour%2C%20je%20veux%20commander%20%3A%20Modele%20pieds%20nus.%0APrix%20%3A%2015%20000%20FCFA." class="btn btn-success">Commander WhatsApp</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-image-wrapper">
                    <img src="<?= base_url('assets/img/C3.jpeg') ?>" class="card-img-top" alt="Chaussures classiques">
                </div>
                <div class="card-body text-center">
                    <h5>Chaussures classiques</h5>
                    <p> 2 500 FCFA</p>
                    <a href="https://wa.me/221770124307?text=Bonjour%2C%20je%20veux%20commander%20%3A%20Chaussures%20classiques.%0APrix%20%3A%2020%20000%20FCFA." class="btn btn-success">Commander WhatsApp</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="parfums" class="container product-section section-parfums">
    <div class="section-title">
            <h2>Nos Parfums</h2>
            <p>Des fragrances marquees et elegantes pour laisser une impression durable.</p>
            <a href="<?= base_url('parfum') ?>" class="btn btn-success category-link">Voir toute la vue Parfum</a>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-image-wrapper">
                    <img src="<?= base_url('assets/img/P1.jpeg') ?>" class="card-img-top" alt="Liquid Brun">
                </div>
                <div class="card-body text-center">
                    <h5>Liquid Brun</h5>
                    <p>8 000 FCFA</p>
                    <a href="https://wa.me/221770124307?text=Bonjour%2C%20je%20veux%20commander%20%3A%20Liquid%20Brun.%0APrix%20%3A%2010%20000%20FCFA." class="btn btn-success">Commander WhatsApp</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-image-wrapper">
                    <img src="<?= base_url('assets/img/P2.jpeg') ?>" class="card-img-top" alt="Jean Lowe noir">
                </div>
                <div class="card-body text-center">
                    <h5>Jean Lowe noir</h5>
                    <p>8 000 FCFA</p>
                    <a href="https://wa.me/221770124307?text=Bonjour%2C%20je%20veux%20commander%20%3A%20Jean%20Lowe%20noir.%0APrix%20%3A%2015%20000%20FCFA." class="btn btn-success">Commander WhatsApp</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-image-wrapper">
                    <img src="<?= base_url('assets/img/blue_chanel.jpg') ?>" class="card-img-top" alt="Blue Chanel">
                </div>
                <div class="card-body text-center">
                    <h5>Blue Chanel</h5>
                    <p>6 000 FCFA</p>
                    <a href="https://wa.me/221770124307?text=Bonjour%2C%20je%20veux%20commander%20%3A%20Blue%20Chanel.%0APrix%20%3A%2020%20000%20FCFA." class="btn btn-success">Commander WhatsApp</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-dark text-white p-5 mt-5">
    <div class="container" style="max-width: 900px;">
        <div class="row justify-content-center align-items-start g-4">
            <div class="col-md-5 text-center text-md-start">
                <h2>Mes Services</h2>
                <p>Je suis developpeur freelance specialise en :</p>

                <ul class="list-unstyled mb-3">
                    <li>Creation de sites web</li>
                    <li>Applications de gestion</li>
                    <li>Optimisation digitale</li>
                </ul>

                <a href="https://wa.me/221777119298?text=Bonjour je suis interesse par vos services web" class="btn btn-success mt-2">Me contacter sur WhatsApp</a>
            </div>

            <div class="col-md-5 text-center text-md-start">
                <p class="mb-2"><strong>ASTOU GLOBAL BUSINESS</strong></p>
                <p class="mb-2">Adresse : DAKAR/SEBIKOTANE</p>
                <p class="mb-0">Contact : 770124307</p>
            </div>
        </div>
        <div class="text-center mt-4 pt-2 border-top border-secondary-subtle">
            <p class="mb-0">&copy; 2026 junior ndiaye tout reserver</p>
        </div>
    </div>
</div>

<footer class="text-center p-3 bg-light">
    <p class="mb-0">ASTOU GLOBAL BUSINESS</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
