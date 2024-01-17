# RoadRunner built by Velox

## AMD64

```bash
wget https://github.com/roadrunner-server/velox/releases/download/v1.7.2/velox-1.7.2-linux-amd64.tar.gz

tar xf velox-1.7.2-linux-amd64.tar.gz
mv velox-1.7.2-linux-amd64/vx .
rm -rf velox-1.7.2-linux-amd64
rm velox-1.7.2-linux-amd64.tar.gz
```

## Darwin ARM64

```bash
wget https://github.com/roadrunner-server/velox/releases/download/v1.7.2/velox-1.7.2-darwin-arm64.tar.gz

tar xf velox-1.7.2-darwin-arm64.tar.gz
mv velox-1.7.2-darwin-arm64/vx .
rm -rf velox-1.7.2-darwin-arm64
rm velox-1.7.2-darwin-arm64.tar.gz
```

## Build

```bash
export RT_TOKEN=
TIME=`date +%Y%m%d%H%M%S` ./vx build -c velox.toml -o .
```
