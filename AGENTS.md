# Project Commands & Guidelines

## Build, Lint & Test
- All app commands run inside `coffeto/`.
- Start Dev: `php artisan serve` & `npm run dev`
- Test All: `php artisan test` (Pest)
- Test Single: `php artisan test --filter <TestName>`
- Lint PHP: `./vendor/bin/pint`
- Lint JS/Vue: `npm run lint`
- Build Assets: `npm run build`

## Code Style, DDD & UI
- Stack: Laravel 12 + Breeze, Vue 3 + Inertia, Tailwind CSS.
- Domain: `Page` is the aggregate root; `Link` and `Support` always belong to a `Page`.
- DDD: keep domain logic on models (e.g. `Page::addSupport()`), controllers thin, FormRequests for validation.
- Formatting: PHP PSR-12 via Pint; JS/Vue via Prettier/ESLint.
- Naming: PascalCase for classes/components, camelCase for vars/functions, snake_case DB columns.
- Imports: Group imports, prefer aliases like `@/Components` and `@/Pages`.
- UI: brutalist aesthetic (high contrast, thick borders, hard shadows) across all pages.
