# Coffeto ☕

## Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- SQLite (default) or MySQL

### Steps

```bash
git clone https://github.com/fgonzalezurriola/prueba_tecnica_eSponsor.git
cd prueba_tecnica_eSponsor
```

```bash
cd coffeto
composer install
npm install
```

Copy the example environment file and configure it (default uses SQLite).

```bash
cp .env.example .env
php artisan key:generate
```
    
```bash
touch database/database.sqlite
php artisan migrate
npm run build
```

## Running the Application

Run the bash script in the root

```bash
./run_coffeto.sh
```

Alternatively:

```bash
php artisan serve
```

Laravel serves the app at [http://127.0.0.1:8000](http://127.0.0.1:8000)
If you are developing and want hot module replacement:

```bash
npm run dev
```

**Demo Account & Public Page**
   - Demo user: `demo@coffeto.test` / `password`
   - Demo public page: open `/@demo-creator` on the same host/port as the Laravel server (for example, [http://127.0.0.1:8000/@demo-creator](http://127.0.0.1:8000/@demo-creator)).

## Testing

```bash
php artisan test
```

## Project Structure

**Models:** `Page` is the aggregate root. `Link` and `Support` belong to `Page`.
**Controllers:** Thin controllers (`PageController`, `SupportController`) that delegate to Models or FormRequests.
**UI:** All Vue pages are in `resources/js/Pages`. Shared components in `resources/js/Components`.
