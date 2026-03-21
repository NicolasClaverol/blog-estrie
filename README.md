# 🏔️ Blog Estrie - Découverte de Sherbrooke et ses environs

Blog et portfolio personnel sur la magnifique région de l'Estrie au Québec. Projet réalisé dans le cadre de la formation **Believemy - Projet Passerelle #2**.

---

## 📋 Table des matières

- [Présentation](#présentation)
- [Fonctionnalités](#fonctionnalités)
- [Technologies utilisées](#technologies-utilisées)
- [Installation](#installation)
- [Utilisation](#utilisation)
- [Structure du projet](#structure-du-projet)
- [Auteur](#auteur)

## 🎬 Vidéo de démonstration

[▶️ Voir la démonstration complète du projet](https://youtu.be/68w1oRthuU8)

*Vidéo non répertoriée - Accessible uniquement via ce lien*
---

## 🎯 Présentation

**Blog Estrie** est une plateforme web complète permettant de :
- Découvrir la région de l'Estrie à travers des articles illustrés
- Consulter un portfolio de projets personnels
- Gérer du contenu via un espace administrateur sécurisé

Le projet met en avant les paysages, l'histoire et les attractions de Sherbrooke et ses environs.

---

## ✨ Fonctionnalités

### Authentification
- Inscription et connexion des utilisateurs
- Système de sessions sécurisé
- Gestion des droits administrateur
- Protection des pages admin

### Gestion des articles
- CRUD complet (Création, Lecture, Modification, Suppression)
- Éditeur WYSIWYG avec TinyMCE
- Upload et gestion d'images
- Génération automatique de slugs
- Affichage public responsive

### Gestion des projets (Portfolio)
- CRUD complet avec éditeur TinyMCE
- Liens GitHub et démo
- Upload d'images
- Affichage en grille responsive

### Design
- Interface moderne avec Bootstrap 5.3.2
- Personnalisation Sass avec palette Estrie
- Design responsive (mobile, tablette, desktop)
- Effets visuels au survol

---

## 🛠️ Technologies utilisées

### Frontend
- HTML5 / CSS3 / JavaScript
- Bootstrap 5.3.2
- Sass
- Font Awesome 6.4.0
- TinyMCE 6

### Backend
- PHP 8.3
- MySQL 8.0
- PDO
- Sessions PHP

### Outils
- Git / GitHub
- npm
- VS Code
- Adminer

---

## 💻 Installation

### Prérequis
- PHP 8.0 ou supérieur
- MySQL 5.7 ou supérieur
- npm
- Git

### Étapes

1. Cloner le repository
```bash
git clone https://github.com/NicolasClaverol/blog-estrie.git
cd blog-estrie
```

2. Installer les dépendances
```bash
npm install
```

3. Compiler Sass
```bash
npx sass assets/scss/custom.scss assets/css/style.css
```

4. Créer la base de données
```sql
CREATE DATABASE blog_estrie CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
```

5. Importer les tables (voir structure dans le code)

6. Configurer la connexion dans `includes/database.php`

7. Démarrer le serveur
```bash
php -S localhost:8000
```

8. Accéder au site : http://localhost:8000

---

## 🎮 Utilisation

### Compte administrateur par défaut
- Email : admin@blogestrie.com
- Mot de passe : password

### Pages principales
- Page d'accueil : `/index.php`
- Articles : `/articles.php`
- Projets : `/projets.php`
- Dashboard admin : `/admin/dashboard.php`

---

## 📁 Structure du projet
```
blog-estrie/
├── admin/              # Espace administrateur
├── assets/             # CSS, SCSS, JS, images
├── includes/           # Fichiers réutilisables
├── uploads/            # Images uploadées
├── index.php           # Page d'accueil
├── articles.php        # Liste des articles
├── projets.php         # Portfolio
└── README.md
```

---

## 👨‍💻 Auteur

**Nicolas Claverol**

- GitHub : [@NicolasClaverol](https://github.com/NicolasClaverol)
- Repository : [blog-estrie](https://github.com/NicolasClaverol/blog-estrie)

---

## 📜 Licence

Projet réalisé dans le cadre de la formation **Believemy** - Projet Passerelle #2.

---

**⭐ Si ce projet vous plaît, n'hésitez pas à lui donner une étoile sur GitHub !**