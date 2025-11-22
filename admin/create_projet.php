<?php
require_once '../includes/session.php';
require_once '../includes/database.php';

// Protéger la page (admin uniquement)
requireAdmin();

$page_title = "Créer un projet - Blog Estrie";
$errors = [];

// Fonction pour générer un slug depuis un titre
function generateSlug($text) {
    $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    $text = trim($text, '-');
    return $text;
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = trim($_POST['titre'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $lien_github = trim($_POST['lien_github'] ?? '');
    $lien_demo = trim($_POST['lien_demo'] ?? '');
    
    // Validation
    if (empty($titre)) {
        $errors[] = "Le titre est obligatoire.";
    } elseif (strlen($titre) < 5) {
        $errors[] = "Le titre doit contenir au moins 5 caractères.";
    }
    
    if (empty($description)) {
        $errors[] = "La description est obligatoire.";
    } elseif (strlen($description) < 50) {
        $errors[] = "La description doit contenir au moins 50 caractères.";
    }
    
    // Générer le slug si vide
    if (empty($slug)) {
        $slug = generateSlug($titre);
    } else {
        $slug = generateSlug($slug);
    }
    
    // Vérifier que le slug est unique
    if (empty($errors)) {
        $stmt = $pdo->prepare('SELECT id FROM projets WHERE slug = ?');
        $stmt->execute([$slug]);
        if ($stmt->fetch()) {
            $errors[] = "Ce slug existe déjà. Veuillez en choisir un autre.";
        }
    }
    
    // Validation des liens (optionnels mais doivent être valides si renseignés)
    if (!empty($lien_github) && !filter_var($lien_github, FILTER_VALIDATE_URL)) {
        $errors[] = "Le lien GitHub n'est pas valide.";
    }
    
    if (!empty($lien_demo) && !filter_var($lien_demo, FILTER_VALIDATE_URL)) {
        $errors[] = "Le lien de démo n'est pas valide.";
    }
    
    // Gestion de l'upload d'image
    $imageName = null;
    if (!empty($_FILES['image']['name'])) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $maxSize = 5 * 1024 * 1024; // 5 MB
        
        if (!in_array($_FILES['image']['type'], $allowedTypes)) {
            $errors[] = "Type d'image non autorisé. Utilisez JPG, PNG, GIF ou WebP.";
        } elseif ($_FILES['image']['size'] > $maxSize) {
            $errors[] = "L'image est trop volumineuse (max 5 MB).";
        } else {
            // Créer le dossier uploads s'il n'existe pas
            if (!is_dir('../uploads')) {
                mkdir('../uploads', 0755, true);
            }
            
            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $imageName = uniqid() . '_' . time() . '.' . $extension;
            $uploadPath = '../uploads/' . $imageName;
            
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                $errors[] = "Erreur lors de l'upload de l'image.";
                $imageName = null;
            }
        }
    }
    
    // Insertion en base de données si pas d'erreurs
    if (empty($errors)) {
        $stmt = $pdo->prepare('
            INSERT INTO projets (titre, slug, description, image, lien_github, lien_demo, user_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ');
        
        $stmt->execute([
            $titre,
            $slug,
            $description,
            $imageName,
            $lien_github ?: null,
            $lien_demo ?: null,
            getUserId()
        ]);
        
        setFlashMessage("Projet créé avec succès !", "success");
        header('Location: /admin/projets.php');
        exit;
    }
}

require_once '../includes/header.php';
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1><i class="fas fa-plus-circle"></i> Créer un projet</h1>
                <a href="/admin/projets.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour à la liste
                </a>
            </div>
            
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <strong><i class="fas fa-exclamation-circle"></i> Erreurs :</strong>
                    <ul class="mb-0 mt-2">
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <div class="card">
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <!-- Titre -->
                        <div class="mb-3">
                            <label for="titre" class="form-label">
                                <i class="fas fa-heading"></i> Titre du projet <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="titre" 
                                   name="titre" 
                                   value="<?= htmlspecialchars($titre ?? '') ?>"
                                   required>
                            <small class="text-muted">Minimum 5 caractères</small>
                        </div>
                        
                        <!-- Slug -->
                        <div class="mb-3">
                            <label for="slug" class="form-label">
                                <i class="fas fa-link"></i> Slug (URL)
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="slug" 
                                   name="slug" 
                                   value="<?= htmlspecialchars($slug ?? '') ?>"
                                   placeholder="Laissez vide pour génération automatique">
                            <small class="text-muted">
                                Le slug sera généré automatiquement depuis le titre si vous le laissez vide
                            </small>
                        </div>
                        
                        <!-- Image -->
                        <div class="mb-3">
                            <label for="image" class="form-label">
                                <i class="fas fa-image"></i> Image de couverture
                            </label>
                            <input type="file" 
                                   class="form-control" 
                                   id="image" 
                                   name="image"
                                   accept="image/jpeg,image/png,image/gif,image/webp">
                            <small class="text-muted">
                                Formats acceptés : JPG, PNG, GIF, WebP (max 5 MB)
                            </small>
                        </div>
                        
                        <!-- Lien GitHub -->
                        <div class="mb-3">
                            <label for="lien_github" class="form-label">
                                <i class="fab fa-github"></i> Lien GitHub
                            </label>
                            <input type="url" 
                                   class="form-control" 
                                   id="lien_github" 
                                   name="lien_github" 
                                   value="<?= htmlspecialchars($lien_github ?? '') ?>"
                                   placeholder="https://github.com/username/repository">
                            <small class="text-muted">Optionnel - Lien vers le dépôt GitHub du projet</small>
                        </div>
                        
                        <!-- Lien Démo -->
                        <div class="mb-3">
                            <label for="lien_demo" class="form-label">
                                <i class="fas fa-external-link-alt"></i> Lien de démo
                            </label>
                            <input type="url" 
                                   class="form-control" 
                                   id="lien_demo" 
                                   name="lien_demo" 
                                   value="<?= htmlspecialchars($lien_demo ?? '') ?>"
                                   placeholder="https://demo.example.com">
                            <small class="text-muted">Optionnel - Lien vers la démo en ligne du projet</small>
                        </div>
                        
                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label">
                                <i class="fas fa-paragraph"></i> Description du projet <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" 
                                      id="description" 
                                      name="description" 
                                      rows="15" 
                                      required><?= htmlspecialchars($description ?? '') ?></textarea>
                            <small class="text-muted">Minimum 50 caractères</small>
                        </div>
                        
                        <!-- Boutons -->
                        <div class="d-flex justify-content-between">
                            <a href="/admin/projets.php" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Créer le projet
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="alert alert-info mt-4">
                <i class="fas fa-info-circle"></i>
                <strong>Astuce :</strong> Les liens GitHub et Démo sont optionnels mais recommandés 
                pour permettre aux visiteurs de voir votre code et tester votre projet.
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
```

---

## 🧪 Test du formulaire

### **1️⃣ Accède à la page**
```
http://localhost:8000/admin/create_projet.php
```

**✅ Tu dois voir :**
- Formulaire complet avec tous les champs
- Champs requis marqués avec *
- Champs optionnels (GitHub, Démo)

---

### **2️⃣ Crée un projet de test**

Remplis le formulaire :

**Titre :** `Portfolio Blog Estrie`

**Slug :** *(laisse vide)*

**Image :** *(choisis une image si tu veux)*

**Lien GitHub :** `https://github.com/NicolasClaverol/blog-estrie`

**Lien Démo :** `http://localhost:8000`

**Description :**
```
Ce projet est un blog et portfolio sur la région de l'Estrie, développé avec PHP, MySQL et Bootstrap dans le cadre de la formation Believemy.

Le site permet de créer, modifier et supprimer des articles et des projets, avec un système d'authentification complet et une gestion des droits administrateur.

Technologies utilisées : PHP 8, MySQL, Bootstrap 5, Sass, Git/GitHub.