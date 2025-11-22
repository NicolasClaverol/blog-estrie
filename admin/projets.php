<?php
require_once '../includes/session.php';
require_once '../includes/database.php';

// Protéger la page (admin uniquement)
requireAdmin();

$page_title = "Gestion des projets - Blog Estrie";

// Récupérer tous les projets avec les informations de l'auteur
$stmt = $pdo->query('
    SELECT p.*, u.username 
    FROM projets p 
    LEFT JOIN users u ON p.user_id = u.id 
    ORDER BY p.created_at DESC
');
$projets = $stmt->fetchAll();

// Afficher le message flash s'il existe
$flash = getFlashMessage();

require_once '../includes/header.php';
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-folder-open"></i> Gestion des projets</h1>
        <a href="/admin/create_projet.php" class="btn btn-success">
            <i class="fas fa-plus"></i> Nouveau projet
        </a>
    </div>
    
    <?php if ($flash): ?>
        <div class="alert alert-<?= $flash['type'] ?> alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($flash['message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    
    <?php if (empty($projets)): ?>
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i>
            Aucun projet pour le moment. 
            <a href="/admin/create_projet.php" class="alert-link">Créez votre premier projet !</a>
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
                                <th>Liens</th>
                                <th>Auteur</th>
                                <th>Date de création</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($projets as $projet): ?>
                                <tr>
                                    <td><?= $projet['id'] ?></td>
                                    <td>
                                        <?php if ($projet['image']): ?>
                                            <img src="/uploads/<?= htmlspecialchars($projet['image']) ?>" 
                                                 alt="<?= htmlspecialchars($projet['titre']) ?>"
                                                 style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                                        <?php else: ?>
                                            <div style="width: 60px; height: 60px; background: #e9ecef; display: flex; align-items: center; justify-content: center; border-radius: 4px;">
                                                <i class="fas fa-folder text-muted"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <strong><?= htmlspecialchars($projet['titre']) ?></strong>
                                        <br>
                                        <small class="text-muted">
                                            <i class="fas fa-link"></i> 
                                            <?= htmlspecialchars($projet['slug']) ?>
                                        </small>
                                    </td>
                                    <td>
                                        <?php if ($projet['lien_github']): ?>
                                            <a href="<?= htmlspecialchars($projet['lien_github']) ?>" 
                                               target="_blank" 
                                               class="btn btn-sm btn-outline-dark me-1"
                                               title="GitHub">
                                                <i class="fab fa-github"></i>
                                            </a>
                                        <?php endif; ?>
                                        <?php if ($projet['lien_demo']): ?>
                                            <a href="<?= htmlspecialchars($projet['lien_demo']) ?>" 
                                               target="_blank" 
                                               class="btn btn-sm btn-outline-primary"
                                               title="Démo">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($projet['username'] ?? 'Inconnu') ?></td>
                                    <td>
                                        <?= date('d/m/Y à H:i', strtotime($projet['created_at'])) ?>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="/projet.php?slug=<?= urlencode($projet['slug']) ?>" 
                                               class="btn btn-outline-info" 
                                               title="Voir le projet"
                                               target="_blank">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="/admin/edit_projet.php?id=<?= $projet['id'] ?>" 
                                               class="btn btn-outline-primary" 
                                               title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="/admin/delete_projet.php?id=<?= $projet['id'] ?>" 
                                               class="btn btn-outline-danger" 
                                               title="Supprimer"
                                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?');">
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
                Total : <strong><?= count($projets) ?></strong> projet(s)
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
```

---

## 🧪 Test de la page

### **Accède à la page**
```
http://localhost:8000/admin/projets.php