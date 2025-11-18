# Project Commands & Guidelines

## Build, Lint & Test
- **Start Dev:** `php artisan serve` & `npm run dev`
- **Test All:** `php artisan test`
- **Test Single:** `php artisan test --filter <TestName>`
- **Lint PHP:** `./vendor/bin/pint`
- **Lint JS/Vue:** `npm run lint` (ensure eslint/prettier are configured)
- **Build Assets:** `npm run build`

## Code Style & Conventions
- **Stack:** Laravel 10+, Vue 3 (Composition API `<script setup>`), Inertia.js, Tailwind CSS.
- **Formatting:** Follow PSR-12 for PHP. Use Prettier/ESLint for JS/Vue.
- **Naming:** PascalCase for Classes/Components (`User.php`, `Button.vue`). camelCase for methods/variables. snake_case for DB columns.
- **Imports:** Group imports. Use absolute paths (aliases) like `@/Components` where possible.
- **Types:** Use strict typing in PHP (`declare(strict_types=1);`). Use TypeScript interfaces if TS is enabled.
- **Error Handling:** Leverage Laravel's ExceptionHandler. Return consistent JSON/Inertia responses.
- **Best Practices:** Keep controllers thin, use FormRequests for validation. Use Eloquent Resources for API responses.
