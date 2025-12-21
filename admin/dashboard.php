<?php
require_once '../includes/session.php';
require_once '../includes/database.php';

// Protéger la page
requireAdmin();

$page_title = "Tableau de bord - Blog Estrie";

require_once '../includes/header.php';
?>

<div class="container mt-5">
    <h1 class="mb-4"><i class="fas fa-tachometer-alt"></i> Tableau de bord administrateur</h1>
    
    <div class="alert alert-info">
        <strong><i class="fas fa-user-shield"></i> Bienvenue <?= htmlspecialchars(getUsername()) ?> !</strong>
        <p class="mb-0">Vous êtes connecté en tant qu'administrateur. Accédez à toutes les fonctionnalités de gestion.</p>
    </div>
    
    <div class="row mt-4">
        <!-- Articles -->
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-newspaper fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Articles</h5>
                    <p class="card-text">Gérer vos articles de blog</p>
                    <a href="/admin/articles.php" class="btn btn-primary">
                        <i class="fas fa-cog"></i> Gérer les articles
                    </a>
                    <a href="/articles.php" class="btn btn-outline-info mt-2" target="_blank">
                        <i class="fas fa-eye"></i> Voir sur le site
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Projets -->
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-folder-open fa-3x text-success mb-3"></i>
                    <h5 class="card-title">Projets</h5>
                    <p class="card-text">Gérer votre portfolio</p>
                    <a href="/admin/projets.php" class="btn btn-success">
                        <i class="fas fa-cog"></i> Gérer les projets
                    </a>
                    <a href="/projets.php" class="btn btn-outline-info mt-2" target="_blank">
                        <i class="fas fa-eye"></i> Voir sur le site
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Profil -->
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-user fa-3x text-warning mb-3"></i>
                    <h5 class="card-title">Mon Profil</h5>
                    <p class="card-text">Gérer vos informations</p>
                    <a href="/profile.php" class="btn btn-warning">
                        <i class="fas fa-user-edit"></i> Modifier mon profil
                    </a>
                    <a href="/logout.php" class="btn btn-outline-danger mt-2">
                        <i class="fas fa-sign-out-alt"></i> Se déconnecter
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Statistiques rapides -->
    <div class="row mt-4">
        <div class="col-12">
            <h3><i class="fas fa-chart-bar"></i> Aperçu rapide</h3>
        </div>
        
        <?php
        // Compter les articles
        $stmt = $pdo->query('SELECT COUNT(*) FROM articles');
        $nb_articles = $stmt->fetchColumn();
        
        // Compter les projets
        $stmt = $pdo->query('SELECT COUNT(*) FROM projets');
        $nb_projets = $stmt->fetchColumn();
        
        // Compter les utilisateurs
        $stmt = $pdo->query('SELECT COUNT(*) FROM users');
        $nb_users = $stmt->fetchColumn();
        ?>
        
        <div class="col-md-4 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-newspaper"></i> Articles</h5>
                    <p class="card-text display-4"><?= $nb_articles ?></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-folder-open"></i> Projets</h5>
                    <p class="card-text display-4"><?= $nb_projets ?></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-users"></i> Utilisateurs</h5>
                    <p class="card-text display-4"><?= $nb_users ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>