# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Reusable Symfony 8.0 boilerplate for client presentation websites. Cloned per client. Features: news/actualités management, contact form, password-protected admin panel, multilingual (FR + AR with RTL), modular landing page with drag-and-drop section ordering.

**Stack:** PHP 8.4+, Symfony 8.0, MySQL (Doctrine ORM), Bootstrap 5 (local via npm), Webpack Encore + Sass, Twig, Symfony Mailer, Symfony Translation.

## Commands

```bash
# Development
php bin/console cache:clear
php bin/console debug:router

# Database
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load   # Seeds SiteSettings (id=1) and LandingPageContent (id=1)

# Admin password
php bin/console security:hash-password   # Paste result into .env.local as ADMIN_PASSWORD_HASH

# Assets (Webpack Encore)
npm install                              # Install JS dependencies
npm run dev                              # Build for development
npm run watch                            # Build + watch for changes
npm run build                            # Build for production

# Tests
vendor/bin/phpunit
```

## Architecture

### Singleton Entities (Critical)
`SiteSettings` and `LandingPageContent` are **always exactly one row in the DB**. Repositories use `findBy([], ['id' => 'ASC'])` and auto-delete duplicates. Controllers fetch via `$repo->getSettings()` / `$repo->getContent()` — never `new Entity()`.

Both are registered as **Twig globals** in `config/packages/twig.yaml`:
```yaml
twig:
    globals:
        settings: '@App\Service\SiteSettingsService'
        lp: '@App\Service\LandingContentService'
```

- `{{ settings.* }}` — company info (name, logo, phone, email, social links, locale flags)
- `{{ lp.* }}` — all visual/content customization

The services use `__get` / `__call` / `__isset` magic to proxy entity getters, so `{{ settings.siteName }}` calls `SiteSettings::getSiteName()` transparently.

### CSS Variables Injection
`base.html.twig` injects `lp.*` as CSS custom properties and loads Google Fonts dynamically. Never hardcode colors or fonts — always use `var(--color-primary)` etc. from CSS or `lp.*` in Twig.

### Dynamic Section Ordering
`LandingPageContent.sectionOrder` (VARCHAR 500) stores a comma-separated list of section IDs (e.g. `hero,about,services,actualites,faq,contact`). The home template iterates this list to render sections in the admin-configured order. The landing editor's **"Ordre des blocs"** tab uses SortableJS for drag-and-drop reordering (synced to a hidden form field).

### Modular Section Blocks
All optional sections are controlled by `lp.*Enabled` boolean flags. Currently available blocks:

| Section ID | Entity flag | Content source |
|---|---|---|
| `hero` | always | `lp.heroTitle`, `lp.heroSubtitle`, etc. |
| `about` | `lp.aboutEnabled` | `lp.aboutTitle/Text/Image` |
| `actualites` | always | `ActualiteRepository::findPublished(6)` |
| `services` | `lp.servicesEnabled` | 3 cards: `lp.serviceCard1/2/3Title/Description/Image` |
| `social` | `lp.socialBlockEnabled` | social links from `settings.*Url` |
| `faq` | `lp.faqEnabled` | translation keys `landing.faq.q1–q3` / `landing.faq.a1–a3` |
| `testimonials` | `lp.testimonialsEnabled` | translation keys `landing.testimonials.item/author1–3` |
| `gallery` | `lp.galleryEnabled` | translation keys `landing.gallery.item1–6` (placeholder) |
| `partners` | `lp.partnersEnabled` | translation keys `landing.partners.item1–6` (placeholder) |
| `cta` | `lp.ctaBlockEnabled` | `lp.ctaBlockTitle/Text/ButtonText/ButtonLink/BlockBg/TextColor` |
| `contact` | always | contact info from `settings.*` |

### Social Networks
`SiteSettings` has fields for: `facebookUrl`, `instagramUrl`, `xUrl`, `linkedinUrl`, `youtubeUrl`, `tiktokUrl`, `whatsapp`. Visibility is controlled by three flags: `showSocialInNavbar`, `showSocialInFooter`, `showSocialInLandingBlock` (the last one enables the dedicated social block in the landing page footer area if `lp.socialBlockEnabled` is also true — the home template checks only `lp.socialBlockEnabled`).

### Upload Directories
All uploads are stored under `public/uploads/`:

| Directory | Used for |
|---|---|
| `uploads/actualites/` | News article images |
| `uploads/logo/` | Site logo and favicon |
| `uploads/hero/` | Hero section background |
| `uploads/about/` | About section image |
| `uploads/services/` | Service card images (cards 1–3) |

### Security
Single admin user via Symfony Security `memory` provider in `security.yaml`. Password hash stored in `.env.local` as `ADMIN_PASSWORD_HASH`. Login at `/admin/login`, firewall protects all `/admin/*` routes. CSRF protection enabled on all POST forms including publish-toggle.

### Contact Form
Must **always** do both: save `ContactMessage` to DB **and** send email via `ContactMailer`. Honeypot field (`website`) for spam protection — checked in `ContactController` before persisting.

### Asset Strategy
- **Webpack Encore** with Sass — Bootstrap 5, Bootstrap Icons, and all dependencies installed locally via npm
- 3 Webpack entry points: `app` (public LTR), `app_rtl` (public RTL/Arabic), `admin` (admin panel)
- Bootstrap variables overridden in `assets/styles/_variables.scss` (build-time defaults)
- Runtime color overrides via CSS custom properties injected in `base.html.twig` from `lp.*`
- Custom theme (animations, hover effects, scroll-to-top) in `assets/styles/_custom.scss`
- Templates use `{{ encore_entry_link_tags() }}` and `{{ encore_entry_script_tags() }}` — NO CDN links

### Multilingual
Routes prefixed with `{_locale}` (`/fr/`, `/ar/`). Arabic: `dir="rtl"` on `<html>`. All user-facing strings use `{{ 'key'|trans }}`. Translation files: `translations/messages.fr.yaml` and `messages.ar.yaml`. Admin panel is French-only (no locale prefix on admin routes).

## Development Rules

- **Symfony 8 syntax** — PHP 8.4 features, no deprecated APIs
- **Route attributes** on controllers, never YAML routing files
- **Thin controllers** — business logic in Services
- **Symfony Forms** for all forms (never raw HTML forms)
- **Flash messages** for all user feedback (keys translated via `trans` filter)
- **No `.env` for company data** — only infrastructure config (DATABASE_URL, MAILER_DSN, ADMIN_PASSWORD_HASH); all company data lives in `SiteSettings`
- **No hardcoded strings** in Twig — always `trans` filter
- **`LandingPageContentType`** uses Bootstrap nav-tabs: Couleurs / Typographie / Hero / Sections / À propos / Blocs prédéfinis / Ordre des blocs
- **Color fields** use `ColorType` → renders as `<input type="color">`; optional color fields that must accept null should use `TextType` instead
- **Always generate migrations** after entity changes — create a new `VersionYYYYMMDDHHmmss.php` incrementally; update `Version20240101000000.php` only when rebuilding from scratch
- **Admin routes** all under `/admin`, protected by `ROLE_ADMIN` via `#[IsGranted]` + `access_control`
- **CSRF** on all destructive POST actions (`delete`, `toggle`) — validate with `$this->isCsrfTokenValid()`
