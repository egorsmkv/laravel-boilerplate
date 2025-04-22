set dotenv-path := "dev.env"

pull:
    - podman pull caddy:latest
    - podman pull ghcr.io/buggregator/server:latest
    - podman pull redis:latest
    - podman pull minio/minio:latest

build:
    - podman build --force-rm --load --tag laravel_app_dev:1.0 .
    - podman image prune -f

install:
    - podman exec -it apps_dev sh -c 'composer install && php artisan horizon:publish && php artisan telescope:publish'
    - podman exec -it apps_dev php artisan key:generate
    - podman exec -it apps_dev php artisan migrate --force

up:
    - podman compose up -d

queue:
    - podman exec -it apps_dev php artisan horizon

down:
    - podman compose down

bun-install:
    - cd apps/frontend && bun install

bun-dev:
    - cd apps/frontend && bun run dev

bun-prod:
    - cd apps/frontend && bun run build

lang-update:
    - podman exec -it apps_dev php artisan lang:update

check-code:
    - podman exec -it apps_dev sh check-code.sh

test:
    - podman exec -it apps_dev php artisan test

check-security:
    - podman exec -it apps_dev security-checker security:check composer.lock
    - podman exec -it apps_dev composer audit

logs:
    - podman compose logs -f

console:
    - podman exec -it apps_dev sh

lint:
    - podman run --rm -i hadolint/hadolint < Containerfile

fmt:
    - podman run --rm -v .:/code -i docker.io/library/caddy:2.9-alpine caddy validate --config /code/Caddyfile
    - podman run --rm -v .:/code -i docker.io/library/caddy:2.9-alpine caddy fmt --overwrite /code/Caddyfile
    - just --fmt --unstable
    - dockerfmt --write Containerfile
