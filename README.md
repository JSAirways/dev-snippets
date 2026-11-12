# Dev Snippets

A Laravel + Filament app for collecting and browsing development snippets. Snippet content on the public frontend is readable without authentication. The Filament admin panel lives at `/admin`.

## Requirements

- PHP 8.2+
- Composer
- Node.js & npm
- MySQL (or another Laravel-supported database)

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Configure your database credentials in `.env`, then:

```bash
php artisan migrate
php artisan db:seed
npm install
npm run build
php artisan serve
```

### Seeded admin user

`db:seed` creates one admin user. Defaults (override via `.env`):

| Variable | Default |
| --- | --- |
| `SEED_ADMIN_NAME` | `Admin` |
| `SEED_ADMIN_EMAIL` | `admin@example.com` |
| `SEED_ADMIN_PASSWORD` | `password` |

Do **not** run the default seeder against production. Create a strong unique admin there, and never commit real credentials.

### Admin panel access

Optionally set `FILAMENT_ADMIN_EMAIL` in `.env` to allow only that email into `/admin`. If unset, any authenticated user can access the panel. There is no public registration.

The gear link to `/admin` is shown only when you are already logged in.

## License

MIT — see [LICENSE](LICENSE).
