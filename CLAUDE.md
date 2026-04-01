# CLAUDE.md — Symfony Landing Page Boilerplate

## 🎯 Project Overview

This is a **reusable Symfony boilerplate** for simple client presentation websites.
Each client gets a landing page with:
- A list of news/actualités (manageable by admin)
- A contact form
- A simple admin panel (password protected)
- Multilingual support (French + Arabic)

This boilerplate is cloned for each new client project. Keep it clean, minimal, and easy to customize.

---

## 🏗️ Tech Stack

- **Framework:** Symfony 8.0 (requires PHP 8.4+)
- **PHP:** 8.4+
- **Database:** MySQL (Doctrine ORM)
- **CSS:** Bootstrap 5 OR Tailwind CSS (depends on client project — see below)
- **Assets:** AssetMapper OR Webpack Encore (depends on client project — see below)
- **Templating:** Twig
- **Forms:** Symfony Forms
- **Mailer:** Symfony Mailer (for contact form)
- **i18n:** Symfony Translation component (FR + AR)

---

## 📦 Asset Strategy

### When to use AssetMapper:
- Simple projects, no JS framework needed
- Fast setup, no Node.js required
- Default choice for most landing pages

### When to use Webpack Encore:
- When client needs custom JS components
- When using Tailwind CSS with PostCSS pipeline
- When project requires more complex frontend build

> **Default for this boilerplate:** AssetMapper + Bootstrap 5 (via importmap)
> Switch to Webpack Encore + Tailwind when explicitly requested.

---

## 🗂️ Project Structure

```
src/
├── Controller/
│   ├── HomeController.php
│   ├── ContactController.php
│   └── Admin/
│       ├── DashboardController.php
│       ├── ActualiteController.php
│       ├── MessageController.php
│       ├── SettingsController.php        # Company info (SiteSettings)
│       └── LandingController.php         # Visual customization (LandingPageContent)
├── Entity/
│   ├── Actualite.php
│   ├── ContactMessage.php
│   ├── SiteSettings.php
│   └── LandingPageContent.php
├── Form/
│   ├── ActualiteType.php
│   ├── ContactType.php
│   ├── SiteSettingsType.php
│   └── LandingPageContentType.php        # Organized with tabs (colors / fonts / sections)
├── Repository/
│   ├── ActualiteRepository.php
│   ├── ContactMessageRepository.php
│   ├── SiteSettingsRepository.php
│   └── LandingPageContentRepository.php
├── Service/
│   ├── ContactMailer.php
│   ├── SiteSettingsService.php           # Twig global: {{ settings.* }}
│   └── LandingContentService.php         # Twig global: {{ lp.* }}
└── DataFixtures/
    └── AppFixtures.php                   # Creates SiteSettings + LandingPageContent rows

templates/
├── base.html.twig                        # Injects CSS vars + Google Fonts from lp.*
├── home/
│   └── index.html.twig
├── contact/
│   └── index.html.twig
└── admin/
    ├── dashboard.html.twig
    ├── settings/
    │   └── edit.html.twig                # Company info form
    ├── landing/
    │   └── edit.html.twig                # Visual editor (tabs: Colors / Fonts / Hero / Sections)
    ├── actualite/
    │   ├── index.html.twig
    │   ├── new.html.twig
    │   └── edit.html.twig
    └── message/
        └── index.html.twig

translations/
├── messages.fr.yaml
└── messages.ar.yaml
```

---

## 🧩 Entities

### Actualite
```php
- id: int (auto)
- titre: string (255)
- contenu: text
- image: string (255, nullable) // filename stored in /public/uploads/actualites/
- datePublication: datetime
- isPublished: bool (default: true)
- createdAt: datetime (auto)
```

