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

# Prune builds
task prune-builds

# Up containers
task up

# Migrate
task migrate

# Show logs
task logs

# Enter the apps container
task console
```
