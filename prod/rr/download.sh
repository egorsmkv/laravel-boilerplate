#!/bin/bash

export VERSION=2025.1.5

wget -q https://github.com/roadrunner-server/velox/releases/download/v$VERSION/velox-$VERSION-linux-amd64.tar.gz

tar xf velox-$VERSION-linux-amd64.tar.gz && \
    mv velox-$VERSION-linux-amd64/vx . && \
    rm -rf velox-$VERSION-linux-amd64 && \
    rm velox-$VERSION-linux-amd64.tar.gz

chmod +x vx
