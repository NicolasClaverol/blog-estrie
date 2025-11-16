<?php
require_once 'includes/session.php';
require_once 'includes/database.php';

// Récupérer le slug depuis l'URL
$slug = $_GET['slug'] ?? '';

if (empty($slug)) {
    header('Location: /index.php');
    exit;
}

// Récupérer l'article avec les informations de l'auteur
$stmt = $pdo->prepare('
    SELECT a.*, u.username 
    FROM articles a 
    LEFT JOIN users u ON a.user_id = u.id 
    WHERE a.slug = ?
');
$stmt->execute([$slug]);
$article = $stmt->fetch();

// Si l'article n'existe pas, rediriger
if (!$article) {
    header('Location: /index.php');
    exit;
}

$page_title = htmlspecialchars($article['titre']) . " - Blog Estrie";

require_once 'includes/header.php';
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/index.php">Accueil</a></li>
                    <li class="breadcrumb-item active"><?= htmlspecialchars($article['titre']) ?></li>
                </ol>
            </nav>
            
            <!-- Article -->
            <article class="mb-5">
                <!-- Titre -->
                <h1 class="mb-3"><?= htmlspecialchars($article['titre']) ?></h1>
                
                <!-- Métadonnées -->
                <div class="text-muted mb-4">
                    <i class="fas fa-user"></i> Par <strong><?= htmlspecialchars($article['username'] ?? 'Anonyme') ?></strong>
                    <span class="mx-2">|</span>
                    <i class="fas fa-calendar"></i> <?= date('d/m/Y', strtotime($article['created_at'])) ?>
                    <?php if ($article['updated_at'] != $article['created_at']): ?>
                        <span class="mx-2">|</span>
                        <i class="fas fa-edit"></i> Modifié le <?= date('d/m/Y', strtotime($article['updated_at'])) ?>
                    <?php endif; ?>
                </div>
                
                <!-- Image de couverture -->
                <?php if ($article['image']): ?>
                    <div class="mb-4">
                        <img src="/uploads/<?= htmlspecialchars($article['image']) ?>" 
                             alt="<?= htmlspecialchars($article['titre']) ?>"
                             class="img-fluid rounded shadow">
                    </div>
                <?php endif; ?>
                
                <!-- Contenu -->
                <div class="article-content">
                    <?= nl2br(htmlspecialchars($article['contenu'])) ?>
                </div>
            </article>
            
            <hr>
            
            <!-- Boutons d'action pour les admins -->
            <?php if (isAdmin()): ?>
                <div class="alert alert-info">
                    <strong><i class="fas fa-user-shield"></i> Actions administrateur :</strong>
                    <div class="mt-2">
                        <a href="/admin/edit_article.php?id=<?= $article['id'] ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Modifier cet article
                        </a>
                        <a href="/admin/articles.php" class="btn btn-secondary btn-sm">
                            <i class="fas fa-list"></i> Retour à la gestion
                        </a>
                    </div>
                </div>
            <?php endif; ?>
            
            <!-- Bouton retour -->
            <div class="mt-4">
                <a href="/index.php" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Retour à l'accueil
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Ajouter des styles pour le contenu de l'article -->
<style>
.article-content {
    font-size: 1.1rem;
    line-height: 1.8;
    text-align: justify;
}

.article-content p {
    margin-bottom: 1.5rem;
}
</style>

<?php require_once 'includes/footer.php'; ?>
