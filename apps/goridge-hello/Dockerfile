FROM golang:1.21.6-alpine3.19 AS build

WORKDIR /app

COPY go.mod go.sum ./
RUN go mod download && go mod verify

COPY . .

RUN go build -v -o server ./...

FROM alpine:3.19

WORKDIR /app
COPY --from=build /app/server .

EXPOSE 6001

CMD ["/app/server"]
