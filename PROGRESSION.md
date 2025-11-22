# Progression du projet Blog Estrie

## 📌 Informations du projet
- **Nom** : Blog Estrie - Découverte de Sherbrooke et ses environs
- **Formation** : Believemy - Projet Passerelle #2
- **Technologies** : PHP, MySQL, Bootstrap, Sass, Git/GitHub
- **Repository GitHub** : https://github.com/NicolasClaverol/blog-estrie

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
- **Adminer** : `http://localhost:8000/adminer.php` (copié dans le projet)
- **Note** : phpMyAdmin non accessible (conflit Apache), Adminer utilisé à la place

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

### PARTIE 1 : FONDATIONS ✅ (100%)
- ✅ Étape 1 : Préparation environnement
- ✅ Étape 2 : Structure des dossiers
- ✅ Étape 3 : Initialisation Git
- ✅ Étape 4 : Création base de données
- ✅ Étape 5 : Configuration connexion BDD

### PARTIE 2 : DESIGN & FRAMEWORK ✅ (100%)
- ✅ Étape 6 : Installation Bootstrap & Sass
- ✅ Étape 7 : Création du template de base (header, footer)
- ✅ Étape 8 : Design de la page d'accueil (`index.php`)

### PARTIE 3 : AUTHENTIFICATION ✅ (100%)
- ✅ Étape 10 : Page d'inscription (`register.php`)
- ✅ Étape 11 : Page de connexion (`login.php`)
- ✅ Étape 12 : Système de sessions et protection pages admin
  - ✅ Création de `includes/session.php` avec fonctions de gestion
  - ✅ Création de `includes/database.php` (migration depuis config/)
  - ✅ Page profil utilisateur (`profile.php`)
  - ✅ Page de déconnexion (`logout.php`)
  - ✅ Tableau de bord admin (`admin/dashboard.php`)
  - ✅ Système de messages flash
  - ✅ Protection des pages avec `requireLogin()`
  - ✅ Navigation dynamique selon l'état de connexion
- ✅ Étape 13 : Page de déconnexion - Déjà fait à l'étape 12
- ✅ Étape 14 : Création du compte administrateur
  - ✅ Compte admin créé : `admin@blogestrie.com` / `password`
  - ✅ Colonne `is_admin` dans la table users
  - ✅ Fonctions `isAdmin()` et `requireAdmin()` ajoutées
  - ✅ Protection du dashboard avec `requireAdmin()`
  - ✅ Badge "Admin" dans le header
  - ✅ Menu Admin avec dropdown (Dashboard, Articles, Projets)
  - ✅ Tests de protection réussis

### PARTIE 4 : GESTION DES ARTICLES ✅ (100%)
- ✅ Étape 15 : Page admin - liste des articles (`admin/articles.php`)
  - ✅ Affichage de tous les articles avec JOIN sur users
  - ✅ Tableau avec images, titre, auteur, dates
  - ✅ Boutons d'action (Voir, Modifier, Supprimer)
  - ✅ Protection avec requireAdmin()
- ✅ Étape 16 : Formulaire création d'article (`admin/create_article.php`)
  - ✅ Formulaire complet (titre, slug, contenu, image)
  - ✅ Génération automatique du slug depuis le titre
  - ✅ Upload d'images avec validation (type, taille max 5MB)
  - ✅ Validation des données (titre min 5 car, contenu min 50 car)
  - ✅ Vérification d'unicité du slug
  - ✅ Association automatique avec user_id
- ✅ Étape 17 : Modification d'article (`admin/edit_article.php`)
  - ✅ Récupération et pré-remplissage du formulaire
  - ✅ Modification du titre, slug, contenu
  - ✅ Remplacement ou suppression de l'image
  - ✅ Suppression automatique de l'ancienne image
  - ✅ Mise à jour automatique de updated_at
  - ✅ Validation avec vérification unicité slug
