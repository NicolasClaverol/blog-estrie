<?php
require_once 'includes/session.php';
require_once 'includes/database.php';

$page_title = "Inscription - Blog Estrie";
$errors = [];
$success = false;

// Si déjà connecté, rediriger vers le profil
if (isLoggedIn()) {
    header('Location: /profile.php');
    exit;
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    // Validation
    if (empty($username)) {
        $errors[] = "Le nom d'utilisateur est requis.";
    } elseif (strlen($username) < 3) {
        $errors[] = "Le nom d'utilisateur doit contenir au moins 3 caractères.";
    }
    
    if (empty($email)) {
        $errors[] = "L'email est requis.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'email n'est pas valide.";
    }
    
    if (empty($password)) {
        $errors[] = "Le mot de passe est requis.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Le mot de passe doit contenir au moins 6 caractères.";
    }
    
    if ($password !== $confirm_password) {
        $errors[] = "Les mots de passe ne correspondent pas.";
    }
    
    // Vérifier si l'username ou l'email existe déjà
    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        
        if ($stmt->fetch()) {
            $errors[] = "Ce nom d'utilisateur ou cet email est déjà utilisé.";
        }
    }
    
    // Insertion dans la base de données
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $hashed_password]);
        
        $success = true;
    }
}

require_once 'includes/header.php';
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg mt-5">
                <div class="card-body p-5">
                    <h2 class="text-center mb-4">
                        <i class="fas fa-user-plus text-primary"></i> Inscription
                    </h2>
                    
                    <?php if ($success): ?>
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i> 
                            Inscription réussie ! Vous pouvez maintenant vous 
                            <a href="/login.php" class="alert-link">connecter</a>.
                        </div>
                    <?php else: ?>
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach ($errors as $error): ?>
                                        <li><?php echo htmlspecialchars($error); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="username" class="form-label">
                                    <i class="fas fa-user"></i> Nom d'utilisateur
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="username" 
                                       name="username" 
                                       value="<?php echo htmlspecialchars($username ?? ''); ?>"
                                       required>
                                <small class="text-muted">Au moins 3 caractères</small>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope"></i> Email
                                </label>
                                <input type="email" 
                                       class="form-control" 
                                       id="email" 
                                       name="email" 
                                       value="<?php echo htmlspecialchars($email ?? ''); ?>"
                                       required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock"></i> Mot de passe
                                </label>
                                <input type="password" 
                                       class="form-control" 
                                       id="password" 
                                       name="password" 
                                       required>
                                <small class="text-muted">Au moins 6 caractères</small>
                            </div>
                            
                            <div class="mb-4">
                                <label for="confirm_password" class="form-label">
                                    <i class="fas fa-lock"></i> Confirmer le mot de passe
                                </label>
                                <input type="password" 
                                       class="form-control" 
                                       id="confirm_password" 
                                       name="confirm_password" 
                                       required>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-user-plus"></i> S'inscrire
                                </button>
                            </div>
                        </form>
                        
                        <hr class="my-4">
                        
                        <p class="text-center text-muted mb-0">
                            Vous avez déjà un compte ? 
                            <a href="/login.php">Se connecter</a>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
```

---

## 📝 Résumé des modifications

### **Changements effectués :**

1. **Ligne 2-3** : 
   - ❌ `require_once 'config/database.php';`
   - ✅ `require_once 'includes/session.php';`
   - ✅ `require_once 'includes/database.php';`

2. **Ligne 9-12** :
   - ❌ `if (isset($_SESSION['user_id']))`
   - ✅ `if (isLoggedIn())`
   - Redirection vers `/profile.php` au lieu de `/index.php`

3. **Ligne 47-53** : Suppression du `try/catch` et de `getConnection()` (simplifié car `$pdo` est maintenant global)

4. **Ligne 64** : Suppression de `, is_admin` et de `, 0` dans l'INSERT (simplifié)

---

## ✅ Teste maintenant
```
http://localhost:8000/register.php