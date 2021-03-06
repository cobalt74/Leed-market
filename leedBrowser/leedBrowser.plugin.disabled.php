<?php
/*
@name Leed Browser
@author Idleman <idleman@idleman.fr>
@link http://blog.idleman.fr
@licence GNU/GPL
@version 1.1.1
@description Lors du clic sur un lien d'événement, le site est ouvert dans un navigateur discret qui permet de rester dans Leed et d'effectuer des actions sur le site en cours de consultation (marquer comme lu, favoriser...)
*/



function leedbrowser_plugin_link(&$events){
	foreach($events as $event){
		$event->setLink(Plugin::path().'browser.php?event='.$event->getId().'&link='.$event->getLink());
	}
}

//Ajout du javascript au bas de page de leed
Plugin::addJs("/js/main.js"); 
 
//Ajout de la fonction squelette_plugin_action à la page action de leed qui contient tous les traitements qui n'ont pas besoin d'affichage (ex :supprimer un flux, faire un appel ajax etc...)
Plugin::addHook("index_post_treatment", "leedbrowser_plugin_link");  
?>
