# How to update components

- [ ] In `docker-compose.yml` check new versions of images
- [ ] In `Dockerfile` check new version of `bitnami/php-fpm` image
    - [ ] Check a new version of NodeJS
    - [ ] Check a new version of phpredis
- [ ] In the apps container run `composer outdated` to check new versions
- [ ] In the apps container run `npm outdated` to check new versions