- ✅ Étape 18 : Suppression d'article (`admin/delete_article.php`)
  - ✅ Page de confirmation avant suppression
  - ✅ Affichage des détails de l'article
  - ✅ Suppression de l'image du serveur
  - ✅ Suppression en base de données
  - ✅ Messages flash de confirmation
- ✅ Étape 19 : Liste publique des articles (`articles.php`)
  - ✅ Affichage en grille responsive (cards Bootstrap)
  - ✅ Affichage image ou placeholder
  - ✅ Métadonnées (auteur, date)
  - ✅ Extrait du contenu (150 caractères)
  - ✅ Effets au survol (élévation + zoom)
  - ✅ Lien vers article.php
- ✅ **BONUS** : Page de visualisation article (`article.php`)
  - ✅ Affichage complet d'un article
  - ✅ Fil d'Ariane (breadcrumb)
  - ✅ Actions admin visibles pour les administrateurs

### PARTIE 5 : GESTION DES PROJETS ✅ (100%)
- ✅ Étape 20 : Page admin - liste des projets (`admin/projets.php`)
  - ✅ Affichage de tous les projets avec JOIN sur users
  - ✅ Tableau avec images, titre, liens, auteur, dates
  - ✅ Boutons d'action (Voir, Modifier, Supprimer)
  - ✅ Affichage des liens GitHub et Démo
  - ✅ Protection avec requireAdmin()
- ✅ Étape 21 : Formulaire création de projet (`admin/create_projet.php`)
  - ✅ Formulaire complet (titre, slug, description, image, liens)
  - ✅ Génération automatique du slug
  - ✅ Upload d'images avec validation
  - ✅ Champs liens GitHub et Démo (optionnels)
  - ✅ Validation des URLs
  - ✅ Vérification d'unicité du slug
- ✅ Étape 22 : Modification de projet (`admin/edit_projet.php`)
  - ✅ Récupération et pré-remplissage du formulaire
  - ✅ Modification de tous les champs
  - ✅ Remplacement ou suppression de l'image
  - ✅ Mise à jour automatique de updated_at
- ✅ Étape 23 : Suppression de projet (`admin/delete_projet.php`)
  - ✅ Page de confirmation avant suppression
  - ✅ Affichage des détails du projet (liens inclus)
  - ✅ Suppression de l'image du serveur
  - ✅ Suppression en base de données
- ✅ Étape 24 : Affichage d'un projet (`projet.php`)
  - ✅ Affichage complet d'un projet
  - ✅ Fil d'Ariane
  - ✅ Boutons GitHub et Démo fonctionnels
  - ✅ Actions admin pour les administrateurs
- ✅ Étape 25 : Portfolio - Liste publique (`projets.php`)
  - ✅ Affichage en grille responsive
  - ✅ Cards avec images et extraits
  - ✅ Boutons GitHub et Démo sur chaque carte
  - ✅ Effets au survol
  - ✅ Lien vers projet.php

### PARTIE 6 : COMMENTAIRES ⏸️ (Non implémenté - Optionnel)
- ⏸️ Étape 26 : Système de commentaires sous les articles
- ⏸️ Étape 27 : Modération des commentaires

### PARTIE 7 : FINALISATION ⏳ (20%)
- ⏳ Étape 28 : Tests et corrections de bugs
- ⏳ Étape 29 : Optimisation du code
- ⏳ Étape 30 : Push final sur GitHub
- ⏳ Étape 31 : Enregistrement vidéo de démonstration
- ⏳ Étape 32 : Rédaction du README.md

---

## 📊 Progression globale
```
[███████████████████████] 95% complété ! 🎉
```

