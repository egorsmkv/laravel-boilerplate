# RoadRunner built by velox

```
wget https://github.com/roadrunner-server/velox/releases/download/v1.7.1/velox-1.7.1-linux-amd64.tar.gz

tar xf velox-1.7.1-linux-amd64.tar.gz
mv velox-1.7.1-linux-amd64/vx .
rm -rf velox-1.7.1-linux-amd64
rm velox-1.7.1-linux-amd64.tar.gz

export RT_TOKEN=
./vx build -c velox.toml -o .
```
