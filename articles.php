<?php
require_once 'includes/session.php';
require_once 'includes/database.php';

$page_title = "Articles - Blog Estrie";

// Récupérer tous les articles avec les informations de l'auteur
$stmt = $pdo->query('
    SELECT a.*, u.username 
    FROM articles a 
    LEFT JOIN users u ON a.user_id = u.id 
    ORDER BY a.created_at DESC
');
$articles = $stmt->fetchAll();

require_once 'includes/header.php';
?>

<div class="container mt-4">
    <!-- En-tête -->
    <div class="text-center mb-5">
        <h1 class="display-4 mb-3">
            <i class="fas fa-newspaper text-primary"></i> Articles
        </h1>
        <p class="lead text-muted">
            Découvrez l'Estrie et ses merveilles à travers mes articles
        </p>
    </div>
    
    <?php if (empty($articles)): ?>
        <!-- Aucun article -->
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle fa-3x mb-3"></i>
            <h4>Aucun article pour le moment</h4>
            <p class="mb-0">Revenez bientôt pour découvrir nos premiers articles sur l'Estrie !</p>
        </div>
    <?php else: ?>
        <!-- Grille d'articles -->
        <div class="row">
            <?php foreach ($articles as $article): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm hover-shadow">
                        <!-- Image -->
                        <?php if ($article['image']): ?>
                            <img src="/uploads/<?= htmlspecialchars($article['image']) ?>" 
                                 class="card-img-top" 
                                 alt="<?= htmlspecialchars($article['titre']) ?>"
                                 style="height: 200px; object-fit: cover;">
                        <?php else: ?>
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                 style="height: 200px;">
                                <i class="fas fa-mountain fa-4x text-muted"></i>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Contenu -->
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">
                                <?= htmlspecialchars($article['titre']) ?>
                            </h5>
                            
                            <!-- Métadonnées -->
                            <div class="text-muted small mb-3">
                                <i class="fas fa-user"></i> <?= htmlspecialchars($article['username'] ?? 'Anonyme') ?>
                                <span class="mx-1">•</span>
                                <i class="fas fa-calendar"></i> <?= date('d/m/Y', strtotime($article['created_at'])) ?>
                            </div>
                            
                            <!-- Extrait -->
                            <p class="card-text flex-grow-1">
                                <?= strip_tags(mb_substr($article['contenu'], 0, 150)) ?>...
                            </p>
                            
                            <!-- Bouton -->
                            <a href="/article.php?slug=<?= urlencode($article['slug']) ?>" 
                               class="btn btn-primary mt-auto">
                                <i class="fas fa-book-open"></i> Lire l'article
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Compteur -->
        <div class="mt-4 text-center">
            <p class="text-muted">
                <i class="fas fa-newspaper"></i> 
                <?= count($articles) ?> article<?= count($articles) > 1 ? 's' : '' ?> publié<?= count($articles) > 1 ? 's' : '' ?>
            </p>
        </div>
    <?php endif; ?>
</div>

<!-- Styles personnalisés -->
<style>
.hover-shadow {
    transition: all 0.3s ease;
}

.hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 1rem 3rem rgba(0,0,0,.175) !important;
}

.card-img-top {
    transition: all 0.3s ease;
}

.card:hover .card-img-top {
    transform: scale(1.05);
}

.card {
    overflow: hidden;
}
</style>

<?php require_once 'includes/footer.php'; ?>
```