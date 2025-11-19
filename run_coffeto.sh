#!/usr/bin/env bash
set -e

# Simple dev bootstrap for Coffeto
# - Instala dependencias si faltan
# - Configura .env y SQLite por defecto
# - Ejecuta migraciones + seed
# - Levanta php artisan serve y npm run dev

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
APP_DIR="$ROOT_DIR/coffeto"

cd "$APP_DIR"

echo "[coffeto] Using app directory: $APP_DIR"

# 1) Composer dependencies
if [ ! -f "vendor/autoload.php" ]; then
  echo "[coffeto] Installing PHP dependencies (composer install)"
  composer install --no-interaction --prefer-dist
else
  echo "[coffeto] PHP dependencies already installed (vendor/ exists)"
fi

# 2) .env and APP_KEY
if [ ! -f ".env" ]; then
  echo "[coffeto] Creating .env from .env.example"
  cp .env.example .env
  php artisan key:generate
else
  echo "[coffeto] .env already present"
fi

# 3) SQLite database (if using sqlite)
if grep -q "^DB_CONNECTION=sqlite" .env; then
  DB_PATH=$(grep '^DB_DATABASE=' .env | cut -d '=' -f 2-)
  if [ -z "$DB_PATH" ]; then
    DB_PATH="database/database.sqlite"
  fi

  if [ ! -f "$DB_PATH" ]; then
    echo "[coffeto] Creating SQLite database at $DB_PATH"
    mkdir -p "$(dirname "$DB_PATH")"
    touch "$DB_PATH"
  else
    echo "[coffeto] SQLite database already exists at $DB_PATH"
  fi
fi

# 4) NPM dependencies
if [ ! -d "node_modules" ]; then
  echo "[coffeto] Installing JS dependencies (npm install)"
  npm install
else
  echo "[coffeto] JS dependencies already installed (node_modules/ exists)"
fi

# 5) Migrations + seed
echo "[coffeto] Running migrations and seed"
php artisan migrate --seed

# 6) Start servers
echo "[coffeto] Starting php artisan serve on :8000"
php artisan serve &
PHP_PID=$!

echo "[coffeto] Starting Vite dev server (npm run dev)"
npm run dev &
VITE_PID=$!

trap "echo '[coffeto] Stopping dev servers'; kill $PHP_PID $VITE_PID 2>/dev/null || true" EXIT

echo "[coffeto] Dev environment up. Open http://127.0.0.1:8000/"
echo "[coffeto] Demo user: demo@coffeto.test / password"

wait
