# Projet - Erreur 444

**Description :**
Un blog simple servant de bac à sable afin tester les nouvelles fonctionnalités de Symfony 5 et de php 8.1.

### Le site est actuellement visible [ici](https://erreur-444.herokuapp.com/)

---
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
v2.0 *-- En cours de développement*
- Améliorer le Backoffice EasyAdmin (design + balise meta pour chaque page editeur markdown ??)
- Ajout d'analytics avec [matomo](https://matomo.org/)
- Ajout de la gestion de comptabilité dans le mode admin *-- En cours de développement*

v3.0
- Ajout d'une newsletter (lier avec un service de Newsletter externe ?)
- Ajout de tache cron afin d'automatiser certaines taches (Mise en cache, envoie de newsletter)
- Mettre en place une Api
- Mettre en place une collection Postman de l'Api
- Mettre en place des tests automatisés pour l'Api
- Créer un flux Rss
- Créer un ci/cd afin de livrer directement sur le server une fois la pull request mergée.
