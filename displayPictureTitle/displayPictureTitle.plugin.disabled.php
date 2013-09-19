<?php
/*
   @name DisplayPictureTitle
   @author Kvnco <kvnco@laposte.net>
   @link https://twitter.com/kvnco
   @licence CC by 3.0 http://creativecommons.org/licenses/by/3.0/fr/
   @version 1.0
   @description Permet d'afficher en dessous d'une image le texte apparaissant dans la basile title (utile pour les terminaux tactiles)
 */

function displayPictureTitle(&$event){
	echo "<script>
			var picts = document.getElementById('".$event->getId()."').getElementsByTagName('img');
			for (var i = 0; i < picts.length; i++) { 
				picts[i].insertAdjacentHTML('afterend', '<div class=\'img-title\'>' + picts[i].title + '</div>');
			}
		</script>";
}

// Ajout de la fonction au Hook situé avant l'affichage des évenements
Plugin::addCss("/css/style.css");
Plugin::addHook("event_post_content", "displayPictureTitle");  
?>
