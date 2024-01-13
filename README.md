# Laravel Boilerplate for Development

> [!NOTE]  
> The idea of this project is simple: current boilerplate must `a)` be on the latest version of Laravel
> `b)` be lightweight to run with Docker `c)` to use modern technologies such as PHP 8.3, PgSQL 16, Go 1.21, Python 3.12, etc.

### Requirements

- Docker Engine 24.x

### Usage

Run the following commands to install this project:

```bash
# Create the app docker image
task build

# Up containers
task up

# Copy Laravel environment variables file
cp -n dev-frontend.env apps/frontend/.env

# Install dependencies, generate key, run migrations
task install
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

Start queue worker:

```bash
task queue-listen
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
- Access `http://localhost:8888` to enter the temboard.

If you would like to use temboard, then up the container with the following command:

```bash
task up-with-temboard
```

### Query optimization

Run the following command to generate SQL queries to get the execution plan:

```bash
task gen-explain-queries
```

Then, use https://explain.dalibo.com to visualize and understand the execution plan.

### Profiling

Access `http://localhost/?SPX_KEY=dev&SPX_UI_URI=/` to enable PHP-SPX and see the profiling results.

### Maintenance

Read the UPDATE.md file to keep the project up to date.
