Leed-market
===========

Le dépot Leed market contient tous les plugins à jour et approuvés officiellement pour le logiciel Leed.

wiki plugins : http://projet.idleman.fr/leed/?page=Plugins

<b>Installation</b>
* récupéré le zip avec tous les plugins: https://github.com/ldleman/Leed-market/archive/master.zip
* installer le contenu du répertoire Leed-market-master dans le répertoire plugins de Leed
(ex arborescence plugin leedBrowser : /leed/plugins/leedBrowser/...)
* connectez vous sur votre Leed et dans "Gestion"=> "Plugins Disponibles", activer les plugins souhaités

<b>Liste des plugins officiels de Leed</b>
* cacheListFeed		- cacher la liste des feed afin de lire les articles en plein écran.
* DeleteTheCache	- suppression physique des fichiers mis en cache par Leed
* favicon_IOS		- ajoute une jolie icone sur IOS
* fleaditlater		- ajoute un bouton permettant de marquer un evenement comme "a lire plus tard"
* fleedicon_content	- ajoute un favicon à gauche de chaque item lors de la lecture
* fleexed			- repositionne les menus en position fixed
* instapaper		- affiche les évenements directement sur instapaper lors du clic sur le titre d'un évenement
* leedBrowser		- Lors du clic sur un lien d'événement, le site est ouvert dans un navigateur discret avec des boutons : marquer comme lu, favoriser...
* leedLogSync		- Affichage du dernier fichier de Log généré par la tache planifiée de synchronisation
* leedUpdateSource	- Leed toujours à jour.
* oneSync			- ajoute un bouton à coté de chaque flux afin de synchroniser uniquement ce flux
* rssmaker          - Créer un flux rss par dossiers de flux. Permet de créer de nouveaux flux pour une consultation plus synthétique
* search			- effectuer une recherche sur les articles de Leed. Ne perdez plus aucune information !
* shaarleed			- partage un lien d'evenement directement sur son script shaarli
* social			- partage les articles avec son réseau social préféré (Facebook / Tweeter / Google+)
* squelette			- plugin d'exemple pour les créateurs de nouveaux plugins Leed
* themeswitcher		- changer de thème via la page de gestion
* ToggleEventContent    - ajoute un bouton permettant de cacher/afficher le contenu d'un événement
* z_cssLeedMaker    - Ce plugin permet de contruire son propre thème en ajoutant du css.


<b>ASTUCE :</b> Ajouter le dépot Git "Leed-market" en sous-module du dépot Git "Leed"
* On se place dans le dossier www cd /var/www (répertoire local de vos dépots Git)
* On récupère Leed <code>git clone https://github.com/ldleman/Leed.git</code>
* On supprime plugins <code>rm -R Leed/plugins</code>
* On récupère Leed market <code>git clone https://github.com/ldleman/Leed-market.git plugins</code>
