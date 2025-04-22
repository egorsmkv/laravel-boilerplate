#!/bin/bash

export TIME=`date +%Y%m%d%H%M%S`

CGO_ENABLED=0 GOOS=linux GOARCH=amd64 ./vx build -c velox.toml -o .

strip -s rr

file rr
