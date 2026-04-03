# AGENTS.md
## Mission Context
- This repo is a Symfony 8 / PHP 8.4 landing-page boilerplate with a public site + protected admin (`src/Controller` and `src/Controller/Admin`).
- Product intent and constraints are documented in `CLAUDE.md`; use it as the primary AI convention source.

## Architecture You Need First
- Public flow: `HomeController` renders landing sections + latest news; `ContactController` persists `ContactMessage` and attempts email send.
- Admin flow: CRUD-like management for news/messages/settings/appearance under `/admin/*` with `#[IsGranted('ROLE_ADMIN')]`.
- Data model centers on 4 entities in `src/Entity`: `Actualite`, `ContactMessage`, and two singleton-style rows: `SiteSettings` + `LandingPageContent`.
- Singleton access pattern is repository-driven (`SiteSettingsRepository::getSettings()`, `LandingPageContentRepository::getContent()`) and lazily exposed to Twig via services.
- Twig globals are mandatory and already wired in `config/packages/twig.yaml`: `settings` and `lp`.

## Cross-Component Data Flow Patterns
- Visual customization path: admin form (`LandingPageContentType`) -> `LandingController` upload handling -> DB -> Twig global `lp` -> CSS vars/fonts injected in `templates/base.html.twig`.
- Company info path: `SiteSettingsType` -> `SettingsController` -> DB -> Twig global `settings` used across navbar/footer and mailer config.
- Contact path: `ContactType` includes honeypot field `website`; `ContactController` saves DB first, then calls `ContactMailer` in a non-blocking `try/catch`.
- News publication path: public home uses `ActualiteRepository::findPublished(6)`; admin list uses `findAllOrderedByDate()` and toggle endpoint.

## Project-Specific Conventions (Observed)
- Routes are attribute-based (see controllers) with locale-aware public routes (`/{_locale}` where `fr|ar`).
- Arabic RTL is template-driven (`templates/base.html.twig`, `dir="rtl"` + Bootstrap RTL CSS when locale is `ar`).
- Flash keys are translation keys (`contact.success`, `admin.*`) resolved in base templates.
- File uploads are manual (no Vich bundle): `public/uploads/actualites`, `public/uploads/logo`, `public/uploads/hero`, `public/uploads/about`.
- CSRF delete token convention is `delete{id}` in templates/controllers; preserve when adding actions.

## Security + Auth Boundaries
- Single in-memory admin user is configured in `config/packages/security.yaml` with `%env(ADMIN_PASSWORD_HASH)%`.
- Access control is path-based: `/admin/login` is public, everything else under `/admin` requires `ROLE_ADMIN`.

## Dev Workflows (High Value Commands)
- Install dependencies: `composer install`
- DB migrate: `php bin/console doctrine:migrations:migrate`
- Seed singleton defaults: `php bin/console doctrine:fixtures:load`
- Generate admin hash: `php bin/console security:hash-password`
- Inspect routes: `php bin/console debug:router`
- Assets (Webpack Encore): `npm install` and `npm run dev` (or `npm run watch`)
- Tests: `php bin/phpunit`

## Known Config Nuance to Check Before Changes
- `CLAUDE.md` describes MySQL-by-default for client projects, but repo also includes a Postgres Docker service in `compose.yaml`; verify target DB before changing migrations/env.
- `.env` currently points to MySQL locally; do not move business/company content into env vars (keep in singleton entities via admin UI).

## Editing Guidance for AI Agents
- Keep controllers thin; if behavior is reused/cross-cutting, put logic in `src/Service` and surface via DI.
- When adding UI text on public pages, add FR+AR keys in `translations/messages.fr.yaml` and `translations/messages.ar.yaml`.
- When changing landing or settings fields, update in sync: entity, form type, admin template, and any Twig/global consumption.
- Preserve the singleton assumptions (`id=1`) for `SiteSettings` and `LandingPageContent`; do not introduce multi-row admin flows unless explicitly requested.
