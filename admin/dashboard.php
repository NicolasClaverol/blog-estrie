<?php
require_once '../includes/session.php';
require_once '../includes/database.php';

// Protéger la page
requireLogin();

require_once '../includes/header.php';
?>

<div class="container mt-5">
    <h1 class="mb-4">Tableau de bord administrateur</h1>
    
    <div class="alert alert-info">
        <strong>Bienvenue <?= htmlspecialchars(getUsername()) ?> !</strong>
        <p class="mb-0">Cette zone est réservée aux utilisateurs connectés.</p>
    </div>
    
    <div class="row mt-4">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Articles</h5>
                    <p class="card-text">Gérer vos articles de blog</p>
                    <a href="#" class="btn btn-success">Voir les articles</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Profil</h5>
                    <p class="card-text">Modifier vos informations</p>
                    <a href="/profile.php" class="btn btn-success">Mon profil</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Déconnexion</h5>
                    <p class="card-text">Quitter votre session</p>
                    <a href="/logout.php" class="btn btn-outline-danger">Se déconnecter</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>