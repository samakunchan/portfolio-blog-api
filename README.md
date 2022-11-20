[![Owner](https://img.shields.io/badge/Owner-Samakunchan%20Technology-blue)](https://samakunchan-technology.com/)
[![API](https://img.shields.io/badge/API-v0.5.1-brightgreen)](https://samakunchan-technology.com/)
![GitHub watchers](https://img.shields.io/github/watchers/samakunchan/portfolio-blog-api)
![GitHub repo size](https://img.shields.io/github/repo-size/samakunchan/portfolio-blog-api)
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
