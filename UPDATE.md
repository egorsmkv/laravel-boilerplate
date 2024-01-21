# How to update components

- [ ] Check https://github.com/moby/moby/releases for Docker's latest version
- [ ] Check https://github.com/go-task/task/releases for task's latest version
- [ ] In `docker-compose.yml` check new versions of images
- [ ] In `Dockerfile` check new version of `php` image
    - [ ] Check a new version of php-zmq, phpredis
    - [ ] Check a new version of Caddy
- [ ] In the apps container run `composer update` / `composer outdated` to check new versions
- [ ] In the apps container run `bun x npm-check-updates --format group -i` to check new versions
