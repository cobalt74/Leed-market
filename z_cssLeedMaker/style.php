<?php
header("Content-type: text/css");
require_once('../../common.php');
$css = rawurldecode($configurationManager->get('plugin_cssLeedMaker_addcss'));
echo $css;
?> 