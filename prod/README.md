# Production

### Requirements

- Docker 25.x
- Task 3.x

### Usage

```bash
# Generate certificates for CockroachDB
task certs-init

# Create prod image
task build-amd64

# Remove builds
task build-prune

# Up containers
task up

# Migrate
task migrate

# Enter the apps container
task console
```
