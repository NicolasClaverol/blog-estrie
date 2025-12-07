<?php
require_once '../includes/session.php';
require_once '../includes/database.php';

// Protéger la page (admin uniquement)
requireAdmin();

$page_title = "Modifier un article - Blog Estrie";
$errors = [];

// Récupérer l'ID de l'article
$article_id = $_GET['id'] ?? 0;

if (empty($article_id)) {
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
    $contenu = trim($_POST['contenu'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $delete_image = isset($_POST['delete_image']);
    
    // Validation
    if (empty($titre)) {
        $errors[] = "Le titre est obligatoire.";
    } elseif (strlen($titre) < 5) {
        $errors[] = "Le titre doit contenir au moins 5 caractères.";
    }
    
    if (empty($contenu)) {
        $errors[] = "Le contenu est obligatoire.";
    } elseif (strlen($contenu) < 50) {
        $errors[] = "Le contenu doit contenir au moins 50 caractères.";
    }
    
    // Générer le slug si vide
    if (empty($slug)) {
        $slug = generateSlug($titre);
    } else {
        $slug = generateSlug($slug);
    }
    
    // Vérifier que le slug est unique (sauf pour cet article)
    if (empty($errors)) {
        $stmt = $pdo->prepare('SELECT id FROM articles WHERE slug = ? AND id != ?');
        $stmt->execute([$slug, $article_id]);
        if ($stmt->fetch()) {
            $errors[] = "Ce slug existe déjà. Veuillez en choisir un autre.";
        }
    }
    
    // Gestion de l'upload d'image
    $imageName = $article['image']; // Garder l'ancienne image par défaut
    
    // Si demande de suppression de l'image
    if ($delete_image) {
        if ($article['image'] && file_exists('../uploads/' . $article['image'])) {
            unlink('../uploads/' . $article['image']);
        }
        $imageName = null;
    }
    
    // Si nouvelle image uploadée
    if (!empty($_FILES['image']['name'])) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $maxSize = 5 * 1024 * 1024; // 5 MB
        
        if (!in_array($_FILES['image']['type'], $allowedTypes)) {
            $errors[] = "Type d'image non autorisé. Utilisez JPG, PNG, GIF ou WebP.";
        } elseif ($_FILES['image']['size'] > $maxSize) {
            $errors[] = "L'image est trop volumineuse (max 5 MB).";
        } else {
            // Supprimer l'ancienne image si elle existe
            if ($article['image'] && file_exists('../uploads/' . $article['image'])) {
                unlink('../uploads/' . $article['image']);
            }
            
            // Créer le dossier uploads s'il n'existe pas
            if (!is_dir('../uploads')) {
                mkdir('../uploads', 0755, true);
            }
            
            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $imageName = uniqid() . '_' . time() . '.' . $extension;
            $uploadPath = '../uploads/' . $imageName;
            
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                $errors[] = "Erreur lors de l'upload de l'image.";
                $imageName = $article['image']; // Garder l'ancienne en cas d'erreur
            }
        }
    }
    
    // Mise à jour en base de données si pas d'erreurs
    if (empty($errors)) {
        $stmt = $pdo->prepare('
            UPDATE articles 
            SET titre = ?, slug = ?, contenu = ?, image = ?, updated_at = NOW()
            WHERE id = ?
        ');
        
        $stmt->execute([
            $titre,
            $slug,
            $contenu,
            $imageName,
            $article_id
        ]);
        
        setFlashMessage("Article modifié avec succès !", "success");
        header('Location: /admin/articles.php');
        exit;
    } else {
        // Mettre à jour les données de l'article avec les valeurs du formulaire
        $article['titre'] = $titre;
        $article['contenu'] = $contenu;
        $article['slug'] = $slug;
    }
}

require_once '../includes/header.php';
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1><i class="fas fa-edit"></i> Modifier l'article</h1>
                <a href="/admin/articles.php" class="btn btn-secondary">
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
                                <i class="fas fa-heading"></i> Titre de l'article <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="titre" 
                                   name="titre" 
                                   value="<?= htmlspecialchars($article['titre']) ?>"
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
                                   value="<?= htmlspecialchars($article['slug']) ?>">
                            <small class="text-muted">
                                Le slug sera généré automatiquement depuis le titre si vous le laissez vide
                            </small>
                        </div>
                        
                        <!-- Image actuelle -->
                        <?php if ($article['image']): ?>
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="fas fa-image"></i> Image actuelle
                                </label>
                                <div class="d-flex align-items-start">
                                    <img src="/uploads/<?= htmlspecialchars($article['image']) ?>" 
                                         alt="Image actuelle"
                                         style="max-width: 300px; max-height: 200px; object-fit: cover;"
                                         class="rounded shadow-sm">
                                    <div class="ms-3">
                                        <div class="form-check">
                                            <input class="form-check-input" 
                                                   type="checkbox" 
                                                   id="delete_image" 
                                                   name="delete_image">
                                            <label class="form-check-label text-danger" for="delete_image">
                                                <i class="fas fa-trash"></i> Supprimer cette image
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Nouvelle image -->
                        <div class="mb-3">
                            <label for="image" class="form-label">
                                <i class="fas fa-upload"></i> 
                                <?= $article['image'] ? 'Remplacer l\'image' : 'Ajouter une image' ?>
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
                        
                        <!-- Contenu -->
                        <div class="mb-4">
                            <label for="contenu" class="form-label">
                                <i class="fas fa-paragraph"></i> Contenu de l'article <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" 
                                      id="contenu" 
                                      name="contenu" 
                                      rows="15"><?= htmlspecialchars($article['contenu']) ?></textarea>
                            <small class="text-muted">Minimum 50 caractères</small>
                        </div>
                        
                        <!-- Boutons -->
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="/admin/articles.php" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Annuler
                                </a>
                                <a href="/article.php?slug=<?= urlencode($article['slug']) ?>" 
                                   class="btn btn-outline-info"
                                   target="_blank">
                                    <i class="fas fa-eye"></i> Voir l'article
                                </a>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="alert alert-warning mt-4">
                <i class="fas fa-info-circle"></i>
                <strong>Note :</strong> La modification de l'article mettra automatiquement à jour la date de modification.
            </div>
        </div>
    </div>
</div>

<!-- TinyMCE -->
<script src="https://cdn.tiny.cloud/1/gws4sna8h8ddyeoot76fcklj60x60i6nisul0dfjzthxwftt/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
    selector: '#contenu',
    height: 500,
    menubar: false,
    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
        'insertdatetime', 'media', 'table', 'help', 'wordcount'
    ],
    toolbar: 'undo redo | blocks | bold italic underline strikethrough | ' +
             'alignleft aligncenter alignright alignjustify | ' +
             'bullist numlist outdent indent | link image | ' +
             'forecolor backcolor | removeformat | help',
    content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif; font-size: 14px; line-height: 1.6; }',
    language: 'fr_FR'
});
</script>
<?php require_once '../includes/footer.php'; ?>

