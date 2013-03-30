<?php
/*
@name cacheListFeed
@author Cobalt74 <cobalt74@gmail.com>
@link http://www.cobestran.com
@licence CC by nc sa http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
@version 1.0.0
@description Le plugin cacheListFeed permet de cacher la liste des feed afin de lire les news en plein écran.
*/

function cacheListFeed_plugin_AddButton(&$event){
  echo '<div class="cacheListFeed_divbut" title="Cacher la liste des Feeds" onclick="cacheListFeed_toggle_div(this,\'menuBar\');">></div>';
}

// Ajout de la fonction au Hook situé avant l'affichage des évenements
Plugin::addCss("/css/style.css"); 
Plugin::addJs("/js/main.js");
Plugin::addHook("menu_pre_folder_menu", "cacheListFeed_plugin_AddButton"); 
?>
