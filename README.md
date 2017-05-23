[![Build Status](https://travis-ci.org/nfqakademija/sport2gether.svg?branch=master)](https://travis-ci.org/nfqakademija/sport2gether)

![](https://avatars0.githubusercontent.com/u/4995607?v=3&s=100)
# Sport2gether
#### NFQ Academy 2017 spring

---

**Requirements**

* [docker: >=17.x-ce](https://docs.docker.com/engine/installation/)
* [docker-compose: >=1.8.1](https://github.com/docker/compose/releases)

**How to run project?**

1. Download repository
2. Rename .env.dist to .env
3. Run these commands in terminal:

```bash

docker-compose up -d
docker-compose exec fpm composer install --prefer-dist -n
docker-compose run npm npm install
docker-compose run npm gulp

```

4. Go to `http://127.0.0.1:8000`

---

#### Contributors

- [Justas Žaltauskas](https://github.com/JustasZaltauskas/)
- Pavelas Adomaitis
- Mykolas Kazlauskas
- Gediminas Katilevičius
