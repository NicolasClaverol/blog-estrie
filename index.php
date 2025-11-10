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
            <a href="articles.php" class="btn btn-light btn-lg px-4 gap-3">
                <i class="fas fa-newspaper"></i> Découvrir les articles
            </a>
            <a href="projets.php" class="btn btn-outline-light btn-lg px-4">
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
        <div class="col-md-6">
            <img src="assets/images/estrie-placeholder.jpg" 
                 alt="Paysage de l'Estrie" 
                 class="img-fluid rounded shadow"
                 onerror="this.src='https://via.placeholder.com/600x400/2C5F2D/FFFFFF?text=Estrie'">
        </div>
    </div>
</section>

<!-- Section Articles récents -->
<section class="bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-5">Articles récents</h2>
        <div class="row">
            <!-- Les articles seront affichés ici dynamiquement plus tard -->
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/400x250/2C5F2D/FFFFFF?text=Article+1" 
                         class="card-img-top" alt="Article">
                    <div class="card-body">
                        <h5 class="card-title">Article à venir</h5>
                        <p class="card-text">
                            Les articles apparaîtront ici une fois que vous en aurez créé.
                        </p>
                        <a href="#" class="btn btn-primary">Lire la suite</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
```

