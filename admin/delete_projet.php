<?php
require_once '../includes/session.php';
require_once '../includes/database.php';

// Protéger la page (admin uniquement)
requireAdmin();

// Récupérer l'ID du projet
$projet_id = $_GET['id'] ?? 0;

if (empty($projet_id)) {
    setFlashMessage("Aucun projet spécifié.", "danger");
    header('Location: /admin/projets.php');
    exit;
}

// Récupérer le projet
$stmt = $pdo->prepare('SELECT * FROM projets WHERE id = ?');
$stmt->execute([$projet_id]);
$projet = $stmt->fetch();

if (!$projet) {
    setFlashMessage("Projet introuvable.", "danger");
    header('Location: /admin/projets.php');
    exit;
}

// Si confirmation (POST), supprimer le projet
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Supprimer l'image si elle existe
    if ($projet['image'] && file_exists('../uploads/' . $projet['image'])) {
        unlink('../uploads/' . $projet['image']);
    }
    
    // Supprimer le projet de la base de données
    $stmt = $pdo->prepare('DELETE FROM projets WHERE id = ?');
    $stmt->execute([$projet_id]);
    
    setFlashMessage("Projet supprimé avec succès !", "success");
    header('Location: /admin/projets.php');
    exit;
}

$page_title = "Supprimer un projet - Blog Estrie";
require_once '../includes/header.php';
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1><i class="fas fa-trash text-danger"></i> Supprimer un projet</h1>
                <a href="/admin/projets.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour à la liste
                </a>
            </div>
            
            <div class="alert alert-danger">
                <h4 class="alert-heading">
                    <i class="fas fa-exclamation-triangle"></i> Attention !
                </h4>
                <p>Vous êtes sur le point de supprimer définitivement ce projet.</p>
                <hr>
                <p class="mb-0">
                    <strong>Cette action est irréversible !</strong> 
                    Le projet et son image seront supprimés du serveur.
                </p>
            </div>
            
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Projet à supprimer :</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php if ($projet['image']): ?>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <img src="/uploads/<?= htmlspecialchars($projet['image']) ?>" 
                                     alt="<?= htmlspecialchars($projet['titre']) ?>"
                                     class="img-fluid rounded shadow-sm">
                            </div>
                            <div class="col-md-8">
                        <?php else: ?>
                            <div class="col-12">
                        <?php endif; ?>
                                <h3><?= htmlspecialchars($projet['titre']) ?></h3>
                                <p class="text-muted">
                                    <i class="fas fa-link"></i> 
                                    <strong>Slug :</strong> <?= htmlspecialchars($projet['slug']) ?>
                                </p>
                                <p class="text-muted">
                                    <i class="fas fa-calendar"></i> 
                                    <strong>Créé le :</strong> <?= date('d/m/Y à H:i', strtotime($projet['created_at'])) ?>
                                </p>
                                <?php if ($projet['updated_at'] != $projet['created_at']): ?>
                                    <p class="text-muted">
                                        <i class="fas fa-edit"></i> 
                                        <strong>Modifié le :</strong> <?= date('d/m/Y à H:i', strtotime($projet['updated_at'])) ?>
                                    </p>
                                <?php endif; ?>
                                
                                <!-- Liens -->
                                <?php if ($projet['lien_github'] || $projet['lien_demo']): ?>
                                    <p class="text-muted mb-2">
                                        <strong>Liens :</strong>
                                    </p>
                                    <div class="mb-3">
                                        <?php if ($projet['lien_github']): ?>
                                            <a href="<?= htmlspecialchars($projet['lien_github']) ?>" 
                                               target="_blank" 
                                               class="btn btn-sm btn-outline-dark me-2">
                                                <i class="fab fa-github"></i> GitHub
                                            </a>
                                        <?php endif; ?>
                                        <?php if ($projet['lien_demo']): ?>
                                            <a href="<?= htmlspecialchars($projet['lien_demo']) ?>" 
                                               target="_blank" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-external-link-alt"></i> Démo
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                
                                <hr>
                                <div class="bg-light p-3 rounded">
                                    <strong>Extrait de la description :</strong>
                                    <p class="mb-0 mt-2">
                                        <?= htmlspecialchars(mb_substr($projet['description'], 0, 200)) ?>...
                                    </p>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 d-flex justify-content-between">
                <div>
                    <a href="/admin/projets.php" class="btn btn-secondary btn-lg">
                        <i class="fas fa-times"></i> Annuler
                    </a>
                    <a href="/projet.php?slug=<?= urlencode($projet['slug']) ?>" 
                       class="btn btn-outline-info btn-lg"
                       target="_blank">
                        <i class="fas fa-eye"></i> Voir le projet
                    </a>
                </div>
                <form method="POST" style="display: inline;">
                    <button type="submit" class="btn btn-danger btn-lg">
                        <i class="fas fa-trash"></i> Confirmer la suppression
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>