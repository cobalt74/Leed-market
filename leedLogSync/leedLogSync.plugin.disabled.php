<?php
/*
@name leedLogSync
@author Cobalt74 <cobalt74@gmail.com>
@link http://www.cobestran.com
@licence CC by nc sa http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
@version 1.1.0
@description Le plugin permet l'affichage des logs de synchro du cron
*/


// affichage d'un lien dans le menu "Gestion"
function leedLogSync_plugin_AddLink(){
	echo '<li><a class="toggle" href="#leedLogSync">Logs Synchro. Cron</a></li>';
}

// affichage des option de recherche et du formulaire
function leedLogSync_plugin_AddForm(){
	echo '<section id="leedLogSync" name="leedLogSync" class="leedLogSync">
			<h2>Logs dernière synchronisation</h2>';

	// Ouverture du fichier en lecture seule
	$handle = fopen('./logs/cron.log', 'r');
	// Si on a réussi à ouvrir le fichier
	if ($handle)
	{
		// Tant que l'on est pas à la fin du fichier
		while (!feof($handle))
		{
			// On lit la ligne courante
			$buffer = fgets($handle);
			// On l'affiche
			echo $buffer;
		}
		// On ferme le fichier
		fclose($handle);
	}
	echo '</section>';
}


// Ajout de la fonction au Hook situé avant l'affichage des évenements
Plugin::addHook("setting_post_link", "leedLogSync_plugin_AddLink");
Plugin::addHook("setting_post_section", "leedLogSync_plugin_AddForm");

?>
