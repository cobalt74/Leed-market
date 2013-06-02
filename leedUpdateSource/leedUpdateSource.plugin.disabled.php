<?php
/*
@name LeedUpdateSource
@author Cobalt74 <cobalt74@gmail.com>
@link http://www.cobestran.com
@licence CC by nc sa http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
@version 2.0.0
@description Pour être toujours à jour avec Leed et ces plugins. Ce plugin récupère le zip du projet GIT et le dezippe directement sur votre environnement
*/

/**
 * les deux fonction suivante ont été récupéré dans les exemples de php.net puis adapté pour leed. 
 *
 * Unzip the source_file in the destination dir
 *
 * @param   string      The path to the ZIP-file.
 * @param   string      The path where the zipfile should be unpacked, if false the directory of the zip-file is used
 * @param   boolean     Indicates if the files will be unpacked in a directory with the name of the zip-file (true) or not (false) (only if the destination directory is set to false!)
 * @param   boolean     Overwrite existing files (true) or not (false)
 *  
 * @return  boolean     Succesful or not
 */
function unzip_leed($src_file, $dest_dir=false, $create_zip_name_dir=true, $overwrite=true) 
{
  if ($zip = zip_open($src_file)) 
  {
    if ($zip) 
    {
      $splitter = ($create_zip_name_dir === true) ? "." : "/";
      if ($dest_dir === false) $dest_dir = substr($src_file, 0, strrpos($src_file, $splitter))."/";
      
      // Create the directories to the destination dir if they don't already exist
      create_dirs($dest_dir);

      // For every file in the zip-packet
      while ($zip_entry = zip_read($zip)) 
      {
        // Now we're going to create the directories in the destination directories

        // If the file is not in the root dir
        $pos_last_slash = strrpos(zip_entry_name($zip_entry), "/");
        if ($pos_last_slash !== false)
        {
          // Create the directory where the zip-entry should be saved (with a "/" at the end)
          $interne_dir = str_replace("Leed-master/", "", substr(zip_entry_name($zip_entry), 0, $pos_last_slash+1));
          $interne_dir = str_replace("Leed-multi_user/", "", $interne_dir);
          $interne_dir = str_replace("Leed-market-master/", "", $interne_dir);
          $interne_dir = str_replace("Leed-market-multi_user/", "", $interne_dir);
          $interne_dir = str_replace("Leed-dev/", "", $interne_dir);
          create_dirs($dest_dir.$interne_dir);
        }

        // Open the entry
        if (zip_entry_open($zip,$zip_entry,"r")) 
        {
          
          // The name of the file to save on the disk
          $file_name = $dest_dir.zip_entry_name($zip_entry);
          
          // Check if the files should be overwritten or not
          if ($overwrite === true || $overwrite === false && !is_file($file_name))
          {
            // Get the content of the zip entry
            $fstream = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
			
			$file_name = str_replace("Leed-master/", "", $file_name);
			$file_name = str_replace("Leed-multi_user/", "", $file_name);
			$file_name = str_replace("Leed-market-master/", "", $file_name);
			$file_name = str_replace("Leed-market-multi_user/", "", $file_name);
			$file_name = str_replace("Leed-dev/", "", $file_name);
        	if (is_dir($file_name)){
	            	echo "répertoire: ".$file_name."<br />";
	        } else {
    	        if(file_put_contents($file_name, $fstream )===false) {
		            echo "erreur copie: ".$file_name."<br />";
	            } else {
    	    	    echo "copie: ".$file_name."<br />";
            	}
            }
          }
          // Close the entry
          zip_entry_close($zip_entry);
        }       
      }
      // Close the zip-file
      zip_close($zip);
    }
  } 
  else
  {
    return false;
  }
  
  return true;
}

/**
 * This function creates recursive directories if it doesn't already exist
 *
 * @param String  The path that should be created
 *  
 * @return  void
 */
function create_dirs($path)
{
  if (!is_dir($path))
  {
    $directory_path = "";
    $directories = explode("/",$path);
    array_pop($directories);
    
    foreach($directories as $directory)
    {
      $directory_path .= $directory."/";
      if (!is_dir($directory_path))
      {
        mkdir($directory_path);
        chmod($directory_path, 0775);
      }
    }
  }
}


// affichage d'un lien dans le menu "Gestion"
function plugin_leedUpdateSource_AddLink(){
	echo '<li><a class="toggle" href="#leedUpdateSource">MAJ de Leed</a></li>';
}

