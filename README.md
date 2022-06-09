# Projet - Eunnow
**Description :**
Un blog simple servant de bac à sable afin tester les nouvelles fonctionnalités de Symfony 5 et de php 8.1.

## Installation
### Pré-requis
- Docker
- Docker-compose

Lancer la commande `make install`.

L'interface admin est accessible via l'url : {BASE_URL}/login/login-admin-interface

Pour me contacter:
- strentz.paul@gmail.com
- [LinkedIn](https://www.linkedin.com/in/paul-strentz/)


----
## ROADMAP
v1.0  *-- Développement en cours*: 
- changer la favicon...
- Finir la configuration du server (DNS, BDD)
- Créer un ci/cd afin de livrer directement sur le server une fois la pull request mergée.
- Tester les [Live components](https://symfony.com/bundles/ux-live-component/current/index.html)
- Ajouter un footer avec sitemap

v2.0 :
- Améliorer le Backoffice EasyAdmin (design + balise meta pour chaque page)
- Stocker les articles dans le [cache Sf](https://symfony.com/doc/5.4/the-fast-track/fr/21-cache.html) voir Varnish afin de gagner en performance d'affichage
- Ajouter un dark theme
- Paginer les articles en infinite scroll
- Upload d'image pour Article... (pas certains)
- Ajout d'analytics avec [matomo](https://matomo.org/)

v3.0
- Ajout d'une newsletter (lier avec un service de Newsletter externe ?)
- Ajout de tache cron afin d'automatiser certaines taches (Mise en cache, envoie de newsletter)
- Mettre en place une Api
- Mettre en place une collection Postman de l'Api
- Mettre en place des tests automatisés pour l'Api
- Créer un flux Rss
