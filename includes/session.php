<?php
// Démarrer la session si elle n'est pas déjà active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Fonction pour vérifier si l'utilisateur est connecté
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Fonction pour récupérer l'ID de l'utilisateur connecté
function getUserId() {
    return $_SESSION['user_id'] ?? null;
}

// Fonction pour récupérer le nom d'utilisateur
function getUsername() {
    return $_SESSION['username'] ?? null;
}

// Fonction pour récupérer l'email
function getUserEmail() {
    return $_SESSION['email'] ?? null;
}

// Fonction pour protéger une page (redirection si non connecté)
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: /login.php');
        exit;
    }
}

// Fonction pour définir un message flash
function setFlashMessage($message, $type = 'success') {
    $_SESSION['flash_message'] = $message;
    $_SESSION['flash_type'] = $type;
}

// Fonction pour afficher et supprimer le message flash
function getFlashMessage() {
    if (isset($_SESSION['flash_message'])) {
        $message = $_SESSION['flash_message'];
        $type = $_SESSION['flash_type'];
        unset($_SESSION['flash_message']);
        unset($_SESSION['flash_type']);
        return ['message' => $message, 'type' => $type];
    }
    return null;
}
?>