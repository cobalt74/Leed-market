<?php
/*
@name Rss Maker
@author Idleman <idleman@idleman.fr>
@link http://blog.idleman.fr
@licence DWTFYW
@version 1.0.0
@description Créé un flux rss par dossiers de flux, ceci permet de créer de nouveaux flux pour une consultation plus synthétique
*/


function rssmaker_plugin_folder_link(&$folder){
	
	
	echo '<a  onclick="window.location=\'action.php?action=show_folder_rss&name='.$folder->getName().'&id='.$folder->getId().'\'" style="color:#cecece;font-size:10px;margin:5px 0 0 5px ;">Rss</a>';
		
}

function rssmaker_plugin_compare($a, $b) {
  return (strtotime($a->get_date())-strtotime($b->get_date()))*-1;
}

function rssmaker_plugin_action($_,$myUser){
	
	if($_['action']=='show_folder_rss'){
		header('Content-Type: text/xml; charset=utf-8');
		$feedManager = new Feed();
		$feeds = $feedManager->loadAll(array('folder'=>$_['id']));
		$items = array();
		foreach ($feeds as $feed) {
			$parsing = new SimplePie();
			$parsing->set_feed_url($feed->getUrl());
			$parsing->init();
			$parsing->set_useragent('Mozilla/4.0 Leed (LightFeed Agregator) '.VERSION_NAME.' by idleman http://projet.idleman.fr/leed');
			$parsing->handle_content_type(); // UTF-8 par défaut pour SimplePie
			$items = array_merge($parsing->get_items(),$items);
		}

		$link = 'http://projet.idleman.fr/leed';
	
		echo '<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" xmlns:slash="http://purl.org/rss/1.0/modules/slash/">
	<channel>
				<title>Leed dossier '.$_['name'].'</title>
				<atom:link href="'.$link.'" rel="self" type="application/rss+xml"/>
				<link>'.$link.'</link>
				<description>Aggrégation des flux du dossier leed '.$_['name'].'</description>
				<language>fr-fr</language>
				<copyright>DWTFYW</copyright>
				<pubDate>'.date('r', gmstrftime(time())) .'</pubDate>
				<lastBuildDate>'.date('r', gmstrftime(time())) .'</lastBuildDate>
				<sy:updatePeriod>hourly</sy:updatePeriod>
				<sy:updateFrequency>1</sy:updateFrequency>
				<generator>Leed (LightFeed Agregator) '.VERSION_NAME.'</generator>';

		usort($items, 'rssmaker_plugin_compare');

		foreach($items as $item){
			echo '<item>
				<title><![CDATA['.$item->get_title().']]></title>
				<link>'.$item->get_permalink().'</link>
				<pubDate>'.date('r', gmstrftime(strtotime($item->get_date()))).'</pubDate>
				<guid isPermaLink="true">'.$item->get_permalink().'</guid>
				
				<description>
				<![CDATA[
				'.$item->get_description().'
				]]>
				</description>
				<content:encoded><![CDATA['.$item->get_content().']]></content:encoded>
				
				<dc:creator>'.(''==$item->get_author()? 'Anonyme': $item->get_author()->name).'</dc:creator>
				</item>';

		}

		echo '</channel></rss>';
	}
	
}




//Ajout de la fonction squelette_plugin_displayEvents au Hook situé après le menu des flux
Plugin::addHook("menu_pre_folder_link", "rssmaker_plugin_folder_link");  
//Ajout de la fonction squelette_plugin_action à la page action de leed qui contient tous les traitements qui n'ont pas besoin d'affichage (ex :supprimer un flux, faire un appel ajax etc...)
Plugin::addHook("action_post_case", "rssmaker_plugin_action");  
?>