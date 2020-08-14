# Coven

## Qu'est ce que Coven ?

Coven est un site permettant de louer des voitures de luxe. Il a été réalisé dans le cadre du projet de développement web pour le second semestre de prépa II.

## Installer le site sur votre ordinateur

Récupérez une copie du site :
```
git clone https://gitlab.etude.eisti.fr/draescherl/projet-devweb.git
```

Depuis la racine exécutez la commande :
```
php -S 0.0.0.0:8888
```

Le site sera désormais accessible sur votre ordinateur à l'adresse `localhost:8888`. <br>
Vous pouvez aussi y accéder depuis votre réseau local. Pour ce faire, exécutez `ifconfig` (Linux/Mac) ou `ipconfig` (Windows) et cherchez l'adresse IPv4 de la carte réseau connectée à votre routeur (généralement wlan0 si vous êtes connectés en Wi-Fi, eth0 si vous êtes connectés par cable). Vous pouvez maintenant accéder au site depuis n'importe quel appareil connecté au même réseau que votre ordinateur à l'adresse `192.168.1.250:8888` (remplacez `192.168.1.250` par votre adresse IP). 

## Utiliser Coven

### Hiérarchie des permissions
Coven ne propose pas les mêmes fonctionnalités selon votre rôle. La hiérarchie s'organise comme ceci : <br>
```bash
Administrateur
└── Personnel
    └── Utilisateur enregistré
        └── Visiteur
```
Le visiteur peut consulter les modèles proposés à la location. <br>
Lorsqu'un utilisateur se créé un compte, il débloque la possibilité d'ajouter des voitures dans sa liste des envies (et les retirer), passer des commandes et intéragir avec les autres utilisateurs du site à l'aide de la messagerie. <br>
Le personnel de l'entreprise peut, en plus des fonctionnalités mentionnées précédemment, ajouter et supprimer des annonces. <br>
Finalement, l'administrateur peut modifier les permissions de chaque utilisateur (et supprimer un compte), mettre à jour le statut d'une voiture (réservée/disponible) et téléverser différents fichiers (marques, années de production, types de véhicules) qui entrent en jeux lors de l'ajout d'une voiture.

### Identifiants par défaut
|     Profil     | Nom d'utilisateur | Mot de passe  |
| :-----------:  |:----------------: | :-----------: |
| Administrateur | admin             | admin         |
| Personnel      | staff             | staff         |
| Utilisateur    | user              | user          |

Tous les identifiants de connexion peuvent être modifiés depuis le site.

### Informations supplémentaires
Le CSS du site est géré par le framework [Materialize](https://materializecss.com/). <br>
Nous avons voulu faire une fonctionnalité permettant à l'administrateur de télécharger certains éléments de la base de données (dossiers inventory et filter_fields) afin de les modifier plus facilement. Nous avons réussi à créer l'archive mais après une journée de travail nous n'avons pas réussi à faire marcher le téléchargement ...

## Auteurs

* **Hugo Cambra**        - cambralefe@eisti.eu
* **Lucas Draescher**    - draescherl@eisti.eu
* **Pierre Monchecourt** - monchecour@eisti.eu
* **Thomas Olivier**     - oliviertho@eisti.eu
* **Antonin Soulier**    - soulierant@eisti.eu
