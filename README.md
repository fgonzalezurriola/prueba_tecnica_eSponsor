# Coffeto ☕

A brutalist-style creator platform where users can create a public page, share links, and receive symbolic "supports" (coffee). Built with Laravel 12, Vue 3 (Inertia.js), and Tailwind CSS.

## Features

- **User Authentication:** Register and login (Laravel Breeze).
- **Creator Dashboard:**
  - Edit profile (Avatar, Bio, Slug).
  - Manage links (CRUD with drag-and-drop style ordering).
  - View received supports history.
- **Public Page (`/@slug`):**
  - Brutalist UI design.
  - Display profile and links.
  - "Support Me" modal to receive simulated payments.
- **Tech Stack:**
  - **Backend:** Laravel 12 (PHP 8.2+).
  - **Frontend:** Vue 3, Inertia.js, Tailwind CSS.
  - **Testing:** Pest PHP.
  - **Design:** Brutalist aesthetic (high contrast, thick borders, hard shadows).

## Installation

Follow these steps to set up the project locally.

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- SQLite (default) or MySQL

### Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd prueba_tecnica_eSponsor
   ```

2. **Navigate to the application directory**
   The Laravel application is located in the `coffeto` directory.
   ```bash
   cd coffeto
   ```

3. **Install Backend Dependencies**
   ```bash
   composer install
   ```

4. **Install Frontend Dependencies**
   ```bash
   npm install
   ```

5. **Environment Setup**
   Copy the example environment file and configure it (default uses SQLite).
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   
   *Note: By default, the database connection is set to `sqlite`. Ensure you have the sqlite extension enabled in php.ini.*
   
   Create the SQLite database file:
   ```bash
   touch database/database.sqlite
   ```

6. **Run Migrations**
   Create the database tables.
   ```bash
   php artisan migrate
   ```

7. **Build Assets**
   Build the frontend assets for development.
   ```bash
   npm run build
   ```

## Running the Application

You need to run both the Laravel server and (optionally) the Vite development server if you want hot-reloading.

1. **Start Laravel Server**
   ```bash
   php artisan serve
   ```
   By default, Laravel serves the app at [http://127.0.0.1:8000](http://127.0.0.1:8000) (if that port is busy it may pick another; check the terminal output).

2. **(Optional) Start Vite Dev Server**
   If you are developing and want hot module replacement:
   ```bash
   npm run dev
   ```

3. **Demo Account & Public Page**
   - Demo user: `demo@coffeto.test` / `password`
   - Demo public page: open `/@demo-creator` on the same host/port as the Laravel server (for example, [http://127.0.0.1:8000/@demo-creator](http://127.0.0.1:8000/@demo-creator)).

## Testing

The project includes a comprehensive test suite using Pest.

To run all tests:
```bash
php artisan test
```

## Project Structure

- **Domain Driven Design (Lite):**
  - **Models:** `Page` is the aggregate root. `Link` and `Support` belong to `Page`.
  - **Controllers:** Thin controllers (`PageController`, `SupportController`) that delegate to Models or FormRequests.
  - **UI:** All Vue pages are in `resources/js/Pages`. Shared components in `resources/js/Components`.

## License

Open source.
