#!/bin/bash

export TIME=`date +%Y%m%d%H%M%S`

CGO_ENABLED=0 GOOS=linux GOARCH=amd64 ./vx build -c velox.toml -o .

if [ $? -ne 0 ]; then
    echo "Velox build failed"
    exit 1
fi

strip -s ./rr

file ./rr
