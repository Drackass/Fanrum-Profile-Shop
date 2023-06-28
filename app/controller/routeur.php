<?php

/* Contrôleur par défaut */
$controller = 'controllerHome';
$action = 'show';

/* Chargement du contrôleur */
if(!isset($_GET['controller']) && !isset($_GET['action'])){
	require(Path::CONTROLLER.$controller.".class.php");
    $controllerObject = new $controller();
	$controllerObject->$action();
}
else{
	if(isset($_GET['controller']) && !empty($_GET['controller'])){
		$controller = 'controller'. ucfirst($_GET['controller']);

		if(file_exists(Path::CONTROLLER. $controller . '.class.php')){
			require(Path::CONTROLLER. $controller . '.class.php');

			if(class_exists($controller)){
				if(isset($_GET['action'])){
					$action = $_GET['action'];
				}
				$cl = get_class_methods($controller);

				if(in_array($action, $cl)){
					$controllerObject = new $controller();
					$controllerObject->$action();
				}
				else{
					Utils::putAlert("Action non existante", "error", "index.php");
					
				}
			}
			else {
				Utils::putAlert("La classe du contrôleur n'existe pas", "error", "index.php");
			}
		}else{
			Utils::putAlert("Le contrôleur n'existe pas", "error", "index.php");
		}
	}else{
		Utils::putAlert("Le contrôleur n'a pas été défini ou champs vides", "error", "index.php");
	}
}
