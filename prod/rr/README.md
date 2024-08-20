# RoadRunner built by Velox

## AMD64

```bash
export VERSION=2024.2.0

wget -q https://github.com/roadrunner-server/velox/releases/download/v$VERSION/velox-$VERSION-linux-amd64.tar.gz

tar xf velox-$VERSION-linux-amd64.tar.gz && \
    mv velox-$VERSION-linux-amd64/vx . && \
    rm -rf velox-$VERSION-linux-amd64 && \
    rm velox-$VERSION-linux-amd64.tar.gz
```

## Build

```bash
# Generate a token on https://github.com/settings/tokens?type=beta
export RT_TOKEN=
export TIME=`date +%Y%m%d%H%M%S`

CGO_ENABLED=0 GOOS=linux GOARCH=amd64 ./vx build -c velox.toml -o .

strip -s rr
```
