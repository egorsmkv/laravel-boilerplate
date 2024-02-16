FROM golang:1.22.0-alpine3.19 AS build

WORKDIR /app

COPY go.mod go.sum ./

ENV CGO_ENABLED=1 GOOS=linux

RUN apk update \
    && apk add --no-cache ca-certificates \
        git \
        build-base \
        gcc \
        g++ \
        pkgconfig \
        linux-headers \
        zeromq \
        zeromq-dev \
        postgresql-dev \
    && rm -rf /var/cache/apk/*

RUN go mod download && go mod verify

COPY . .

RUN CGO_LDFLAGS="$CGO_LDFLAGS -lstdc++ -lm" \
    go build -v -a -o server ./...

FROM alpine:3.19

WORKDIR /app

RUN apk add --no-cache zeromq

COPY --from=build /app/server .

EXPOSE 6001

CMD ["/app/server"]
