# CMS Simple — Boilerplate Symfony pour sites vitrine

Boilerplate réutilisable pour créer des **sites vitrine clients** avec Symfony 8. Clonez-le, configurez-le, déployez. Conçu pour être personnalisé entièrement depuis un panneau d'administration sans toucher au code.

## Fonctionnalités

- **Landing page modulaire** — sections activables/désactivables, ordre par glisser-déposer
- **Actualités** — gestion complète (créer, publier, dépublier, supprimer) avec image
- **Formulaire de contact** — sauvegarde en base + envoi d'e-mail + protection honeypot
- **Panneau d'administration** — protégé par mot de passe, interface Bootstrap
- **Multilingue FR + AR** — Arabic avec support RTL complet, switcher de langue intégré
- **Thème personnalisable** — couleurs, polices, textes modifiables sans code depuis l'admin
- **Zéro CDN** — Bootstrap 5, Bootstrap Icons et toutes les dépendances en local via npm

---

## Stack technique

| Couche | Technologie |
|---|---|
| Framework | Symfony 8.0 (PHP 8.4+) |
| Base de données | MySQL 8+ via Doctrine ORM |
| Templates | Twig |
| CSS | Bootstrap 5 + Sass (Webpack Encore) |
| JS | Vanilla JS + Stimulus (Webpack Encore) |
| E-mails | Symfony Mailer |
| Traductions | Symfony Translation (FR + AR) |

---

## Prérequis

- PHP 8.4+
- Composer
- Node.js 18+ et npm
- MySQL 8+
- Symfony CLI (recommandé)

---

## Installation

### 1. Cloner et installer les dépendances

```bash
git clone <repo-url> mon-projet
cd mon-projet
composer install
npm install
```

### 2. Configurer l'environnement

Créer un fichier `.env.local` à la racine :

```dotenv
DATABASE_URL="mysql://utilisateur:motdepasse@127.0.0.1:3306/nom_base?serverVersion=8.0.32&charset=utf8mb4"
MAILER_DSN=smtp://user:pass@smtp.example.com:587
ADMIN_PASSWORD_HASH='$2y$13$...'   # voir étape 4
```

> Ne jamais mettre de données entreprise (nom, logo, etc.) dans `.env`. Tout se configure depuis l'admin après installation.

### 3. Créer la base de données et lancer les migrations

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load   # initialise SiteSettings et LandingPageContent
```

### 4. Définir le mot de passe administrateur

```bash
php bin/console security:hash-password
```

Copiez le hash produit dans `.env.local` :

```dotenv
ADMIN_PASSWORD_HASH='$2y$13$le-hash-genere-ici'
```

### 5. Compiler les assets

```bash
npm run dev          # développement (une fois)
npm run watch        # développement (avec rechargement automatique)
npm run build        # production
```

### 6. Lancer le serveur

```bash
symfony server:start
```

Le site est accessible sur `http://127.0.0.1:8000`.
L'administration est accessible sur `http://127.0.0.1:8000/admin`.

---

## Structure du projet

```
├── assets/
│   ├── _interactions.js        # Interactions JS partagées (LTR + RTL)
│   ├── app.js                  # Entry point LTR (français)
│   ├── app_rtl.js              # Entry point RTL (arabe)
│   ├── admin.js                # Entry point panneau admin
│   ├── stimulus_bootstrap.js   # Initialisation Stimulus
│   └── styles/
│       ├── _variables.scss     # Surcharges Bootstrap (build-time)
│       ├── _custom.scss        # Thème custom (animations, hover, scroll)
│       ├── app.scss            # Feuille de style LTR
│       ├── app-rtl.scss        # Feuille de style RTL ($enable-rtl: true)
│       └── admin.scss          # Feuille de style admin
├── src/
│   ├── Controller/
│   │   ├── HomeController.php          # Page d'accueil + landing
│   │   ├── ContactController.php       # Formulaire de contact
│   │   └── Admin/
│   │       ├── DashboardController.php
│   │       ├── ActualiteController.php
│   │       ├── LandingController.php   # Éditeur landing page
│   │       ├── SettingsController.php  # Paramètres site
│   │       ├── MessageController.php   # Messages reçus
│   │       └── SecurityController.php  # Login/logout
│   ├── Entity/
│   │   ├── SiteSettings.php        # Singleton — infos entreprise
│   │   ├── LandingPageContent.php  # Singleton — contenu visuel landing
│   │   ├── Actualite.php           # Articles d'actualité
│   │   └── ContactMessage.php      # Messages du formulaire contact
│   ├── Form/
│   │   ├── SiteSettingsType.php
│   │   ├── LandingPageContentType.php  # Onglets : Couleurs / Typo / Hero / ...
│   │   ├── ActualiteType.php
│   │   └── ContactType.php
│   └── Service/
│       ├── SiteSettingsService.php     # Proxy Twig → {{ settings.* }}
│       ├── LandingContentService.php   # Proxy Twig → {{ lp.* }}
│       └── ContactMailer.php
├── templates/
│   ├── base.html.twig              # Layout public (injection CSS vars)
│   ├── partials/
│   │   ├── _navbar.html.twig       # Navbar partagée
│   │   └── _footer.html.twig       # Footer partagé
│   ├── home/index.html.twig        # Landing page (sections dynamiques)
│   ├── contact/index.html.twig     # Page contact dédiée
│   └── admin/                      # Templates panneau admin
├── translations/
│   ├── messages.fr.yaml
│   └── messages.ar.yaml
└── migrations/                     # Migrations Doctrine incrémentales
```