**Temps estimé restant** : 1h15 (finalisation uniquement)

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
- Fichier Sass personnalisé : `assets/scss/custom.scss`
- CSS compilé : `assets/css/style.css`

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
├── includes/
│   ├── header.php
│   ├── footer.php
│   ├── session.php ✅
│   └── database.php ✅
├── admin/
│   ├── dashboard.php ✅
│   ├── articles.php ✅
│   ├── create_article.php ✅
│   ├── edit_article.php ✅
│   ├── delete_article.php ✅
│   ├── projets.php ✅
│   ├── create_projet.php ✅
│   ├── edit_projet.php ✅
│   └── delete_projet.php ✅
├── uploads/ ✅ (pour les images uploadées)
├── node_modules/ (ignoré par Git)
├── index.php
├── register.php
├── login.php
├── profile.php ✅
├── logout.php ✅
├── article.php ✅ (affichage public)
├── articles.php ✅ (liste publique)
├── projet.php ✅ (affichage public)
├── projets.php ✅ (portfolio)
├── adminer.php
├── test_connexion.php
├── PROGRESSION.md
├── README.md
├── .gitignore
└── package.json
```

### Fichiers créés - Liste complète
**Includes :**
- ✅ `includes/database.php` - Connexion PDO à MySQL
- ✅ `includes/session.php` - Gestion sessions + droits admin
- ✅ `includes/header.php` - Navigation dynamique
- ✅ `includes/footer.php` - Pied de page avec Bootstrap JS

**Pages publiques :**
- ✅ `index.php` - Page d'accueil
- ✅ `register.php` - Inscription
- ✅ `login.php` - Connexion (par email)
- ✅ `profile.php` - Profil utilisateur (protégé)
- ✅ `logout.php` - Déconnexion
- ✅ `article.php` - Affichage d'un article
- ✅ `articles.php` - Liste publique des articles
- ✅ `projet.php` - Affichage d'un projet
- ✅ `projets.php` - Portfolio (liste publique)

**Pages admin :**
- ✅ `admin/dashboard.php` - Tableau de bord (protégé)
- ✅ `admin/articles.php` - Gestion des articles
- ✅ `admin/create_article.php` - Création d'article
- ✅ `admin/edit_article.php` - Modification d'article
- ✅ `admin/delete_article.php` - Suppression d'article
- ✅ `admin/projets.php` - Gestion des projets
- ✅ `admin/create_projet.php` - Création de projet
- ✅ `admin/edit_projet.php` - Modification de projet
- ✅ `admin/delete_projet.php` - Suppression de projet

**Utilitaires :**
- ✅ `test_connexion.php` - Test de connexion BDD
- ✅ `assets/scss/custom.scss` - Styles personnalisés
- ✅ `assets/css/style.css` - CSS compilé

---

## 🐛 Problèmes résolus

### MySQL
- **Problème** : Politique de mot de passe stricte (ERROR 1819)
- **Solution** : 
```sql
  SET GLOBAL validate_password.policy = LOW;
  SET GLOBAL validate_password.length = 6;
```

### Utilisateur admin
- **Problème** : Root utilise auth_socket, impossible de se connecter
- **Solution** : Créer utilisateur `admin` avec tous les droits
```sql
  CREATE USER 'admin'@'localhost' IDENTIFIED BY 'Admin123';
  GRANT ALL PRIVILEGES ON *.* TO 'admin'@'localhost' WITH GRANT OPTION;
```

### Base de données manquante
- **Problème** : Base `blog_estrie` n'existait pas après installation
- **Solution** : Créer manuellement la base et les tables via MySQL

### Chemins CSS
- **Problème** : CSS ne se charge pas (404)
- **Solution** : Utiliser `/` au lieu de `/blog-estrie/` dans les chemins

### Sass deprecation warnings
- **Note** : Les warnings sont normaux avec Bootstrap 5.3.2
- **Solution** : Utiliser `--quiet-deps` pour les masquer
```bash
  npx sass --quiet-deps assets/scss/custom.scss assets/css/style.css
```

### Apache ne démarre pas
- **Problème** : Apache échoue au démarrage (conflit de port)
- **Solution** : Utiliser uniquement le serveur PHP intégré

### phpMyAdmin inaccessible
- **Problème** : phpMyAdmin nécessite Apache
- **Solution** : Copier Adminer dans le projet
```bash
  cp /var/www/html/adminer.php /var/www/html/blog-estrie/adminer.php
