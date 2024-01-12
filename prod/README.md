# Laravel Boilerplate for Production

### Requirements

- Docker Engine 24.x

### Usage

Run the following commands to install this project:

```bash
# Copy the code
cp -r ../apps .

# Create the app docker image
docker build --build-arg CADDY_ARCH=amd64 --tag laravel_app_prod:1.0 .

# Up containers
docker compose up -d

# Migrate
docker exec -it apps_prod php artisan migrate

# Remove the code
rm -rf apps/
```

### Useful commands

Enter the container:

```bash
# Enter the container
docker exec -it apps_prod bash
```

Check usage of resources:

```bash
docker stats --no-stream
```