### SiteSettings
Single-row entity (always id=1). All company info managed from admin panel, never from .env.
```php
- id: int (auto)
- siteName: string (255)              // Nom de la société
- siteTagline: string (255, nullable) // Slogan / sous-titre hero
- logoFilename: string (255, nullable) // stored in /public/uploads/logo/
- faviconFilename: string (255, nullable) // stored in /public/uploads/logo/
- phone: string (50, nullable)
- email: string (255, nullable)        // Contact email displayed publicly
- adminEmail: string (255)             // Where contact form emails are sent
- address: string (500, nullable)
- defaultLocale: string (5)            // 'fr' or 'ar'
- facebookUrl: string (255, nullable)
- instagramUrl: string (255, nullable)
- whatsapp: string (50, nullable)
- footerText: string (500, nullable)
- updatedAt: datetime (auto update)
```

### LandingPageContent
Single-row entity (always id=1). Controls ALL visual and textual customization of the landing page.
```php
- id: int (auto)

// === COLORS ===
- colorPrimary: string (7)             // e.g. #0d6efd — buttons, links, accents
- colorSecondary: string (7)           // e.g. #6c757d
- colorBackground: string (7)          // e.g. #ffffff — page background
- colorText: string (7)                // e.g. #212529 — main body text
- colorNavbarBg: string (7)            // e.g. #ffffff
- colorNavbarText: string (7)          // e.g. #212529
- colorFooterBg: string (7)            // e.g. #212529
- colorFooterText: string (7)          // e.g. #ffffff

// === TYPOGRAPHY ===
- fontBody: string (100)               // Google Font name e.g. "Roboto", "Cairo" (for AR)
- fontHeading: string (100)            // Google Font name e.g. "Poppins"
- fontSizeBase: string (10)            // e.g. "16px"

// === HERO SECTION ===
- heroTitle: string (255)              // Big headline
- heroSubtitle: string (500, nullable) // Sub-headline
- heroBackgroundImage: string (255, nullable) // stored in /public/uploads/hero/
- heroBackgroundColor: string (7, nullable)   // fallback if no image
- heroTextColor: string (7)            // e.g. #ffffff
- heroButtonText: string (100)         // e.g. "Contactez-nous"
- heroButtonColor: string (7)          // button background
- heroButtonTextColor: string (7)      // button text color

// === ACTUALITÉS SECTION ===
- actualitesSectionTitle: string (255) // e.g. "Nos Actualités"
- actualitesSectionSubtitle: string (255, nullable)
- actualitesSectionBg: string (7)      // section background color

// === CONTACT SECTION ===
- contactSectionTitle: string (255)    // e.g. "Contactez-nous"
- contactSectionSubtitle: string (255, nullable)
- contactSectionBg: string (7)

// === ABOUT SECTION (optional block) ===
- aboutEnabled: bool (default: false)
- aboutTitle: string (255, nullable)
- aboutText: text (nullable)
- aboutImage: string (255, nullable)   // stored in /public/uploads/about/

- updatedAt: datetime (auto update)
```

**Rules for LandingPageContent:**
- Always exactly ONE row in DB (id=1)
- Managed from `/admin/landing` — dedicated admin page with a visual, organized form (tabs or sections)
- Injected as Twig global `{{ lp.heroTitle }}`, `{{ lp.colorPrimary }}` etc.
- Colors injected as CSS variables in `base.html.twig`:
```twig
<style>
  :root {
    --color-primary: {{ lp.colorPrimary }};
    --color-secondary: {{ lp.colorSecondary }};
    --color-bg: {{ lp.colorBackground }};
    --color-text: {{ lp.colorText }};
    --color-navbar-bg: {{ lp.colorNavbarBg }};
    --color-footer-bg: {{ lp.colorFooterBg }};
    --color-footer-text: {{ lp.colorFooterText }};
    --bs-primary: {{ lp.colorPrimary }};
    --bs-secondary: {{ lp.colorSecondary }};
  }
</style>
{% if lp.fontBody or lp.fontHeading %}
<link href="https://fonts.googleapis.com/css2?family={{ lp.fontHeading|replace({' ': '+'}) }}:wght@400;600;700&family={{ lp.fontBody|replace({' ': '+'}) }}&display=swap" rel="stylesheet">
<style>
  body { font-family: '{{ lp.fontBody }}', sans-serif; font-size: {{ lp.fontSizeBase }}; }
  h1,h2,h3,h4,h5 { font-family: '{{ lp.fontHeading }}', sans-serif; }
</style>
{% endif %}
```

