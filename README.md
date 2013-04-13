Leed-market
===========

Le dépot Leed market contient tous les plugins à jour et approuvés officiellement pour le logiciel Leed.

wiki plugins : http://projet.idleman.fr/leed/?page=Plugins

ASTUCE : Ajouter le dépot Git "Leed-market" en sous-module du dépot Git "Leed"
* On se place dans le dossier www cd /var/www (répertoire local de vos dépots Git)
* On récupère Leed <code>git clone https://github.com/ldleman/Leed.git</code>
* On supprime plugins <code>rm -R Leed/plugins</code>
* On récupère Leed market <code>git clone https://github.com/ldleman/Leed-market.git plugins</code>