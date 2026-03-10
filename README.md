# 🏔️ Blog Estrie - Découverte de Sherbrooke et ses environs

Blog et portfolio personnel sur la magnifique région de l'Estrie au Québec visitée récemment. Projet réalisé dans le cadre de la formation **Believemy - Projet Passerelle #2**.

![Estrie](https://via.placeholder.com/1200x400/2C5F2D/FFFFFF?text=Blog+Estrie)

---

## 📋 Table des matières

- [Présentation](#-présentation)
- [Fonctionnalités](#-fonctionnalités)
- [Technologies utilisées](#-technologies-utilisées)
- [Installation](#-installation)
- [Utilisation](#-utilisation)
- [Structure du projet](#-structure-du-projet)
- [Captures d'écran](#-captures-décran)
- [Auteur](#-auteur)

---

## 🎯 Présentation

**Blog Estrie** est une plateforme web complète permettant de :
- Découvrir la région de l'Estrie à travers des articles 
- Consulter un portfolio de projets personnels
- Gérer du contenu via un espace administrateur sécurisé

Le projet met en avant les paysages, l'histoire et les attractions de Sherbrooke et ses environs, tout en démontrant des compétences en développement web full-stack.

---

## ✨ Fonctionnalités

### 🔐 Authentification
- Inscription et connexion des utilisateurs
- Système de sessions sécurisé
- Gestion des droits (administrateur / utilisateur)
- Protection des pages admin

### 📝 Gestion des articles
- **CRUD complet** : Création, lecture, modification, suppression
- **Éditeur WYSIWYG** : TinyMCE 6 pour une mise en forme riche
- Upload et gestion d'images
- Génération automatique de slugs
- Affichage public responsive avec extraits

### 🚀 Gestion des projets (Portfolio)
- CRUD complet avec éditeur TinyMCE
- Liens GitHub et démo pour chaque projet
- Upload d'images
- Affichage en grille responsive

### 🎨 Design
- Interface moderne avec Bootstrap 5.3.2
- Personnalisation Sass avec palette de couleurs Estrie
- Design responsive (mobile, tablette, desktop)
- Effets visuels au survol
- Messages flash de feedback

---

## 🛠️ Technologies utilisées

### Frontend
- **HTML5** / **CSS3** / **JavaScript**
- **Bootstrap 5.3.2** - Framework CSS responsive
- **Sass** - Préprocesseur CSS avec personnalisation
- **Font Awesome 6.4.0** - Icônes
- **TinyMCE 6** - Éditeur WYSIWYG

### Backend
- **PHP 8.3** - Langage serveur
- **MySQL 8.0** - Base de données relationnelle
- **PDO** - Accès sécurisé à la base de données
- **Sessions PHP** - Gestion de l'authentification

### Outils
- **Git / GitHub** - Versioning et collaboration
- **npm** - Gestion des dépendances frontend
- **VS Code** - Environnement de développement
- **Adminer** - Administration de la base de données

---

## 💻 Installation

### Prérequis
- PHP 8.0 ou supérieur
- MySQL 5.7 ou supérieur
- npm (pour compiler Sass)
- Git

### Étapes d'installation

1. **Cloner le repository**
```bash
git clone https://github.com/NicolasClaverol/blog-estrie.git
cd blog-estrie
```

2. **Installer les dépendances npm**
```bash
npm install
```

3. **Compiler Sass**
```bash
npx sass assets/scss/custom.scss assets/css/style.css
```

4. **Créer la base de données**
```sql
CREATE DATABASE blog_estrie CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
```

5. **Importer la structure**

Créez les tables suivantes dans votre base de données :
```sql
-- Table users
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    is_admin BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table articles
CREATE TABLE articles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(200) NOT NULL,
    slug VARCHAR(200) UNIQUE NOT NULL,
    contenu TEXT NOT NULL,
    image VARCHAR(255),
    user_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Table projets
CREATE TABLE projets (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(200) NOT NULL,
    slug VARCHAR(200) UNIQUE NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255),
    lien_github VARCHAR(255),
    lien_demo VARCHAR(255),
    user_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Table commentaires (optionnel)
CREATE TABLE commentaires (
    id INT PRIMARY KEY AUTO_INCREMENT,
    article_id INT,
    user_id INT,
    contenu TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

6. **Configurer la connexion à la base de données**

Modifiez le fichier `includes/database.php` avec vos identifiants :
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'blog_estrie');
define('DB_USER', 'votre_utilisateur');
define('DB_PASS', 'votre_mot_de_passe');
```

7. **Créer le compte administrateur**

Inscrivez-vous via `/register.php`, puis mettez à jour manuellement en base :
```sql
UPDATE users SET is_admin = 1 WHERE email = 'votre@email.com';
```

8. **Démarrer le serveur PHP**
```bash
php -S localhost:8000
```

9. **Accéder au site**

Ouvrez votre navigateur sur : **http://localhost:8000**

---

## 🎮 Utilisation

### Espace public
- **Page d'accueil** : `/index.php`
- **Liste des articles** : `/articles.php`
- **Article complet** : `/article.php?slug=...`
- **Portfolio** : `/projets.php`
- **Projet complet** : `/projet.php?slug=...`

### Authentification
- **Inscription** : `/register.php`
- **Connexion** : `/login.php`
- **Déconnexion** : `/logout.php`

### Espace administrateur
- **Dashboard** : `/admin/dashboard.php`
- **Gestion des articles** : `/admin/articles.php`
- **Gestion des projets** : `/admin/projets.php`

### Compte administrateur par défaut
- **Email** : `admin@blogestrie.com`
- **Mot de passe** : `password`
- ⚠️ **Changez ce mot de passe en production !**

---

## 📁 Structure du projet
```
blog-estrie/
├── admin/                     # Espace administrateur
│   ├── dashboard.php
│   ├── articles.php
│   ├── create_article.php
│   ├── edit_article.php
│   ├── delete_article.php
│   ├── projets.php
│   ├── create_projet.php
│   ├── edit_projet.php
│   └── delete_projet.php
├── assets/
│   ├── css/
│   │   └── style.css          # CSS compilé depuis Sass
│   ├── scss/
│   │   └── custom.scss        # Styles personnalisés + Bootstrap
│   ├── js/
│   └── images/
├── includes/
│   ├── database.php           # Connexion PDO
│   ├── session.php            # Gestion sessions et droits
│   ├── header.php             # En-tête réutilisable
│   └── footer.php             # Pied de page
├── uploads/                   # Images uploadées
│   ├── articles/
│   ├── projets/
│   └── tinymce/
├── index.php                  # Page d'accueil
├── register.php               # Inscription
├── login.php                  # Connexion
├── logout.php                 # Déconnexion
├── profile.php                # Profil utilisateur
├── articles.php               # Liste publique des articles
├── article.php                # Article complet
├── projets.php                # Portfolio
├── projet.php                 # Projet complet
├── adminer.php                # Administration BDD
├── package.json               # Dépendances npm
├── .gitignore
├── PROGRESSION.md             # Documentation détaillée
└── README.md                  # Ce fichier
```

---

## 📸 Captures d'écran

### Page d'accueil
![Accueil](https://via.placeholder.com/800x400/2C5F2D/FFFFFF?text=Page+Accueil)

### Liste des articles
![Articles](https://via.placeholder.com/800x400/4A7C59/FFFFFF?text=Liste+Articles)

### Dashboard admin
![Dashboard](https://via.placeholder.com/800x400/5B9BD5/FFFFFF?text=Dashboard+Admin)

### Éditeur TinyMCE
![TinyMCE](https://via.placeholder.com/800x400/D4A574/FFFFFF?text=Editeur+TinyMCE)

---

## 🎨 Palette de couleurs Estrie

| Couleur | Hex | Usage |
|---------|-----|-------|
| **Vert forêt** | `#2C5F2D` | Couleur principale |
| **Brun automnal** | `#8B4513` | Secondaire |
| **Vert nature** | `#4A7C59` | Succès |
| **Bleu lac** | `#5B9BD5` | Info |
| **Ocre automne** | `#D4A574` | Warning |
| **Rouge érable** | `#A52A2A` | Danger |

---

## 🚀 Améliorations futures

- [ ] Système de commentaires sous les articles
- [ ] Pagination des articles et projets
- [ ] Recherche et filtres
- [ ] Catégories et tags
- [ ] Statistiques détaillées dans le dashboard
- [ ] Newsletter
- [ ] Mode sombre

---

## 👨‍💻 Auteur

**Nicolas Claverol**

- GitHub : [@NicolasClaverol](https://github.com/NicolasClaverol)
- Repository : [blog-estrie](https://github.com/NicolasClaverol/blog-estrie)

---

## 📜 Licence

Ce projet a été réalisé dans le cadre de la formation **Believemy** - Projet Passerelle #2.

---

## 🙏 Remerciements

- **Believemy et Louis-Nicolas** pour la formation et les ressources
- La magnifique région de l'**Estrie** pour l'inspiration
- La communauté **Bootstrap** et **TinyMCE**

---

**⭐ Si ce projet vous plaît, n'hésitez pas à lui donner une étoile sur GitHub !**