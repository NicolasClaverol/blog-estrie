<?php
require_once '../includes/session.php';
require_once '../includes/database.php';

// Protéger la page (admin uniquement)
requireAdmin();

$page_title = "Gestion des articles - Blog Estrie";

// Récupérer tous les articles avec les informations de l'auteur
$stmt = $pdo->query('
    SELECT a.*, u.username 
    FROM articles a 
    LEFT JOIN users u ON a.user_id = u.id 
    ORDER BY a.created_at DESC
');
$articles = $stmt->fetchAll();

// Afficher le message flash s'il existe
$flash = getFlashMessage();

require_once '../includes/header.php';
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-newspaper"></i> Gestion des articles</h1>
        <a href="/admin/create_article.php" class="btn btn-success">
            <i class="fas fa-plus"></i> Nouvel article
        </a>
    </div>
    
    <?php if ($flash): ?>
        <div class="alert alert-<?= $flash['type'] ?> alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($flash['message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    
    <?php if (empty($articles)): ?>
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i>
            Aucun article pour le moment. 
            <a href="/admin/create_article.php" class="alert-link">Créez votre premier article !</a>
        </div>
    <?php else: ?>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Titre</th>
                                <th>Auteur</th>
                                <th>Date de création</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($articles as $article): ?>
                                <tr>
                                    <td><?= $article['id'] ?></td>
                                    <td>
                                        <?php if ($article['image']): ?>
                                            <img src="/uploads/<?= htmlspecialchars($article['image']) ?>" 
                                                 alt="<?= htmlspecialchars($article['titre']) ?>"
                                                 style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                                        <?php else: ?>
                                            <div style="width: 60px; height: 60px; background: #e9ecef; display: flex; align-items: center; justify-content: center; border-radius: 4px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <strong><?= htmlspecialchars($article['titre']) ?></strong>
                                        <br>
                                        <small class="text-muted">
                                            <i class="fas fa-link"></i> 
                                            <?= htmlspecialchars($article['slug']) ?>
                                        </small>
                                    </td>
                                    <td><?= htmlspecialchars($article['username'] ?? 'Inconnu') ?></td>
                                    <td>
                                        <?= date('d/m/Y à H:i', strtotime($article['created_at'])) ?>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="/article.php?slug=<?= urlencode($article['slug']) ?>" 
                                               class="btn btn-outline-info" 
                                               title="Voir l'article"
                                               target="_blank">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="/admin/edit_article.php?id=<?= $article['id'] ?>" 
                                               class="btn btn-outline-primary" 
                                               title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="/admin/delete_article.php?id=<?= $article['id'] ?>" 
                                               class="btn btn-outline-danger" 
                                               title="Supprimer"
                                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="mt-3">
            <p class="text-muted">
                <i class="fas fa-info-circle"></i> 
                Total : <strong><?= count($articles) ?></strong> article(s)
            </p>
        </div>
    <?php endif; ?>
    
    <div class="mt-4">
        <a href="/admin/dashboard.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Retour au dashboard
        </a>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>


