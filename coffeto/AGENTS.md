# Project Commands & Guidelines

## Build, Lint & Test
- **Start Dev:** `php artisan serve` & `npm run dev`
- **Test All:** `php artisan test` (Uses Pest)
- **Test Single:** `php artisan test --filter <TestName>`
- **Lint PHP:** `./vendor/bin/pint`
- **Lint JS/Vue:** `npm run lint`
- **Build Assets:** `npm run build`

## Code Style & Conventions
- **Stack:** Laravel 12, Vue 3 (Composition API `<script setup>`), Inertia.js, Tailwind CSS 4.
- **UI Design System:** "Brutalist" aesthetic.
  - High contrast (black/white + strong accents like neon yellow/pink/blue).
  - Thick borders (`border-2` or `border-4` black).
  - Sharp shadows (`shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]`).
  - Monospace or bold sans-serif typography.
  - Minimal rounding (`rounded-none` or `rounded-sm`).
- **Formatting:** PHP: PSR-12 (via Pint). JS/Vue: Prettier/ESLint.
- **Naming:** PascalCase for Classes/Components (`User.php`, `Button.vue`). camelCase for methods/variables. snake_case for DB columns.
- **Imports:** Group imports. Use absolute paths (aliases) like `@/Components` where possible.
- **Types:** Use strict typing in PHP (`declare(strict_types=1);`). Use TypeScript interfaces for Vue props if helpful, though project is JS-based.
- **Error Handling:** Leverage Laravel's ExceptionHandler. Return consistent JSON/Inertia responses.
- **Best Practices:**
  - Keep controllers thin, use FormRequests for validation.
  - Use Eloquent Resources for API responses.
  - Use `vue-tsc` is installed for type checking support if needed.
