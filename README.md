# Humanitarian Foundation 2026 - Plateforme Humanitaire Ultra Moderne

## 🌟 Description

Plateforme humanitaire professionnelle développée avec les dernières technologies web (2026). 
Site vitrine et de gestion pour une fondation humanitaire internationale.

## 🛠️ Technologies Utilisées

- **Frontend:** HTML5, Tailwind CSS, CSS3 moderne, JavaScript ES6+
- **Backend:** PHP 8+
- **Base de données:** MySQL
- **Animations:** GSAP 3.12+
- **Architecture:** MVC simplifié

## 📁 Structure du Projet

```
/workspace
├── assets/
│   ├── css/
│   │   └── custom.css          # Styles personnalisés
│   ├── js/
│   │   └── main.js             # JavaScript principal
│   ├── images/                 # Images statiques
│   ├── videos/                 # Vidéos
│   └── uploads/                # Fichiers uploadés
├── admin/
│   ├── index.php               # Dashboard admin
│   ├── login.php               # Connexion admin
│   └── logout.php              # Déconnexion
├── config/
│   ├── config.php              # Configuration générale
│   ├── database.php            # Config base de données
│   └── helpers.php             # Fonctions utilitaires
├── includes/
│   ├── Database.php            # Classe de connexion DB
│   ├── header.php              # En-tête commun
│   └── footer.php              # Pied de page commun
├── database/
│   └── schema.sql              # Schéma de la base de données
├── index.php                   # Page d'accueil
├── testimonials.php            # Page témoignages (style TikTok)
├── request-help.php            # Formulaire de demande d'aide
├── contact.php                 # Page de contact
├── about.php                   # À propos (à créer)
├── gallery.php                 # Galerie (à créer)
├── faq.php                     # FAQ (à créer)
├── privacy.php                 # Politique de confidentialité
└── terms.php                   # Conditions d'utilisation
```

## 🚀 Installation

### 1. Prérequis

- PHP 8.0 ou supérieur
- MySQL 5.7+ ou MariaDB 10.3+
- Serveur web (Apache/Nginx) ou PHP built-in server

### 2. Configuration de la Base de Données

```bash
# Importer le schéma SQL
mysql -u root -p < database/schema.sql
```

### 3. Configuration

Modifier `config/database.php` avec vos paramètres:

```php
'host' => 'localhost',
'database' => 'humanitarian_db',
'username' => 'root',
'password' => 'votre_mot_de_passe',
```

### 4. Lancer le Serveur

```bash
# Avec PHP built-in server
php -S localhost:8000

# Ou configurer un vhost Apache/Nginx
```

## 🔐 Accès Admin

- **URL:** `/admin/login.php`
- **Username:** `admin`
- **Password:** `admin123`

⚠️ **Important:** Changez ces identifiants en production!

## ✨ Fonctionnalités

### Frontend
- ✅ Design premium ultra moderne (2026)
- ✅ Responsive Mobile First
- ✅ Animations GSAP fluides
- ✅ Hero section immersive avec vidéo background
- ✅ Section témoignages style TikTok/Reels
- ✅ Formulaire multi-step avec validation
- ✅ Compteurs animés
- ✅ Scroll animations
- ✅ Glassmorphism effects
- ✅ Dark mode natif

### Backend
- ✅ Architecture sécurisée PDO
- ✅ Protection CSRF
- ✅ Validation des données
- ✅ Rate limiting
- ✅ Anti-spam (honeypot)
- ✅ Upload sécurisé de fichiers
- ✅ Logging des activités
- ✅ Session management sécurisé

### Admin Dashboard
- ✅ Authentification sécurisée
- ✅ Statistiques en temps réel
- ✅ Gestion des demandes d'aide
- ✅ Modération des témoignages
- ✅ Interface moderne dark mode

## 🎨 Design System

### Couleurs
- Noir profond: `#000000`
- Blanc pur: `#FFFFFF`
- Bleu royal: `#002366`
- Violet premium: `#6B4C9A`
- Primary Blue: `#3b82f6`
- Primary Purple: `#8b5cf6`

### Typographie
- Inter (corps de texte)
- Poppins (titres)
- Manrope (accents)

### Effets
- Glassmorphism léger
- Gradients modernes
- Glow effects subtils
- Rounded corners XL
- Smooth shadows

## 📱 Pages Créées

1. **Accueil** (`index.php`) - Hero immersif, statistiques, mission
2. **Témoignages** (`testimonials.php`) - Style TikTok/Reels vertical
3. **Demande d'Aide** (`request-help.php`) - Formulaire multi-step sécurisé
4. **Contact** (`contact.php`) - Informations et formulaire
5. **Admin Dashboard** (`admin/index.php`) - Panel de gestion
6. **Admin Login** (`admin/login.php`) - Authentification

## 🔒 Sécurité

- Prepared statements (PDO)
- Sanitization des inputs
- Protection XSS
- Protection CSRF
- Rate limiting
- Honeypot anti-spam
- Hash des mots de passe (bcrypt)
- Sessions sécurisées
- Logging des activités

## 📊 Base de Données

Tables principales:
- `users` - Utilisateurs
- `admins` - Administrateurs
- `donation_requests` - Demandes d'aide
- `testimonials` - Témoignages vidéo
- `media_uploads` - Médias
- `notifications` - Notifications
- `comments` - Commentaires
- `analytics` - Analytics

## 🚧 Pages à Créer

- `about.php` - À propos
- `gallery.php` - Galerie photos
- `faq.php` - FAQ
- `privacy.php` - Politique de confidentialité
- `terms.php` - Conditions d'utilisation

## 📝 Notes

- Les vidéos de témoignages doivent être au format vertical (9:16)
- Optimiser les vidéos pour le web (compression)
- Ajouter un fichier `.htaccess` pour la sécurité en production
- Configurer HTTPS en production
- Mettre en place un CDN pour les assets statiques

## 📄 License

Projet humanitaire - Usage non commercial recommandé

---

**Développé avec ❤️ pour l'humanitaire**
