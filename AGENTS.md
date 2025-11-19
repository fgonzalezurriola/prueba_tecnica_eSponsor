# AGENTS Guidelines

- All app commands run inside `coffeto/`. Dev: `php artisan serve` + `npm run dev`.
- Test all: `php artisan test`. Single test: `php artisan test --filter <TestName>`.
- Lint PHP: `./vendor/bin/pint`. Lint JS/Vue: `npm run lint`. Build assets: `npm run build`.
- Stack: Laravel 12 + Breeze, Vue 3 + Inertia, Tailwind CSS.
- Domain: `Page` is aggregate root; `Link` and `Support` always belong to a `Page`.
- DDD: keep domain logic on models (e.g. `Page::addSupport()`), controllers thin, FormRequests for validation.
- PHP style: PSR-12, strict types where reasonable, early returns, avoid facades when DI is clearer.
- JS/Vue style: Prettier/ESLint defaults, `<script setup>` when possible, composition API for shared logic.
- Imports: group by vendor→app, use aliases like `@/Components`, `@/Pages`, avoid unused imports.
- Naming: PascalCase for classes/components, camelCase for vars/functions, UPPER_SNAKE_CASE for constants, snake_case DB columns and migrations.
- Types: prefer explicit PHP docblocks for complex collections and DTO-like arrays; in JS use JSDoc/TypeScript-style annotations where configured.
- Error handling: validate input via FormRequests, throw domain exceptions for invariants, never swallow exceptions silently; return user-friendly messages in controllers.
- Testing: prefer Pest feature tests for HTTP flows and unit tests for model/domain logic; keep tests isolated and deterministic.
- UI: maintain brutalist aesthetic (high contrast, thick borders, hard shadows) across dashboard and public pages.
- Git: small, focused commits; do not commit local environment files, node_modules, or built assets.
- Comments: only when code intent is non-obvious; keep them in English and above the function/method, never inline.
- Performance: eager-load relations in queries (`with`, `load`) to avoid N+1; paginate large lists.
- Security: use Laravel authorization policies/middleware, never trust request data, escape output in Blade, and guard mass assignment via `$fillable`/`$guarded`.
