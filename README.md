### Image Layers
Download size and number of layers.

[![](https://images.microbadger.com/badges/image/voloshinvladimir/payever-docker.svg)](https://microbadger.com/images/voloshinvladimir/payever-docker)

You can start web-application (will be available at http://0.0.0.0:888/) using following config for docker-compose:
```
version: '2'
services:
    db:
        image: mysql
        environment:
            MYSQL_ROOT_PASSWORD: 6633222
            MYSQL_USER: payever-ch
            MYSQL_PASSWORD: Fun1tIk
            MYSQL_DATABASE: payever-ch
        expose:
            - "3306/tcp"
    web:
        command: ["./install.sh"]
        image: voloshinvladimir/payever-docker:latest
        links:
            - db
        ports:
            - "888:80"
        depends_on:
            - db
        entrypoint: ["./wait-for-it.sh", "db:3306", "-t", "120", "--"]

```

### What's happening in the Dockerfile

Generally, Symfony 2.8 project from https://github.com/Vladimir-Voloshin/payever-ch is copied in virtual folder and launched.

#### Layer-by-layer
 
1. copies file wait-for-it.sh, which holds web application launch till db will be ready
2. copies file install.sh, which perfoms project install (db migration in this case)
3. copies 000-default.conf, which is apache virtual host's config
4. copies php.ini
5. copies git submodule's folder (which is https://github.com/Vladimir-Voloshin/payever-ch) proj.src into the docker image

Rest is pretty straigtforward I guess.
