[![Owner](https://img.shields.io/badge/Owner-Samakunchan%20Technology-blue)](https://my-services.samakunchan.fr/)
[![Owner](https://img.shields.io/badge/Blog--Portfolio--API-v0.2.0-orange)](https://my-services.samakunchan.fr/)
![GitHub watchers](https://img.shields.io/github/watchers/samakunchan/blog-portfolio-api)
![GitHub repo size](https://img.shields.io/github/repo-size/samakunchan/blog-portfolio-api)
# Blog Portfolio API

API pour mon portfolio, créé avec API Platform. Le projet a été créé avec un skeleton vide. Les dépendances nécessaires seront ajoutés au fur et à mesure.

## Telechargement du projet
Depuis les récentes mise à jour de github, il faut absolument un acess token.

    https://<ACCESS_TOKEN>@github.com/samakunchan/blog-portfolio-api

### Installation classique

    cd blog-portfolio-api
    composer install

### Installation docker

NB: Se débrouiller pour que les ports, les noms de service soient libres.

Build le projet et attendre un moment:

    docker-compose build --pull --no-cache

Et quand c'est fini:

    docker compose up -d

Se rendre dans le container avec la commande ci-dessous pour créer un projet

    docker exec -it server bash (si vous avez bash)
    ou
    docker exec -it server /bin/sh
