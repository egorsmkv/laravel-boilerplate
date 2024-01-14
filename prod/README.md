# Laravel Boilerplate for Production

### Requirements

- Docker Engine 24.x

### Usage

Run the following commands to install this project:

```bash
# Create the app docker image
task build-init

task build-amd64
task build-arm64

task build-prune

# Up containers
task up

# Migrate
task migrate
```

### Useful commands

Enter the container:

```bash
# Enter the container
task bash
```

Check usage of resources:

```bash
task stats
```