// affichage des option de recherche et du formulaire
function plugin_leedUpdateSource_AddForm(){
	echo '<section id="leedUpdateSource" name="leedUpdateSource" class="leedUpdateSource">
			<h2>Mettre à jour Leed</h2>
			<li>Récupération des sources (zip) sur le dépôt Git (sources de développement)</li>
			<li>Dézippage sur votre installation</li>
			<li>Simple et rapide ! :) </li>
			<br />

			<b>Attention :</b> ce plugin est utilisé afin de récupérer les corrections de bug.
			<li>Les plugins ne seront pas touchés
			<li>En cas de mise à jour de la base de données, reportez vous au <a href="about.php">site web</a> du projet
			<li>Bien attendre le retour automatique sur cette page après lancement ...
			<li>Dernier conseil : il faut que PHP puisse écrire dans votre répertoire leed.
			<br />
			<form action="settings.php#leedUpdateSource" method="post">
				Sources : 
				<select name="plugin_leedUpdateSource_source">
                    <option value="https://github.com/ldleman/Leed/archive/master.zip">Idleman - stable</option>
                    <option value="https://github.com/ldleman/Leed/archive/dev.zip">Idleman - en développement</option>
                    <option value="https://github.com/cobalt74/Leed/archive/multi_user.zip">Cobalt74 - Multi User</option>
                </select>
				<button type="submit">lancer</button>
			</form>
			<br />
			';
	if(isset($_POST['plugin_leedUpdateSource_source'])){
		plugin_leedUpdateSource();
	}
	echo '	<h2>Mettre à jour les plugins de Leed</h2>
			<li>Récupération des sources (zip) sur le dépôt Git (sources de développement)</li>
			<br />
			<b>Attention :</b> ce plugin est utilisé afin de récupérer les corrections de bug.
			<li>Les plugins seront tous mis à jour.
			<li>En cas de mise à jour de la base de données, reportez vous au <a href="about.php">site web</a> du projet
			<li>Bien attendre le retour automatique sur cette page après lancement ...
			<li>Dernier conseil : il faut que PHP puisse écrire dans votre répertoire leed.
			<br />
			<form action="settings.php#leedUpdateSource" method="post">
				Sources : 
				<select name="plugin_leedUpdateSource_sourcePlugin">
                    <option value="https://github.com/ldleman/Leed-market/archive/master.zip">Idleman</option>
                    <option value="https://github.com/cobalt74/Leed-market/archive/multi_user.zip">Cobalt74 - Multi User</option>
                </select>
				<button type="submit">lancer</button>
			</form>
			';
    if(isset($_POST['plugin_leedUpdateSource_sourcePlugin'])){
		plugin_leedUpdateSourcePlugin();
	}
	echo '</section>';
}

function plugin_leedUpdateSource(){
	//récupération du fichier
	$lienMasterLeed = $_POST['plugin_leedUpdateSource_source'];
	echo $lienMasterLeed;
	create_dirs(Plugin::path().'upload/');
	$fichierCible = './'.Plugin::path().'upload/LeedMaster.zip';
	if (copy($lienMasterLeed, $fichierCible)){
		echo '<h3>Opérations</h3>';
		echo 'Fichier <a href="'.$lienMasterLeed.'">'.$lienMasterLeed.'</a> téléchargé<br /><br />';
		$retour = unzip_leed($fichierCible,'./',false,true);
		if ($retour){echo '<b>Opération réalisée avec succès</b>';}else{echo '<b>Opération réalisée avec des erreurs</b>';};
	} else {
		echo 'récupération foireuse du fichier zip';
	}
}

function plugin_leedUpdateSourcePlugin(){
	//récupération du fichier
	$lienMasterLeedPlugin = $_POST['plugin_leedUpdateSource_sourcePlugin'];
	echo $lienMasterLeedPlugin;
	create_dirs(Plugin::path().'upload/');
	$fichierCible = './'.Plugin::path().'upload/LeedMasterPlugin.zip';
	if (copy($lienMasterLeedPlugin, $fichierCible)){
		echo '<h3>Opérations</h3>';
		echo 'Fichier <a href="'.$lienMasterLeedPlugin.'">'.$lienMasterLeedPlugin.'</a> téléchargé<br /><br />';
		$retour = unzip_leed($fichierCible,'./plugins/',false,true);
		if ($retour){echo '<b>Opération réalisée avec succès</b><br />';}else{echo '<b>Opération réalisée avec des erreurs</b>';};
	} else {
		echo 'récupération foireuse du fichier zip';
	}
	
	// si des plugins sont actifs, les fichiers enabled sont a remplacer par les fichiers disabled
	// parcourir tous les répertoires de plugins
	if ($retour) {
		$dir    = './plugins/';
		$files = glob($dir.'*/*.plugin.disabled.php');
		foreach ($files as $value) {
			if (file_exists($value) && file_exists(str_replace('.plugin.disabled.php', '.plugin.enabled.php', $value))) {
					rename($value,str_replace('.plugin.disabled.php', '.plugin.enabled.php', $value));
					echo 'renomage du fichier : '.$value.' en '.str_replace('.plugin.disabled.php', '.plugin.enabled.php', $value).'<br />';
			}
		}
	}
	echo '<b>Toutes les opérations sont terminées. Vos plugins sont à jour</b>';
}


$myUser = (isset($_SESSION['currentUser'])?unserialize($_SESSION['currentUser']):false);
if($myUser!=false) {
	if ($myUser->getId()==1){
		// Ajout de la fonction au Hook situé avant l'affichage des évenements
		Plugin::addHook("setting_post_link", "plugin_leedUpdateSource_AddLink");
		Plugin::addHook("setting_post_section", "plugin_leedUpdateSource_AddForm");
	}
}

?>