### ContactMessage
```php
- id: int (auto)
- nom: string (255)
- email: string (255)
- telephone: string (50, nullable)
- message: text
- isRead: bool (default: false)
- createdAt: datetime (auto)
```

---

## 🔐 Admin Panel

- Simple single admin user (no registration needed)
- Prefix all admin routes with `/admin`
- Admin can:
    - Create / Edit / Delete / Publish-Unpublish actualités
    - View / Mark as read / Delete contact messages
    - **Edit company info** via `/admin/settings` (SiteSettings)
    - **Customize landing page** via `/admin/landing` (LandingPageContent) — colors, fonts, texts, images per section
- Admin dashboard shows: total actualités, unread messages count, quick links

### Security approach:
Use Symfony Security with a single admin user defined in `security.yaml` using `memory` provider:
```yaml
security:
    providers:
        admin_provider:
            memory:
                users:
                    admin:
                        password: '%env(ADMIN_PASSWORD_HASH)%'
                        roles: ['ROLE_ADMIN']
```
Password hash stored in `.env.local` (never committed).

---

## 📬 Contact Form

Fields:
- `nom` (string, required)
- `email` (email, required)
- `telephone` (string, nullable)
- `message` (textarea, required)
- Honeypot field for basic spam protection

Behavior:
- On submit: send email via Symfony Mailer + save message in DB (`ContactMessage` entity)
- Show flash message success/error after submission
- Admin can view contact messages in admin panel

---

## 🌍 Multilingual (FR + AR)

- Default locale: `fr`
- Supported locales: `fr`, `ar`
- Language switcher in navbar
- Arabic: RTL layout support (`dir="rtl"` on `<html>` tag when locale = ar)
- All user-facing strings go through `{{ 'key'|trans }}`
- Translation files: `translations/messages.fr.yaml` and `translations/messages.ar.yaml`

Route strategy: prefix with locale `/fr/...` and `/ar/...`

---

## 🎨 Frontend / UI

- Responsive design (mobile-first)
- Bootstrap 5 components: Navbar, Cards for actualités, Modal or page for contact form
- Navbar: Logo (from SiteSettings) + Menu items + Language switcher
- Landing page sections:
    1. Hero section (siteName + siteTagline from SiteSettings + CTA button → contact)
    2. Actualités section (grid of cards, latest 6)
    3. Contact section (form)
    4. Footer (address, phone, email, social links — all from SiteSettings via Twig global)

---

## 🌐 Routes Summary

| Route | Controller | Access |
|-------|-----------|--------|
| `/` | HomeController::index | Public |
| `/contact` | ContactController::index | Public |
| `/admin` | Admin\DashboardController::index | ROLE_ADMIN |
| `/admin/actualites` | Admin\ActualiteController::index | ROLE_ADMIN |
| `/admin/actualites/new` | Admin\ActualiteController::new | ROLE_ADMIN |
| `/admin/actualites/{id}/edit` | Admin\ActualiteController::edit | ROLE_ADMIN |
| `/admin/actualites/{id}/delete` | Admin\ActualiteController::delete | ROLE_ADMIN |
| `/admin/messages` | Admin\MessageController::index | ROLE_ADMIN |
| `/admin/messages/{id}/read` | Admin\MessageController::markRead | ROLE_ADMIN |
| `/admin/messages/{id}/delete` | Admin\MessageController::delete | ROLE_ADMIN |
| `/admin/settings` | Admin\SettingsController::edit | ROLE_ADMIN |
| `/admin/landing` | Admin\LandingController::edit | ROLE_ADMIN |

---

## ⚙️ Environment Variables (.env)

Only **technical/infrastructure** config goes in `.env`. All company data is managed from the admin panel via `SiteSettings`.

```dotenv
APP_ENV=prod
APP_SECRET=change_me

DATABASE_URL="mysql://user:password@127.0.0.1:3306/landing_page_db"

MAILER_DSN=smtp://user:pass@smtp.mailtrap.io:2525

ADMIN_PASSWORD_HASH=   # Generate with: php bin/console security:hash-password
```

