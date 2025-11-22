<?php
require_once '../includes/session.php';
require_once '../includes/database.php';

// Protéger la page (admin uniquement)
requireAdmin();

// Récupérer l'ID de l'article
$article_id = $_GET['id'] ?? 0;

if (empty($article_id)) {
    setFlashMessage("Aucun article spécifié.", "danger");
    header('Location: /admin/articles.php');
    exit;
}

// Récupérer l'article
$stmt = $pdo->prepare('SELECT * FROM articles WHERE id = ?');
$stmt->execute([$article_id]);
$article = $stmt->fetch();

if (!$article) {
    setFlashMessage("Article introuvable.", "danger");
    header('Location: /admin/articles.php');
    exit;
}

// Si confirmation (POST), supprimer l'article
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Supprimer l'image si elle existe
    if ($article['image'] && file_exists('../uploads/' . $article['image'])) {
        unlink('../uploads/' . $article['image']);
    }
    
    // Supprimer l'article de la base de données
    $stmt = $pdo->prepare('DELETE FROM articles WHERE id = ?');
    $stmt->execute([$article_id]);
    
    setFlashMessage("Article supprimé avec succès !", "success");
    header('Location: /admin/articles.php');
    exit;
}

$page_title = "Supprimer un article - Blog Estrie";
require_once '../includes/header.php';
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1><i class="fas fa-trash text-danger"></i> Supprimer un article</h1>
                <a href="/admin/articles.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour à la liste
                </a>
            </div>
            
            <div class="alert alert-danger">
                <h4 class="alert-heading">
                    <i class="fas fa-exclamation-triangle"></i> Attention !
                </h4>
                <p>Vous êtes sur le point de supprimer définitivement cet article.</p>
                <hr>
                <p class="mb-0">
                    <strong>Cette action est irréversible !</strong> 
                    L'article et son image seront supprimés du serveur.
                </p>
            </div>
            
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Article à supprimer :</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php if ($article['image']): ?>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <img src="/uploads/<?= htmlspecialchars($article['image']) ?>" 
                                     alt="<?= htmlspecialchars($article['titre']) ?>"
                                     class="img-fluid rounded shadow-sm">
                            </div>
                            <div class="col-md-8">
                        <?php else: ?>
                            <div class="col-12">
                        <?php endif; ?>
                                <h3><?= htmlspecialchars($article['titre']) ?></h3>
                                <p class="text-muted">
                                    <i class="fas fa-link"></i> 
                                    <strong>Slug :</strong> <?= htmlspecialchars($article['slug']) ?>
                                </p>
                                <p class="text-muted">
                                    <i class="fas fa-calendar"></i> 
                                    <strong>Créé le :</strong> <?= date('d/m/Y à H:i', strtotime($article['created_at'])) ?>
                                </p>
                                <?php if ($article['updated_at'] != $article['created_at']): ?>
                                    <p class="text-muted">
                                        <i class="fas fa-edit"></i> 
                                        <strong>Modifié le :</strong> <?= date('d/m/Y à H:i', strtotime($article['updated_at'])) ?>
                                    </p>
                                <?php endif; ?>
                                <hr>
                                <div class="bg-light p-3 rounded">
                                    <strong>Extrait du contenu :</strong>
                                    <p class="mb-0 mt-2">
                                        <?= htmlspecialchars(mb_substr($article['contenu'], 0, 200)) ?>...
                                    </p>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 d-flex justify-content-between">
                <div>
                    <a href="/admin/articles.php" class="btn btn-secondary btn-lg">
                        <i class="fas fa-times"></i> Annuler
                    </a>
                    <a href="/article.php?slug=<?= urlencode($article['slug']) ?>" 
                       class="btn btn-outline-info btn-lg"
                       target="_blank">
                        <i class="fas fa-eye"></i> Voir l'article
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
```

---

## 🧪 Test de la suppression

### **1️⃣ Accéder à la page de suppression**

Deux façons :

**A) Depuis la liste admin :**
1. Va sur `http://localhost:8000/admin/articles.php`
2. Clique sur le bouton 🗑️ "Supprimer" d'un article
3. Tu arrives sur la page de confirmation

**B) Directement (si ton article a l'ID 1) :**
```
http://localhost:8000/admin/delete_article.php?id=1
```

---

### **2️⃣ Vérifier la page de confirmation**

**✅ Tu dois voir :**
- Alerte rouge "Attention !"
- Détails de l'article (titre, slug, dates, extrait)
- Image de l'article (si elle existe)
- Bouton "Annuler" (retour à la liste)
- Bouton "Voir l'article" (prévisualisation)
- Bouton rouge "Confirmer la suppression"

---

### **3️⃣ Tester l'annulation**

Clique sur **"Annuler"**

**✅ Résultat attendu :** Tu reviens à `/admin/articles.php` sans rien supprimer

---

### **4️⃣ Tester la suppression réelle**

1. Va sur la page de suppression d'un article
2. Clique sur **"Confirmer la suppression"**

**✅ Résultats attendus :**
- Redirection vers `/admin/articles.php`
- Message vert : "Article supprimé avec succès !"
- L'article n'apparaît plus dans la liste
- L'image a été supprimée du dossier `/uploads/` (si elle existait)

---

### **5️⃣ Tester la protection**

Essaye d'accéder à un article supprimé :
```
http://localhost:8000/article.php?slug=slug-de-larticle-supprime