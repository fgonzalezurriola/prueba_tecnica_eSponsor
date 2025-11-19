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

## Project Status
- **Phase 1 (Data Architecture):** Completed. `User` -> `Page` -> (`Link`, `Support`).
- **Phase 2 (Dashboard):** Completed. Profile editing, Link CRUD, Brutalist UI.
- **Phase 3 (Public Page):** Completed. Public profile `/@slug` with links.
- **Phase 4 (Supports):** Completed. Public visitors can support pages (simulated payments) via brutalist modal.
- **Phase 5 (Dashboard Supports):** Completed. Creators can view their received supports history in the dashboard.
- **Phase 6 (Documentation):** Completed. Root README.md created with full installation and usage instructions.
