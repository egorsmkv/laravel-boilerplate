# How to update components

- [ ] Check https://docs.docker.com/engine/release-notes to see the latest version of Docker Engine
- [ ] In `docker-compose.yml` check new versions of images
- [ ] In `Dockerfile` check new version of `bitnami/php-fpm` image
    - [ ] Check a new version of phpredis
- [ ] In the apps container run `composer outdated` to check new versions
- [ ] In the apps container run `bun x npm-check-updates --format group -i` to check new versions
