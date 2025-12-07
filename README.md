# 🏔️ Blog Estrie

![License](https://img.shields.io/badge/license-MIT-blue.svg)
![PHP Version](https://img.shields.io/badge/PHP-8.3%2B-blue)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3.2-purple)
![MySQL](https://img.shields.io/badge/MySQL-8.0%2B-orange)

Un blog et portfolio personnel dédié à la découverte de la région de l'Estrie au Québec, développé dans le cadre de la formation Believemy.

---

## 📋 Table des matières

- [À propos](#à-propos)
- [Fonctionnalités](#fonctionnalités)
- [Technologies utilisées](#technologies-utilisées)
- [Prérequis](#prérequis)
- [Installation](#installation)
- [Utilisation](#utilisation)
- [Structure du projet](#structure-du-projet)
- [Captures d'écran](#captures-décran)
- [Auteur](#auteur)
- [Licence](#licence)

---

## 📖 À propos

**Blog Estrie** est un projet de blog et portfolio développé avec PHP, MySQL et Bootstrap. Il permet de publier des articles sur la région de l'Estrie (Sherbrooke, Mont-Orford, etc.) et de présenter des projets de développement web dans un portfolio interactif.

Le projet inclut :
- 🔐 Un système d'authentification complet
- 👤 Une gestion des droits administrateur
- 📝 Un éditeur de texte riche (TinyMCE)
- 🖼️ Un système de gestion d'images
- 🎨 Un design responsive moderne

---

## ✨ Fonctionnalités

### Partie publique
- 🏠 Page d'accueil avec présentation
- 📰 Liste des articles avec pagination visuelle
- 📄 Affichage d'articles complets avec mise en forme
- 💼 Portfolio de projets avec liens GitHub et démo
- 📱 Design responsive (mobile, tablette, desktop)

### Partie administration
- 🔐 Connexion / Déconnexion sécurisée
- 👥 Système de gestion des utilisateurs
- 🛡️ Protection par droits administrateur
- ✍️ **Éditeur WYSIWYG TinyMCE** pour la rédaction
- 📝 CRUD complet pour les articles :
  - Création avec éditeur riche
  - Modification avec prévisualisation
  - Suppression avec confirmation
  - Upload d'images (max 5 MB)
  - Génération automatique de slugs
- 🏗️ CRUD complet pour les projets :
  - Gestion des liens GitHub et démo
  - Upload d'images de couverture
  - Description avec mise en forme
- 💬 Messages flash pour le feedback utilisateur
- 📊 Tableau de bord administrateur

---

## 🛠️ Technologies utilisées

### Backend
- **PHP 8.3+** - Langage serveur
- **MySQL 8.0+** - Base de données
- **PDO** - Accès sécurisé à la base de données

### Frontend
- **HTML5 / CSS3** - Structure et style
- **JavaScript (ES6+)** - Interactivité
- **Bootstrap 5.3.2** - Framework CSS responsive
- **Sass** - Préprocesseur CSS
- **Font Awesome 6.4.0** - Icônes
- **TinyMCE 6** - Éditeur de texte WYSIWYG

### Outils
- **Git / GitHub** - Gestion de versions
- **VS Code** - Éditeur de code
- **Adminer** - Administration de base de données
- **npm / Node.js** - Gestion des dépendances (Sass)

---

## 📦 Prérequis

Avant de commencer, assurez-vous d'avoir installé :

- **PHP 8.3 ou supérieur**
- **MySQL 8.0 ou supérieur**
- **Node.js et npm** (pour Sass)
- **Git**

---

## 🚀 Installation

### 1. Cloner le repository
```bash
git clone https://github.com/NicolasClaverol/blog-estrie.git
cd blog-estrie
```

### 2. Configurer la base de données

**Créer la base de données :**
```bash
mysql -u root -p
```
```sql
CREATE DATABASE blog_estrie CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'admin'@'localhost' IDENTIFIED BY 'Admin123';
GRANT ALL PRIVILEGES ON blog_estrie.* TO 'admin'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

**Importer la structure :**
```bash
mysql -u admin -p blog_estrie < database/schema.sql
```

### 3. Configurer les paramètres de connexion

Ouvrir `includes/database.php` et vérifier les paramètres :
```php
$host = 'localhost';
$dbname = 'blog_estrie';
$username = 'admin';
$password = 'Admin123';
```

### 4. Installer les dépendances Sass
```bash
npm install
```

### 5. Compiler le CSS
```bash
npx sass assets/scss/custom.scss assets/css/style.css
```

### 6. Créer le dossier uploads
```bash
mkdir uploads
chmod 755 uploads
```

### 7. Lancer le serveur PHP
```bash
php -S localhost:8000
```

### 8. Accéder au site

Ouvrir votre navigateur et aller sur :
```
http://localhost:8000
```

---

## 👤 Utilisation

### Compte administrateur par défaut
```
Email : admin@blogestrie.com
Mot de passe : password
```

⚠️ **Important** : Changez ces identifiants en production !

### Créer du contenu

1. **Connectez-vous** avec le compte admin
2. Accédez au **menu Admin** dans le header
3. Choisissez :
   - **Gérer les articles** pour créer des articles
   - **Gérer les projets** pour ajouter des projets à votre portfolio
4. Utilisez l'**éditeur TinyMCE** pour mettre en forme votre contenu

### Workflow de publication
```
Admin → Créer un article → Rédiger avec TinyMCE → Ajouter une image → Publier
                                                    ↓
                                        Visible sur la page Articles
```

---

## 📁 Structure du projet
```
blog-estrie/
├── admin/                      # Pages d'administration
│   ├── dashboard.php           # Tableau de bord
│   ├── articles.php            # Gestion des articles
│   ├── create_article.php      # Création d'article (TinyMCE)
│   ├── edit_article.php        # Modification d'article (TinyMCE)
│   ├── delete_article.php      # Suppression d'article
│   ├── projets.php             # Gestion des projets
│   ├── create_projet.php       # Création de projet (TinyMCE)
│   ├── edit_projet.php         # Modification de projet (TinyMCE)
│   └── delete_projet.php       # Suppression de projet
├── assets/
│   ├── css/                    # Fichiers CSS compilés
│   ├── scss/                   # Fichiers Sass sources
│   ├── js/                     # Scripts JavaScript
│   └── images/                 # Images du thème
├── includes/
│   ├── database.php            # Connexion PDO à MySQL
│   ├── session.php             # Gestion des sessions
│   ├── header.php              # En-tête commun
│   └── footer.php              # Pied de page commun
├── uploads/                    # Images uploadées par les utilisateurs
├── index.php                   # Page d'accueil
├── articles.php                # Liste publique des articles
├── article.php                 # Affichage d'un article
├── projets.php                 # Portfolio public
├── projet.php                  # Affichage d'un projet
├── register.php                # Inscription
├── login.php                   # Connexion
├── profile.php                 # Profil utilisateur
├── logout.php                  # Déconnexion
├── .gitignore                  # Fichiers ignorés par Git
├── package.json                # Dépendances npm
├── PROGRESSION.md              # Documentation du développement
└── README.md                   # Ce fichier
```

---

## 📸 Captures d'écran

### Page d'accueil
*Une présentation accueillante avec navigation claire*

### Liste des articles
*Grille responsive avec extraits et images*

### Éditeur TinyMCE
*Interface WYSIWYG professionnelle pour la rédaction*

### Portfolio
*Présentation des projets avec liens GitHub et démo*

### Dashboard Admin
*Centre de contrôle pour la gestion du contenu*

---

## 🔒 Sécurité

Le projet intègre plusieurs mesures de sécurité :

- ✅ **Mots de passe hashés** avec `password_hash()` et `password_verify()`
- ✅ **Protection contre les injections SQL** avec PDO et requêtes préparées
- ✅ **Protection XSS** avec `htmlspecialchars()` sur les données utilisateur
- ✅ **Sessions sécurisées** avec gestion des droits
- ✅ **Validation côté serveur** de tous les formulaires
- ✅ **Upload d'images sécurisé** avec vérification de type et taille
- ✅ **Protection CSRF** via tokens de session
- ✅ **Pages admin protégées** par authentification

---

## 🎨 Personnalisation

### Changer les couleurs (thème Estrie)

Modifiez `assets/scss/custom.scss` :
```scss
$primary: #2C5F2D;    // Vert forêt
$secondary: #8B4513;  // Brun automnal
$success: #4A7C59;    // Vert nature
$info: #5B9BD5;       // Bleu lac
```

Puis recompilez :
```bash
npx sass assets/scss/custom.scss assets/css/style.css
```

### Watch automatique

Pour recompiler automatiquement à chaque modification :
```bash
npx sass --quiet-deps --watch assets/scss/custom.scss:assets/css/style.css
```

---

## 🚧 Améliorations futures

- [ ] Système de commentaires avec modération
- [ ] Pagination pour les articles et projets
- [ ] Recherche full-text
- [ ] Catégories et tags
- [ ] Système de vues/statistiques
- [ ] Export de contenu
- [ ] Mode sombre
- [ ] Multi-langue (FR/EN)
- [ ] API REST pour les données

---

## 👨‍💻 Auteur

**Nicolas Claverol**

- 🌐 GitHub : [@NicolasClaverol](https://github.com/NicolasClaverol)
- 📧 Email : [nicolas.claverol@gmail.com]


---

## 📝 Licence

Ce projet est développé dans le cadre de la formation **Believemy - Projet Passerelle #2**.

Libre d'utilisation pour un usage éducatif et personnel.

---

## 🙏 Remerciements

- **Believemy** pour la formation et le projet
- **Bootstrap** pour le framework CSS
- **TinyMCE** pour l'éditeur de texte
- **Font Awesome** pour les icônes
- La communauté open-source

---

## 📞 Support

Pour toute question ou problème :

1. Consultez la [documentation](PROGRESSION.md)
2. Ouvrez une [issue](https://github.com/NicolasClaverol/blog-estrie/issues)
3. Contactez-moi directement

---

**⭐ Si ce projet vous a plu, n'hésitez pas à lui donner une étoile sur GitHub !**

---

*Développé avec ❤️ et ☕ par Nicolas Claverol*