> ⚠️ Never put `SITE_NAME`, `SITE_PHONE`, `SITE_EMAIL`, etc. in `.env`.
> These are managed by the client from `/admin/settings`.

---

## 🚀 Setup Instructions (for each new client project)

```bash
# 1. Clone boilerplate
git clone https://github.com/farahsatech/symfony-landing-boilerplate.git client-project-name
cd client-project-name

# 2. Install dependencies
composer install

# 3. Configure environment
cp .env .env.local
# Edit .env.local: DATABASE_URL, MAILER_DSN, ADMIN_PASSWORD_HASH

# 4. Setup database
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

# 5. Load default settings (creates SiteSettings row id=1)
php bin/console doctrine:fixtures:load

# 6. Generate admin password
php bin/console security:hash-password
# Paste the hash into .env.local as ADMIN_PASSWORD_HASH

# 7. Install assets (AssetMapper)
php bin/console importmap:install
php bin/console asset-map:compile

# 8. Clear cache
php bin/console cache:clear --env=prod

# 9. Login to admin and fill in company settings
# Go to: https://your-domain.com/admin/settings
```

---

## 📋 Development Rules & Preferences

- **Always use Symfony 8 syntax** — PHP 8.4 features welcome (property hooks, asymmetric visibility, etc.)
- **No deprecated APIs** — Symfony 8 has zero deprecated layers, keep it that way
- **Route attributes** on controllers, never YAML routing files
- **Twig attributes** — use `#[TwigFilter]` and `#[TwigFunction]` directly on methods (new in Symfony 8)
- **Keep controllers thin** — business logic in Services
- **Use Symfony Forms** for all forms (never raw HTML forms without FormType)
- **Flash messages** for all user feedback (success/error)
- **Image uploads** stored in `/public/uploads/actualites/`, use VichUploaderBundle OR manual upload handling
- **No hardcoded strings** in Twig — always use `trans` filter
- **AssetMapper by default** — only switch to Webpack Encore if explicitly asked
- **Mobile-first** responsive design always
- **No unused bundles** — keep composer.json minimal

---

## 🔧 Useful Commands

```bash
# Create entity
php bin/console make:entity

# Create form
php bin/console make:form

# Create CRUD
php bin/console make:crud

# Run migrations
php bin/console doctrine:migrations:migrate

# Clear cache
php bin/console cache:clear

# Hash password for admin
php bin/console security:hash-password

# Check routes
php bin/console debug:router

# Compile assets (production)
php bin/console asset-map:compile
```

---

## 📝 Notes for Claude Code

- When generating code, always follow the structure defined above
- For each new feature, ask if AssetMapper or Webpack Encore is being used before generating asset-related code
- Admin panel uses Bootstrap 5 admin-style layout (sidebar or top nav)
- Public landing page can use a different, more marketing-oriented Bootstrap layout
- Always generate migrations after entity changes
- Contact form must always save to DB + send email (both, not one or the other)
- **SiteSettings is always id=1** — `SettingsController` fetches id=1, never creates a new row
- **LandingPageContent is always id=1** — `LandingController` fetches id=1, never creates a new row
- **Both services** (`SiteSettingsService` + `LandingContentService`) must be registered as Twig globals in `config/packages/twig.yaml`:
  ```yaml
  twig:
      globals:
          settings: '@App\Service\SiteSettingsService'
          lp: '@App\Service\LandingContentService'
  ```
- **AppFixtures** must insert default rows for both SiteSettings and LandingPageContent on first setup
- **Never use .env for company data** — always SiteSettings or LandingPageContent
- **LandingPageContentType form** must use tabs/sections in the template (Colors tab, Fonts tab, Hero tab, Sections tab) using Bootstrap nav-tabs
- **Color pickers** in the landing editor must use `<input type="color">` with a live preview of the site if possible
- **CSS variables injection** in `base.html.twig` comes from `lp.*`, not from hardcoded values
