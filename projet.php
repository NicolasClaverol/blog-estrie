<?php
require_once 'includes/session.php';
require_once 'includes/database.php';

// Récupérer le slug depuis l'URL
$slug = $_GET['slug'] ?? '';

if (empty($slug)) {
    header('Location: /index.php');
    exit;
}

// Récupérer le projet avec les informations de l'auteur
$stmt = $pdo->prepare('
    SELECT p.*, u.username 
    FROM projets p 
    LEFT JOIN users u ON p.user_id = u.id 
    WHERE p.slug = ?
');
$stmt->execute([$slug]);
$projet = $stmt->fetch();

// Si le projet n'existe pas, rediriger
if (!$projet) {
    header('Location: /index.php');
    exit;
}

$page_title = htmlspecialchars($projet['titre']) . " - Blog Estrie";

require_once 'includes/header.php';
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/index.php">Accueil</a></li>
                    <li class="breadcrumb-item"><a href="/projets.php">Projets</a></li>
                    <li class="breadcrumb-item active"><?= htmlspecialchars($projet['titre']) ?></li>
                </ol>
            </nav>
            
            <!-- Projet -->
            <article class="mb-5">
                <!-- Titre -->
                <h1 class="mb-3"><?= htmlspecialchars($projet['titre']) ?></h1>
                
                <!-- Métadonnées -->
                <div class="text-muted mb-4">
                    <i class="fas fa-user"></i> Par <strong><?= htmlspecialchars($projet['username'] ?? 'Anonyme') ?></strong>
                    <span class="mx-2">|</span>
                    <i class="fas fa-calendar"></i> <?= date('d/m/Y', strtotime($projet['created_at'])) ?>
                    <?php if ($projet['updated_at'] != $projet['created_at']): ?>
                        <span class="mx-2">|</span>
                        <i class="fas fa-edit"></i> Modifié le <?= date('d/m/Y', strtotime($projet['updated_at'])) ?>
                    <?php endif; ?>
                </div>
                
                <!-- Liens GitHub et Démo -->
                <?php if ($projet['lien_github'] || $projet['lien_demo']): ?>
                    <div class="mb-4">
                        <?php if ($projet['lien_github']): ?>
                            <a href="<?= htmlspecialchars($projet['lien_github']) ?>" 
                               target="_blank" 
                               class="btn btn-dark me-2">
                                <i class="fab fa-github"></i> Voir sur GitHub
                            </a>
                        <?php endif; ?>
                        <?php if ($projet['lien_demo']): ?>
                            <a href="<?= htmlspecialchars($projet['lien_demo']) ?>" 
                               target="_blank" 
                               class="btn btn-primary">
                                <i class="fas fa-external-link-alt"></i> Voir la démo
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                
                <!-- Image de couverture -->
                <?php if ($projet['image']): ?>
                    <div class="mb-4">
                        <img src="/uploads/<?= htmlspecialchars($projet['image']) ?>" 
                             alt="<?= htmlspecialchars($projet['titre']) ?>"
                             class="img-fluid rounded shadow">
                    </div>
                <?php endif; ?>
                
                <!-- Description -->
                <div class="projet-content">
                    <h3 class="mb-3">Description du projet</h3>
                    <?= $projet['description'] ?>
                </div>
            </article>
            
            <hr>
            
            <!-- Boutons d'action pour les admins -->
            <?php if (isAdmin()): ?>
                <div class="alert alert-info">
                    <strong><i class="fas fa-user-shield"></i> Actions administrateur :</strong>
                    <div class="mt-2">
                        <a href="/admin/edit_projet.php?id=<?= $projet['id'] ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Modifier ce projet
                        </a>
                        <a href="/admin/projets.php" class="btn btn-secondary btn-sm">
                            <i class="fas fa-list"></i> Retour à la gestion
                        </a>
                    </div>
                </div>
            <?php endif; ?>
            
            <!-- Boutons retour -->
            <div class="mt-4">
                <a href="/projets.php" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Retour aux projets
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Styles pour le contenu du projet -->
<style>
.projet-content {
    font-size: 1.1rem;
    line-height: 1.8;
    text-align: justify;
}

.projet-content p {
    margin-bottom: 1.5rem;
}
</style>

<?php require_once 'includes/footer.php'; ?>
```

---

## 🧪 Test de la page

### **1️⃣ Accéder au projet**

**Option A :** Via le bouton 👁️ dans la liste admin
- Va sur `http://localhost:8000/admin/projets.php`
- Clique sur le bouton 👁️ "Voir" d'un projet

**Option B :** Directement avec le slug
```
http://localhost:8000/projet.php?slug=portfolio-blog-estrie