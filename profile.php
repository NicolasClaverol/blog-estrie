<?php
require_once 'includes/session.php';
require_once 'includes/database.php';

// Protéger la page
requireLogin();

require_once 'includes/header.php';

// Récupérer les informations de l'utilisateur
$stmt = $pdo->prepare('SELECT username, email, created_at FROM users WHERE id = ?');
$stmt->execute([getUserId()]);
$user = $stmt->fetch();

// Afficher le message flash s'il existe
$flash = getFlashMessage();
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4">Mon Profil</h1>
            
            <?php if ($flash): ?>
                <div class="alert alert-<?= $flash['type'] ?> alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($flash['message']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Informations du compte</h5>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nom d'utilisateur</label>
                        <p class="form-control-plaintext"><?= htmlspecialchars($user['username']) ?></p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <p class="form-control-plaintext"><?= htmlspecialchars($user['email']) ?></p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Membre depuis</label>
                        <p class="form-control-plaintext">
                            <?= date('d/m/Y', strtotime($user['created_at'])) ?>
                        </p>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between">
                        <a href="/admin/dashboard.php" class="btn btn-success">
                            Tableau de bord
                        </a>
                        <a href="/logout.php" class="btn btn-outline-danger">
                            Se déconnecter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>