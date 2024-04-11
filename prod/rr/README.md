# RoadRunner built by Velox

## AMD64

```bash
wget https://github.com/roadrunner-server/velox/releases/download/v2024.1.0/velox-2024.1.0-linux-amd64.tar.gz

tar xf velox-2024.1.0-linux-amd64.tar.gz && \
    mv velox-2024.1.0-linux-amd64/vx . && \
    rm -rf velox-2024.1.0-linux-amd64 && \
    rm velox-2024.1.0-linux-amd64.tar.gz
```

## Darwin

### ARM64

```bash
wget https://github.com/roadrunner-server/velox/releases/download/v2024.1.0/velox-2024.1.0-darwin-arm64.tar.gz

tar xf velox-2024.1.0-darwin-arm64.tar.gz && \
    mv velox-2024.1.0-darwin-arm64/vx . && \
    rm -rf velox-2024.1.0-darwin-arm64 && \
    rm velox-2024.1.0-darwin-arm64.tar.gz
```

## Build

```bash
# Generate a token on https://github.com/settings/tokens?type=beta
export RT_TOKEN=
export TIME=`date +%Y%m%d%H%M%S`

CGO_ENABLED=0 GOOS=linux GOARCH=amd64 ./vx build -c velox.toml -o .
```
