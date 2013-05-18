<?php
require_once("../../common.php");
$rootPath=$configurationManager->get('root');

try{
	$event = $eventManager->getById($_GET['event']);
} catch (Exception $e) {
    echo 'Impossible d\'ouvrir l\'évenement : ',  $e->getMessage(), "\n";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html id="leed-browser" xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=8,chrome=1">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="css/default.css" rel="stylesheet" />
</head>
<body>
<div id="browser-bar">
<div id="browser-logo">L<i>eed</i> <span>browser</span></div>
<ul id="browser-toolbar">
	<li><button <?php  if(!$event->getUnread()){ ?>class="eventRead"<?php } ?> onclick="readUnread(this,<?php echo $_GET['event'].',\''.$rootPath.'\''; ?>);">Marquer comme <?php echo (!$event->getUnread()?'non lu':'lu'); ?></button></li>
	<li><button <?php  if($event->getFavorite()){ ?>class="eventFavorite"<?php } ?> onclick="favorize(this,<?php echo $_GET['event'].',\''.$rootPath.'\''; ?>);"><?php echo (!$event->getFavorite()?'Favoriser':'Défavoriser'); ?></button></li>
	<?php Plugin::callHook("leed_browser_toolbar", array(&$events)); ?>
	<li><button onclick="window.location='<?php echo $_GET['link']; ?>';">Sortir</button></li>
</ul>
</div>
<iframe id="browser-content" src="<?php echo $_GET['link']; ?>"></iframe>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>