```

### Git push - Authentication failed
- **Problème** : GitHub n'accepte plus les mots de passe
- **Solution** : Utiliser un Personal Access Token (PAT)

### Port 8000 déjà utilisé
- **Problème** : `Failed to listen on localhost:8000`
- **Solution** : 
```bash
  pkill -f "php -S"
```

### Migration config/ vers includes/
- **Problème** : Structure incohérente
- **Solution** : Créer `includes/database.php` et mettre à jour tous les fichiers

### Formulaire de connexion ne se soumettait pas
- **Problème** : Confusion username/email dans le formulaire
- **Solution** : Utiliser l'email pour la connexion (comme configuré)

---

## 🔐 Git & GitHub

### Configuration
```bash
git config user.name "NicolasClaverol"
git config user.email "votre@email.com"
git config --global credential.helper store
```

### Workflow régulier
```bash
git add .
git status
git commit -m "Description des changements"
git push
```

### Commits effectués
1. ✅ "Initial commit: Fondations, design et inscription"
2. ✅ "Ajout documentation de progression du projet"
3. ✅ "Étape 11 terminée : page de connexion fonctionnelle"
4. ✅ "Étape 12 terminée : Système de sessions et protection des pages admin"
5. ✅ "Mise à jour PROGRESSION.md - Étape 12 documentée"
6. ✅ "Étape 14 terminée : Système de droits administrateur"
7. ✅ "Étape 15 terminée : Page admin - liste des articles"
8. ✅ "Étape 16 terminée : Formulaire de création d'article"
9. ✅ "Ajout page article.php - Affichage public d'un article"
10. ✅ "Étape 17 terminée : Modification d'articles"
11. ✅ "Étape 18 terminée : Suppression d'articles"
12. ✅ "Étape 19 terminée : Liste publique des articles"
13. ✅ "Gestion complète des projets (CRUD) - Étapes 20-25 terminées"
14. ⏳ "Mise à jour PROGRESSION.md - Projet à 95%" *(à faire)*

---

## 📚 Ressources utiles

- [Documentation Bootstrap](https://getbootstrap.com/docs/5.3/)
- [Documentation Sass](https://sass-lang.com/documentation/)
- [TinyMCE](https://www.tiny.cloud/docs/quick-start/) (pour l'éditeur de texte - optionnel)
- [Font Awesome Icons](https://fontawesome.com/icons)
- [Documentation PHP](https://www.php.net/manual/fr/)
- [Documentation MySQL](https://dev.mysql.com/doc/)

---

## 📝 Notes pour la finalisation

### Prochaines étapes (1h15 restantes)
- [ ] Tests finaux complets (15 min)
  - Vérifier tous les liens de navigation
  - Tester toutes les fonctionnalités CRUD
  - Vérifier le responsive mobile/tablette
  - Tester avec compte admin et utilisateur normal
- [ ] Rédaction du README.md professionnel (20 min)
  - Description du projet
  - Technologies utilisées
  - Instructions d'installation
  - Captures d'écran
  - Fonctionnalités principales
- [ ] Enregistrement vidéo de démonstration (30 min)
  - Présentation du site
  - Démonstration des fonctionnalités admin
  - Démonstration des pages publiques
  - Upload sur YouTube (non-répertorié)
- [ ] Vérification finale et push (10 min)

### Fonctionnalités implémentées (résumé)
- [x] Système d'authentification complet
- [x] Gestion des droits administrateur
- [x] CRUD complet pour les articles
- [x] CRUD complet pour les projets
- [x] Upload et gestion d'images
- [x] Génération automatique de slugs
- [x] Validation des données côté serveur
- [x] Messages flash de feedback
- [x] Navigation dynamique selon l'état de connexion
- [x] Pages publiques responsive
- [x] Effets visuels au survol
- [x] Fil d'Ariane (breadcrumb)
- [x] Liens externes (GitHub, Démo)

### Fonctionnalités optionnelles non implémentées
- [ ] Éditeur de texte riche (TinyMCE)
- [ ] Système de commentaires
- [ ] Pagination des articles/projets
- [ ] Recherche
- [ ] Catégories/Tags

---

## 🎯 Objectifs du projet Believemy

### Fonctionnalités obligatoires ✅ TOUTES COMPLÈTES
- ✅ Connexion / Déconnexion
- ✅ Espace administrateur protégé
- ✅ Gestion des droits (admin vs utilisateur)
- ✅ Création / Modification / Suppression d'articles
- ✅ Création / Modification / Suppression de projets
- ✅ Affichage public des articles et projets

### Technologies obligatoires ✅ TOUTES UTILISÉES
- ✅ HTML / CSS / JavaScript
- ✅ Sass avec personnalisation Bootstrap
- ✅ PHP avec MySQL
- ✅ Git & GitHub
- ✅ Textarea pour l'éditeur (TinyMCE optionnel)

### Livrables
- ✅ Code source complet sur GitHub
- ✅ Base de données fonctionnelle
- ✅ Site web opérationnel (95%)
- ⏳ Vidéo de démonstration (YouTube non-répertorié)
- ⏳ README.md détaillé

---

## 🔒 Système d'authentification et sessions

### Architecture mise en place
- `includes/session.php` : Gestion centralisée des sessions et droits
- `includes/database.php` : Connexion PDO à MySQL
- `profile.php` : Page profil utilisateur protégée
- `logout.php` : Déconnexion sécurisée
- `admin/dashboard.php` : Tableau de bord admin

### Fonctions disponibles dans session.php
- `isLoggedIn()` : Vérifie si l'utilisateur est connecté
- `getUserId()` : Récupère l'ID de l'utilisateur connecté
- `getUsername()` : Récupère le nom d'utilisateur
- `getUserEmail()` : Récupère l'email de l'utilisateur
- `isAdmin()` : Vérifie si l'utilisateur est administrateur
- `requireLogin()` : Protège une page (redirection si non connecté)
- `requireAdmin()` : Protège une page admin (redirection si non admin)
- `setFlashMessage($message, $type)` : Définit un message flash
- `getFlashMessage()` : Récupère et supprime le message flash

### Comptes créés
| Type | Email | Mot de passe | Rôle |
|------|-------|--------------|------|
| **Admin** | `admin@blogestrie.com` | `password` | Administrateur (is_admin = 1) |
| **Utilisateur** | *(variable)* | *(variable)* | Utilisateur normal (is_admin = 0) |

---

## 📰 Système de gestion des articles

### Fonctionnalités
- CRUD complet (Create, Read, Update, Delete)
- Upload d'images avec validation
- Génération automatique de slugs
- Vérification d'unicité des slugs
- Association automatique user_id
- Dates created_at et updated_at
- Affichage public responsive
- Liste admin avec tableau
- Messages flash de feedback

### Pages créées
- `admin/articles.php` : Gestion admin
- `admin/create_article.php` : Création
- `admin/edit_article.php` : Modification
- `admin/delete_article.php` : Suppression
- `article.php` : Affichage public
- `articles.php` : Liste publique

---

## 🏗️ Système de gestion des projets

### Fonctionnalités
- CRUD complet identique aux articles
- Upload d'images avec validation
- Génération automatique de slugs
- Champs supplémentaires : lien_github, lien_demo
- Validation des URLs
- Affichage des liens sur les cards
- Portfolio responsive avec effets

### Pages créées
- `admin/projets.php` : Gestion admin
- `admin/create_projet.php` : Création
- `admin/edit_projet.php` : Modification
- `admin/delete_projet.php` : Suppression
- `projet.php` : Affichage public
- `projets.php` : Portfolio

---

**Dernière mise à jour** : Session du 22/11/2025 22h30 - Projet à 95% ✅
**Prochaine étape** : Finalisation (tests, README, vidéo)
**Progression** : 95% du projet complété - IL NE RESTE PLUS QUE 5% ! 🎉