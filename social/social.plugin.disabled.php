<?php
/*
@name Social
@author Cobalt74 <cobalt74@gmail.com>
@link http://www.cobestran.com
@licence CC by nc sa http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
@version 2.2.0
@description Le plugin Social permet de partager les news avec son réseau social préféré
*/

function Social_plugin_AddButton(&$event){
  $eventId = "social_".$event->getId();
  //$link = $event->getLink();
  
  $requete = 'SELECT link FROM '.$event->getPrefixTable().'event WHERE id = '.$event->getId();
  $query = mysql_query($requete);
  $link = mysql_result($query,0);
  	
  echo '<div class="social_group">
          <div class="social_divbut" onclick="social_toggle_div(this,\''.$eventId.'\');">+ Partager</div>
          <div class="social_gdiv" id="'.$eventId.'" style="display:none">
            <div onclick="openURL(\'https://twitter.com/share?url='.$link.'\');" class="social_div">Twitter</div> 
            <div onclick="openURL(\'http://www.facebook.com/share.php?u='.$link.'\');" class="social_div">Facebook</div> 
            <div onclick="openURL(\'https://plus.google.com/share?url='.$link.'&hl=fr\');" class="social_div">Google+</div>
          </div>
        </div>';
}

// Ajout de la fonction au Hook situé avant l'affichage des évenements
Plugin::addJs("/js/main.js");
Plugin::addHook("event_post_top_options", "Social_plugin_AddButton"); 
?>
