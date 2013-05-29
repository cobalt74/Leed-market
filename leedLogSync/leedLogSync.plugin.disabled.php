<?php
/*
@name leedLogSync
@author Cobalt74 <cobalt74@gmail.com>
@link http://www.cobestran.com
@licence CC by nc sa http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
@version 2.0.0
@description Le plugin permet l'affichage des logs de synchro du cron
*/


// affichage d'un lien dans le menu "Gestion"
function leedLogSync_plugin_AddLink(){
	echo '<li><a class="toggle" href="#leedLogSync">Logs Synchro. Cron</a></li>';
}

// affichage des option de recherche et du formulaire
function leedLogSync_plugin_AddForm(&$myUser){
	echo '<section id="leedLogSync" name="leedLogSync" class="leedLogSync">
			<h2>Logs dernière synchronisation</h2>';
	
	$dir    = './logs';
	
	$myUser = (isset($_SESSION['currentUser'])?unserialize($_SESSION['currentUser']):false);
	if($myUser!=false) {
		if ($myUser->getId()==1){
			
			$files = scandir($dir);

			if (isset($_POST['plugin_leedLogSync_file'])) {
				$fileLog = $dir.'/'.$_POST['plugin_leedLogSync_file'];
			} else {
				$fileLog = $dir.'/'.$myUser->getLogin().'.log';
			}
	
			echo '<form action="settings.php#leedLogSync" method="post">';
			echo '  <select name="plugin_leedLogSync_file">';
					foreach ($files as $key => $value) {
						if (!in_array($value,array(".","..", ".htaccess", "@eadir", ".DS_Store"))) { 
							 if (!is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
								if (isset($_POST['plugin_leedLogSync_file'])) {
									if ($_POST['plugin_leedLogSync_file']==$value) {
										echo '<option value="'.$value.'" selected>'.$value.'</option>'; 
									} else {
										echo '<option value="'.$value.'">'.$value.'</option>'; 
									}
								} else {
									if ($myUser->getLogin().'.log'==$value) {
										echo '<option value="'.$value.'" selected>'.$value.'</option>'; 
									} else {
										echo '<option value="'.$value.'">'.$value.'</option>'; 
									}
								}
							 }
						}
					}
			echo '  </select>
					<button type="submit">Afficher</button>
				  </form>';
			}
	}
	
	if (!isset($fileLog)) { $fileLog = $dir.'/'.$myUser->getLogin().'.log'; }
	if (isset($_POST['plugin_leedLogSync_file'])) {
		echo 'Affichage du fichier : '.$fileLog;
	
		if (file_exists($fileLog)){ 
			print_r(file_get_contents($fileLog)); 
		} else {
			echo '<li>Aucun fichier de log présent. </li><li>Fichier attendu: '.$fileLog.'</li>';
		}
	}

	$requete = 'SELECT count(1) FROM '.$myUser->getPrefixDatabase().'event';
  	$query = mysql_query($requete);
  	$count = mysql_result($query,0);
  	
	echo '<h2>Actuellement sur votre Leed</h2>';
  	echo '<li><b>Nombre d\'articles sur Leed : </b>'.$count.'</li>';
	
	echo '</section>';
}


// Ajout de la fonction au Hook situé avant l'affichage des évenements
Plugin::addHook("setting_post_link", "leedLogSync_plugin_AddLink");
Plugin::addHook("setting_post_section", "leedLogSync_plugin_AddForm");

?>
