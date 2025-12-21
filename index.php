<?php
$page_title = "Accueil - Blog Estrie";
require_once 'includes/header.php';
?>

<!-- Hero Section -->
<section class="bg-primary text-white text-center py-5">
    <div class="container">
        <h1 class="display-3 fw-bold mb-3">
            <i class="fas fa-mountain"></i> Bienvenue en Estrie
        </h1>
        <p class="lead mb-4">
            Découvrez les paysages magnifiques, les villages pittoresques et les aventures 
            inoubliables de la région de Sherbrooke
        </p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <a href="/articles.php" class="btn btn-light btn-lg px-4 gap-3">
                <i class="fas fa-newspaper"></i> Découvrir les articles
            </a>
            <a href="/projets.php" class="btn btn-outline-light btn-lg px-4">
                <i class="fas fa-folder-open"></i> Voir les projets
            </a>
        </div>
    </div>
</section>

<!-- Section À propos -->
<section class="container my-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h2 class="mb-4">À propos de ce blog</h2>
            <p class="lead">
                Passionné par les beautés naturelles de l'Estrie, j'ai créé ce blog 
                pour partager mes découvertes et mes expériences dans cette magnifique région.
            </p>
            <p>
                De Sherbrooke aux Cantons-de-l'Est, en passant par les montagnes et les lacs, 
                l'Estrie regorge de trésors à découvrir. Que vous soyez amateur de randonnée, 
                de gastronomie ou simplement à la recherche de beaux paysages, vous trouverez 
                ici de l'inspiration pour vos prochaines aventures.
            </p>
        </div>
        <div class="col-md-6 text-center">
            <!-- Fleur de lys du Québec -->
            <div class="p-5">
                <img src="/assets/images/fleur-de-lys.svg" 
                     alt="Fleur de lys du Québec" 
                     style="max-width: 300px; height: auto; filter: drop-shadow(2px 2px 8px rgba(0,0,0,0.15));">
                    <h3 class="mt-4" style="color: #003399;">Québec</h3>
                <p class="text-muted mb-0">La Belle Province</p>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>