<?php
require_once 'includes/session.php';
require_once 'includes/database.php';

$page_title = "Portfolio - Blog Estrie";

// Récupérer tous les projets avec les informations de l'auteur
$stmt = $pdo->query('
    SELECT p.*, u.username 
    FROM projets p 
    LEFT JOIN users u ON p.user_id = u.id 
    ORDER BY p.created_at DESC
');
$projets = $stmt->fetchAll();

require_once 'includes/header.php';
?>

<div class="container mt-4">
    <!-- En-tête -->
    <div class="text-center mb-5">
        <h1 class="display-4 mb-3">
            <i class="fas fa-folder-open text-primary"></i> Mon Portfolio
        </h1>
        <p class="lead text-muted">
            Découvrez mes réalisations et projets de développement web
        </p>
    </div>
    
    <?php if (empty($projets)): ?>
        <!-- Aucun projet -->
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle fa-3x mb-3"></i>
            <h4>Aucun projet pour le moment</h4>
            <p class="mb-0">De nouveaux projets seront bientôt disponibles !</p>
        </div>
    <?php else: ?>
        <!-- Grille de projets -->
        <div class="row">
            <?php foreach ($projets as $projet): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm hover-shadow">
                        <!-- Image -->
                        <?php if ($projet['image']): ?>
                            <img src="/uploads/<?= htmlspecialchars($projet['image']) ?>" 
                                 class="card-img-top" 
                                 alt="<?= htmlspecialchars($projet['titre']) ?>"
                                 style="height: 200px; object-fit: cover;">
                        <?php else: ?>
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                 style="height: 200px;">
                                <i class="fas fa-folder fa-4x text-muted"></i>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Contenu -->
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">
                                <?= htmlspecialchars($projet['titre']) ?>
                            </h5>
                            
                            <!-- Métadonnées -->
                            <div class="text-muted small mb-3">
                                <i class="fas fa-user"></i> <?= htmlspecialchars($projet['username'] ?? 'Anonyme') ?>
                                <span class="mx-1">•</span>
                                <i class="fas fa-calendar"></i> <?= date('d/m/Y', strtotime($projet['created_at'])) ?>
                            </div>
                            
                            <!-- Extrait -->
                            <p class="card-text flex-grow-1">
                                <?= strip_tags(mb_substr($projet['description'], 0, 150)) ?>...
                            </p>
                            
                            <!-- Liens et bouton -->
                            <div class="mt-auto">
                                <!-- Liens GitHub et Démo -->
                                <?php if ($projet['lien_github'] || $projet['lien_demo']): ?>
                                    <div class="mb-2">
                                        <?php if ($projet['lien_github']): ?>
                                            <a href="<?= htmlspecialchars($projet['lien_github']) ?>" 
                                               target="_blank" 
                                               class="btn btn-sm btn-outline-dark me-1"
                                               title="Voir sur GitHub">
                                                <i class="fab fa-github"></i>
                                            </a>
                                        <?php endif; ?>
                                        <?php if ($projet['lien_demo']): ?>
                                            <a href="<?= htmlspecialchars($projet['lien_demo']) ?>" 
                                               target="_blank" 
                                               class="btn btn-sm btn-outline-primary"
                                               title="Voir la démo">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                
                                <!-- Bouton détails -->
                                <a href="/projet.php?slug=<?= urlencode($projet['slug']) ?>" 
                                   class="btn btn-primary w-100">
                                    <i class="fas fa-info-circle"></i> Voir les détails
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Compteur -->
        <div class="mt-4 text-center">
            <p class="text-muted">
                <i class="fas fa-folder-open"></i> 
                <?= count($projets) ?> projet<?= count($projets) > 1 ? 's' : '' ?> réalisé<?= count($projets) > 1 ? 's' : '' ?>
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

---

## 🧪 Test de la page

### **1️⃣ Accéder à la page**
```
http://localhost:8000/projets.php