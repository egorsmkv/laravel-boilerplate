set dotenv-path := "dev.env"

pull:
    - podman pull docker.io/library/caddy:latest
    - podman pull ghcr.io/buggregator/server:latest
    - podman pull docker.io/library/redis:latest
    - podman pull docker.io/minio/minio:latest

build:
    - podman build --force-rm --load --tag laravel_app_dev:1.0 .
    - podman image prune -f

install:
    - podman exec -it apps_dev sh -c 'composer install && php artisan horizon:publish && php artisan telescope:publish'
    - podman exec -it apps_dev php artisan key:generate
    - podman exec -it apps_dev php artisan migrate --force

up:
    - podman-compose up -d

queue:
    - podman exec -it apps_dev php artisan horizon

down:
    - podman-compose down

bun-install:
    - cd apps/frontend && bun install

bun-dev: bun-install
    - cd apps/frontend && bun run dev

bun-prod: bun-install
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

build-node-image:
    - podman build -f Containerfile.node --tag node_dev:1.0 .

update-frontend: build-node-image
    - podman run --rm -it -v ./apps/frontend:/app/frontend node_dev:1.0 sh -c "npm-check-updates --format group -i"

fmt:
    - podman run --rm -v .:/code -i docker.io/library/caddy:alpine caddy validate --config /code/Caddyfile
    - podman run --rm -v .:/code -i docker.io/library/caddy:alpine caddy fmt --overwrite /code/Caddyfile
    - just --fmt --unstable
    - dockerfmt --write Containerfile
    - dockerfmt --write Containerfile.node
    - dprint fmt
