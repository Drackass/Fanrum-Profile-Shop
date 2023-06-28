<?php
require_once('config/path.class.php');
require_once(Path::CONFIG . 'global_variables.class.php');

require_once(Path::MODEL."modelPDO.class.php" );
require_once(Path::MODEL."modelProduct.class.php" );
require_once(Path::MODEL."modelUser.class.php" );
require_once(Path::MODEL."modelCategory.class.php" );

require_once(Path::LIB . 'cart.class.php');
require_once(Path::LIB . 'favorite.class.php');
require_once(Path::LIB . 'utils.class.php');
require_once(Path::CONTROLLER."routeur.php");