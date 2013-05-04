<?php

mysql_query('

CREATE TABLE IF NOT EXISTS `'.MYSQL_PREFIX.'plugin_feaditlater` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indexidUser` (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

');

?>
