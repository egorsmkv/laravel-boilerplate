# Laravel Boilerplate for Development

> [!NOTE]
> The idea of this project is simple, current boilerplate must:
> - be on the latest version of Laravel
> - be lightweight to run with Docker
> - to use modern technologies such as PHP 8.3, Go 1.21, Python 3.12, etc.

### Requirements

- Docker Engine 24.x

### Usage

Run the following commands to install this project:

```bash
# Build our dev image
task build-init
task build
task build-prune

# Up containers
task up

# Copy Laravel environment variables file
cp -n dev-frontend.env apps/frontend/.env

# Install dependencies, generate key, run migrations
task install

# Run queue worker
task queue
```

### Useful commands

Fix permissions:

```bash
task fix-perms
```

Use Vite:

```bash
# Start dev server
task bun-dev

# Build for production
task bun-build
```

Update locales:

```bash
task lang-update
```

Apply fixes by phpcs:

```bash
task phpcs-fix
```

Analyse the code by [Larastan](https://github.com/larastan/larastan):

```bash
task phpstan
```

Check usage of resources:

```bash
task stats
```

Check security vulnerabilities in dependencies:

```bash
task check-security
```

### Database monitoring

- Access `http://localhost:8081` to enter the pgweb.
- Access `http://localhost:9080` to enter the CockroachDB UI.

### Profiling

Access `http://localhost/?SPX_KEY=dev&SPX_UI_URI=/` to enable PHP-SPX and see the profiling results.

### Maintenance

Read the UPDATE.md file to keep the project up to date.
