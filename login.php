<?php
session_start();
require_once 'config/database.php';

$page_title = "Connexion - Blog Estrie";
$error = '';

// Si l'utilisateur est déjà connecté, rediriger vers l'accueil
if (isset($_SESSION['user_id'])) {
    header('Location: /index.php');
    exit;
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $error = "Veuillez remplir tous les champs.";
    } else {
        try {
            $pdo = getConnection();
            
            // Rechercher l'utilisateur
            $stmt = $pdo->prepare("SELECT id, username, password, is_admin FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch();
            
            if ($user && password_verify($password, $user['password'])) {
                // Connexion réussie
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['is_admin'] = (bool)$user['is_admin'];
                
                // Rediriger vers la page admin si admin, sinon accueil
                if ($_SESSION['is_admin']) {
                    header('Location: /admin/index.php');
                } else {
                    header('Location: /index.php');
                }
                exit;
            } else {
                $error = "Nom d'utilisateur ou mot de passe incorrect.";
            }
        } catch (PDOException $e) {
            $error = "Erreur de connexion : " . $e->getMessage();
        }
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
                        <i class="fas fa-sign-in-alt text-primary"></i> Connexion
                    </h2>
                    
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle"></i>
                            <?php echo htmlspecialchars($error); ?>
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
                                   required 
                                   autofocus>
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock"></i> Mot de passe
                            </label>
                            <input type="password" 
                                   class="form-control" 
                                   id="password" 
                                   name="password" 
                                   required>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-sign-in-alt"></i> Se connecter
                            </button>
                        </div>
                    </form>
                    
                    <hr class="my-4">
                    
                    <p class="text-center text-muted mb-0">
                        Pas encore de compte ? 
                        <a href="/register.php">S'inscrire</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
