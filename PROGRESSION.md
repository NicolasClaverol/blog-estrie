# Progression du projet Blog Estrie

## 📌 Informations du projet
- **Nom** : Blog Estrie - Découverte de Sherbrooke et ses environs
- **Formation** : Believemy - Projet Passerelle #2
- **Technologies** : PHP, MySQL, Bootstrap, Sass, Git/GitHub

---

## ⚙️ Configuration technique

### Environnement
- **Système d'exploitation** : Linux Mint
- **IDE** : Visual Studio Code
- **Serveur web** : PHP intégré (pas Apache)
- **Chemin du projet** : `/var/www/html/blog-estrie`

### Base de données MySQL
- **Nom de la base** : `blog_estrie`
- **Utilisateur** : `admin`
- **Mot de passe** : `Admin123`
- **Tables créées** : users, articles, projets, commentaires

### URL de développement
- **Locale** : `http://localhost:8000`
- **Accès phpMyAdmin** : `http://localhost/phpmyadmin` (utiliser l'utilisateur admin)

---

## 🚀 Commandes de démarrage quotidiennes
```bash
# 1. Démarrer MySQL
sudo systemctl start mysql

# 2. Se positionner dans le projet
cd /var/www/html/blog-estrie

# 3. Démarrer le serveur PHP
php -S localhost:8000

# 4. (Optionnel) Watch Sass dans un autre terminal
npx sass --quiet-deps --watch assets/scss/custom.scss:assets/css/style.css
```

---

## ✅ Étapes complétées

### PARTIE 1 : FONDATIONS ✅
- ✅ Étape 1 : Préparation environnement
- ✅ Étape 2 : Structure des dossiers
- ✅ Étape 3 : Initialisation Git
- ✅ Étape 4 : Création base de données
- ✅ Étape 5 : Configuration connexion BDD

### PARTIE 2 : DESIGN & FRAMEWORK ✅
- ✅ Étape 6 : Installation Bootstrap & Sass
- ✅ Étape 7 : Création du template de base (header, footer)
- ✅ Étape 8 : Design de la page d'accueil

### PARTIE 3 : AUTHENTIFICATION 🔄
- ✅ Étape 10 : Page d'inscription (register.php)
- 🔄 Étape 11 : Page de connexion (EN COURS)
- ⏳ Étape 12 : Système de sessions
- ⏳ Étape 13 : Page de déconnexion
- ⏳ Étape 14 : Création du compte administrateur

### PARTIE 4 : GESTION DES ARTICLES ⏳
- ⏳ À venir...

### PARTIE 5 : GESTION DES PROJETS ⏳
- ⏳ À venir...

---

## 🎨 Choix de design

### Palette de couleurs (thème Estrie)
- **Primary** (vert forêt) : `#2C5F2D`
- **Secondary** (brun automnal) : `#8B4513`
- **Success** (vert nature) : `#4A7C59`
- **Info** (bleu lac) : `#5B9BD5`
- **Warning** (ocre automne) : `#D4A574`
- **Danger** (rouge érable) : `#A52A2A`

### Framework
- Bootstrap 5.3.2 personnalisé avec Sass
- Font Awesome 6.4.0 pour les icônes

---

## 🔧 Points techniques importants

### Chemins dans les fichiers PHP
⚠️ **IMPORTANT** : Utiliser `/` et non `/blog-estrie/`
```php
// ✅ Correct
<link href="/assets/css/style.css">
<a href="/index.php">

// ❌ Incorrect
<link href="/blog-estrie/assets/css/style.css">
```

### Structure des fichiers
```
blog-estrie/
├── assets/
│   ├── css/style.css (généré par Sass)
│   ├── scss/custom.scss
│   ├── js/
│   └── images/
├── config/
│   └── database.php
├── includes/
│   ├── header.php
│   └── footer.php
├── admin/ (à créer)
├── uploads/ (pour les images)
├── index.php
├── register.php
└── (autres pages à créer)
```

---

## 🐛 Problèmes résolus

### MySQL
- **Problème** : Politique de mot de passe stricte
- **Solution** : Assouplir avec `SET GLOBAL validate_password.policy = LOW;`

### Utilisateur admin
- **Problème** : Root utilise auth_socket
- **Solution** : Créer utilisateur `admin` avec tous les droits

### Chemins CSS
- **Problème** : CSS ne se charge pas
- **Solution** : Utiliser `/` au lieu de `/blog-estrie/` dans les chemins

### Sass deprecation warnings
- **Note** : Les warnings sont normaux et n'empêchent pas la compilation
- **Solution** : Utiliser `--quiet-deps` pour les masquer

---

## 📚 Ressources utiles

- [Documentation Bootstrap](https://getbootstrap.com/docs/5.3/)
- [Documentation Sass](https://sass-lang.com/documentation/)
- [TinyMCE](https://www.tiny.cloud/docs/quick-start/) (pour l'éditeur de texte)
- [Font Awesome Icons](https://fontawesome.com/icons)

---

## 📝 Notes pour la suite

- [ ] Créer le système de connexion complet
- [ ] Créer le premier compte admin
- [ ] Implémenter la gestion des articles
- [ ] Implémenter la gestion des projets
- [ ] Ajouter du contenu réel sur l'Estrie
- [ ] Enregistrer la vidéo de démonstration
- [ ] Finaliser le README.md

---

**Dernière mise à jour** : 10/11/2025
**Prochaine étape** : Étape 11 - Page de connexion