---

## Administration

### Accès

```
URL      : /admin/login
Login    : admin
Password : défini via ADMIN_PASSWORD_HASH dans .env.local
```

### Sections disponibles

| Section | Description |
|---|---|
| **Tableau de bord** | Vue d'ensemble — statistiques rapides |
| **Actualités** | Créer, éditer, publier/dépublier, supprimer des articles |
| **Paramètres** | Nom du site, logo, favicon, coordonnées, réseaux sociaux |
| **Landing page** | Éditeur visuel complet par onglets |
| **Messages** | Consultation des messages reçus via le formulaire |

### Éditeur landing page (onglets)

| Onglet | Contenu |
|---|---|
| Couleurs | Palette complète (primaire, secondaire, navbar, footer…) |
| Typographie | Polices Google Fonts, taille de base |
| Hero | Titre, sous-titre, image de fond, bouton CTA |
| Sections | Activation/désactivation de chaque bloc |
| À propos | Texte et image de la section about |
| Blocs prédéfinis | Services, FAQ, témoignages, galerie, partenaires, CTA, social |
| Ordre des blocs | Glisser-déposer pour réordonner les sections |

---

## Sections de la landing page

| ID section | Activée par | Source du contenu |
|---|---|---|
| `hero` | Toujours | `lp.heroTitle`, `lp.heroSubtitle`, image/couleur fond |
| `about` | `lp.aboutEnabled` | `lp.aboutTitle`, `lp.aboutText`, `lp.aboutImage` |
| `actualites` | Toujours | 6 derniers articles publiés |
| `services` | `lp.servicesEnabled` | 3 cartes : titre, description, image |
| `social` | `lp.socialBlockEnabled` | Liens réseaux sociaux depuis `settings.*Url` |
| `faq` | `lp.faqEnabled` | 3 questions/réponses |
| `testimonials` | `lp.testimonialsEnabled` | 3 témoignages avec auteur et rôle |
| `gallery` | `lp.galleryEnabled` | Jusqu'à 6 images |
| `partners` | `lp.partnersEnabled` | Jusqu'à 6 partenaires (logo + nom) |
| `cta` | `lp.ctaBlockEnabled` | Titre, texte, bouton, couleurs personnalisables |
| `contact` | Toujours | Coordonnées depuis `settings.*` |

L'ordre d'affichage est configurable par glisser-déposer dans l'onglet **"Ordre des blocs"**.

---

## Multilingue

Les routes publiques sont préfixées par `{_locale}` :

```
/fr/          → Français (LTR)
/ar/          → Arabe (RTL)
```

- La direction RTL est appliquée via `dir="rtl"` sur `<html>` + un build CSS séparé (`app_rtl`)
- Les traductions sont dans `translations/messages.fr.yaml` et `messages.ar.yaml`
- Le panneau d'administration est en français uniquement (pas de préfixe locale)

Pour ajouter une langue, créer `messages.<code>.yaml` et ajouter la locale dans `config/packages/translation.yaml`.

---

## Thème et couleurs

Le thème fonctionne sur deux niveaux :

1. **Build-time** : variables SCSS dans `assets/styles/_variables.scss` — définissent les valeurs Bootstrap par défaut (`$primary`, `$border-radius`, etc.)
2. **Runtime** : propriétés CSS custom injectées par `base.html.twig` depuis `lp.*` — permettent de changer les couleurs sans recompiler

Dans les templates et le CSS, utiliser toujours `var(--color-primary)` et non une couleur en dur.

---

## Déploiement

```bash
# 1. Variables d'environnement production
APP_ENV=prod
APP_SECRET=<secret-aleatoire>
DATABASE_URL="mysql://..."
MAILER_DSN="smtp://..."
ADMIN_PASSWORD_HASH='...'

# 2. Dépendances et assets
composer install --no-dev --optimize-autoloader
npm ci && npm run build

# 3. Base de données
php bin/console doctrine:migrations:migrate --no-interaction

# 4. Cache
php bin/console cache:clear
php bin/console cache:warmup

# 5. Permissions
chmod -R 775 var/ public/uploads/
```

---

## Commandes utiles

```bash
# Cache
php bin/console cache:clear

# Routes disponibles
php bin/console debug:router

# Migrations
php bin/console doctrine:migrations:migrate
php bin/console doctrine:migrations:diff       # générer après modif entity
php bin/console doctrine:fixtures:load         # réinitialiser les données par défaut

# Régénérer le hash du mot de passe admin
php bin/console security:hash-password

# Assets
npm run dev        # build développement
npm run watch      # build + watch
npm run build      # build production

# Tests
vendor/bin/phpunit
```

---

## Adapter pour un nouveau client

1. Cloner le dépôt
2. Suivre les étapes d'installation
3. Se connecter à `/admin` et remplir :
   - **Paramètres** : nom, logo, favicon, coordonnées, réseaux sociaux
   - **Landing page** : couleurs, polices, textes de chaque section
4. Activer/désactiver les sections depuis l'onglet "Sections" et les réordonner
5. Créer les premières actualités
6. Déployer

Aucune modification de code n'est nécessaire pour personnaliser un site client standard.

---

## Licence

Projet privé — usage interne.
