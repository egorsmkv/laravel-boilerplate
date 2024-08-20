FROM golang:1.23.0-alpine3.20 AS build

WORKDIR /app

COPY go.mod go.sum ./

ENV CGO_ENABLED=1
ENV GOOS=linux

RUN apk update && apk add --no-cache \
    ca-certificates=20240705-r0 \
    git=2.45.2-r0 \
    build-base=0.5-r3 \
    gcc=13.2.1_git20240309-r0 \
    g++=13.2.1_git20240309-r0 \
    linux-headers=6.6-r0 \
    zeromq=4.3.5-r2 \
    zeromq-dev=4.3.5-r2 \
    && rm -rf /var/cache/apk/*

RUN go mod download && go mod verify

COPY . .

RUN CGO_LDFLAGS="$CGO_LDFLAGS -lstdc++ -lm" \
    go build -v -a -o server ./...

FROM alpine:3.20

WORKDIR /app

RUN apk add --no-cache zeromq=4.3.5-r2

COPY --from=build /app/server .

EXPOSE 6001

CMD ["/app/server"]
