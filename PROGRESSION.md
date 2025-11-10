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
- ✅ Étape 5 : Configuration connexion BDD (`config/database.php`)

### PARTIE 2 : DESIGN & FRAMEWORK ✅ (100%)
- ✅ Étape 6 : Installation Bootstrap & Sass
- ✅ Étape 7 : Création du template de base (header, footer)
- ✅ Étape 8 : Design de la page d'accueil (`index.php`)

### PARTIE 3 : AUTHENTIFICATION 🔄 (67%)
- ✅ Étape 10 : Page d'inscription (`register.php`)
- ✅ Étape 11 : Page de connexion (`login.php`)
- ⏳ Étape 12 : Système de sessions et protection pages admin
- ⏳ Étape 13 : Page de déconnexion
- ⏳ Étape 14 : Création du compte administrateur

### PARTIE 4 : GESTION DES ARTICLES ⏳ (0%)
- ⏳ Étape 15 : Page admin - liste des articles
- ⏳ Étape 16 : Formulaire création d'article
- ⏳ Étape 17 : Upload d'images pour articles
- ⏳ Étape 18 : Intégration TinyMCE (éditeur)
- ⏳ Étape 19 : Modification d'article
- ⏳ Étape 20 : Suppression d'article
- ⏳ Étape 21 : Affichage public des articles

### PARTIE 5 : GESTION DES PROJETS ⏳ (0%)
- ⏳ Étape 22 : Page admin - liste des projets
- ⏳ Étape 23 : Formulaire création de projet
- ⏳ Étape 24 : Upload d'images pour projets
- ⏳ Étape 25 : Modification de projet
- ⏳ Étape 26 : Suppression de projet
- ⏳ Étape 27 : Affichage public des projets (portfolio)

### PARTIE 6 : COMMENTAIRES ⏳ (Optionnel)
- ⏳ Étape 28 : Système de commentaires sous les articles
- ⏳ Étape 29 : Modération des commentaires

### PARTIE 7 : FINALISATION ⏳ (0%)
- ⏳ Étape 30 : Tests et corrections de bugs
- ⏳ Étape 31 : Optimisation du code
- ⏳ Étape 32 : Push final sur GitHub
- ⏳ Étape 33 : Enregistrement vidéo de démonstration
- ⏳ Étape 34 : Rédaction du README.md

---

## 📊 Progression globale
```
[███████████░░░░░░░░░] 50% complété
```

**Temps estimé restant** : 15-20 heures

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
├── config/
│   └── database.php
├── includes/
│   ├── header.php
│   └── footer.php
├── admin/ (à créer)
├── uploads/ (pour les images)
├── node_modules/ (ignoré par Git)
├── index.php
├── register.php
├── login.php
├── adminer.php
├── test_connexion.php
├── PROGRESSION.md
├── README.md
├── .gitignore
└── package.json
```

### Fichiers créés jusqu'à présent
- ✅ `config/database.php` - Connexion BDD
- ✅ `includes/header.php` - En-tête réutilisable
- ✅ `includes/footer.php` - Pied de page réutilisable
- ✅ `index.php` - Page d'accueil
- ✅ `register.php` - Page d'inscription
- ✅ `login.php` - Page de connexion
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
- **Solution** : Utiliser `/` au lieu de `/blog-estrie/` dans les chemins car le serveur PHP intégré est à la racine du projet

### Sass deprecation warnings
- **Note** : Les warnings sont normaux avec Bootstrap 5.3.2
- **Solution** : Utiliser `--quiet-deps` pour les masquer
```bash
  npx sass --quiet-deps assets/scss/custom.scss assets/css/style.css
```

### Apache ne démarre pas
- **Problème** : Apache échoue au démarrage (conflit de port)
- **Solution** : Utiliser uniquement le serveur PHP intégré, Apache non nécessaire

### phpMyAdmin inaccessible
- **Problème** : phpMyAdmin nécessite Apache
- **Solution** : Copier Adminer dans le projet
```bash
  cp /var/www/html/adminer.php /var/www/html/blog-estrie/adminer.php
```
  Puis accéder via `http://localhost:8000/adminer.php`

### Git push - Authentication failed
- **Problème** : GitHub n'accepte plus les mots de passe
- **Solution** : Utiliser un Personal Access Token (PAT)
  - Générer sur GitHub : Settings → Developer settings → Personal access tokens
  - Utiliser le token comme mot de passe lors du push
  - Mémoriser avec `git config --global credential.helper store`

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

---

## 📚 Ressources utiles

- [Documentation Bootstrap](https://getbootstrap.com/docs/5.3/)
- [Documentation Sass](https://sass-lang.com/documentation/)
- [TinyMCE](https://www.tiny.cloud/docs/quick-start/) (pour l'éditeur de texte)
- [Font Awesome Icons](https://fontawesome.com/icons)
- [Documentation PHP](https://www.php.net/manual/fr/)
- [Documentation MySQL](https://dev.mysql.com/doc/)

---

## 📝 Notes pour la suite

### Prochaines étapes immédiates
- [ ] Étape 12 : Créer un fichier de vérification de session
- [ ] Étape 13 : Créer la page de déconnexion (logout.php)
- [ ] Étape 14 : Créer le premier compte administrateur

### Fonctionnalités à implémenter
- [ ] Protection des pages admin (vérification session)
- [ ] Système CRUD complet pour les articles
- [ ] Système CRUD complet pour les projets
- [ ] Upload et gestion des images
- [ ] Éditeur de texte riche (TinyMCE)
- [ ] Génération automatique de slugs
- [ ] Système de commentaires (optionnel)

### Contenu à créer
- [ ] Rédiger des articles sur l'Estrie
- [ ] Créer des projets de portfolio
- [ ] Trouver/créer des images de l'Estrie
- [ ] Préparer le script de la vidéo de démonstration

---

## 🎯 Objectifs du projet

### Fonctionnalités obligatoires
- ✅ Connexion / Déconnexion
- ⏳ Création / Modification / Suppression d'articles
- ⏳ Création / Modification / Suppression de projets
- ⏳ Espace administrateur protégé
- ⏳ Affichage public des articles et projets

### Technologies obligatoires
- ✅ HTML / CSS / JavaScript
- ✅ Sass avec personnalisation Bootstrap
- ✅ PHP avec MySQL
- ✅ Git & GitHub
- ⏳ TinyMCE ou textarea pour l'éditeur

### Livrables
- ⏳ Code source complet sur GitHub
- ⏳ Base de données fonctionnelle
- ⏳ Site web opérationnel
- ⏳ Vidéo de démonstration (YouTube non-répertorié)
- ⏳ README.md détaillé

---

**Dernière mise à jour** : Session du 10/11/2025 13h34 - Étape 11 terminée
**Prochaine étape** : Étape 12 - Système de sessions et protection pages admin
**Progression** : 50% du projet complété