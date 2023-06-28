<?php

/**
 * Classe regroupant des fonctions/méthodes utilitaires.
 */
class Utils {
    
    /**
     * Retourne l'URI de la page précédente.
     * @return string URI
     */
    public static function getPreviousURI() {
        $URI = $_SERVER['HTTP_REFERER'];
        return $URI;
    }

    /**
     * Méthode permettant d'envoyer une alerte (notification).
     *
     * @param string $message Message à afficher
     * @param string $type Type de message à afficher (success, error, warning, info)
     * @param string $redirect URI de redirection
     * @return void
     * @package https://sweetalert2.github.io/
     */
    public static function putAlert($message, $type, $redirect) {
        $_SESSION["status"] = $message;
        $_SESSION["status_code"] = $type;
        header("Location:".$redirect);
        exit(0);
    }

    public static function showContentWithCustomPage($pageTitle,$navPath,$customPagePath) {
        GlobalVariables::$pageTitle = $pageTitle;
        GlobalVariables::$login = isset($_SESSION['id_user']) ? modelUser::getPseudoById($_SESSION['id_user']) : "Guest";
        GlobalVariables::$sessionProfilePic = modelUser::getProfilePicture();
        GlobalVariables::$navPath = "@".GlobalVariables::$login." / ".$navPath;
        $productsId = array_keys($_SESSION['cartProducts']);
        GlobalVariables::$cartProducts = array();
        foreach ($productsId as $key=>$id) {
          $theProduct = modelProduct::getProductById($id);
          GlobalVariables::$cartProducts[] = $theProduct;
        }
        if (isset($_SESSION['is_admin'])) {
            GlobalVariables::$theTables = modelePDO::getTableNames();
        }

        require(Path::PV_FRONTEND."v_header.inc.php");
        require(Path::PV_FRONTEND."v_sideNavbar.inc.php");
        echo "<main>";
        require(Path::PV_FRONTEND."v_topNavbar.inc.php");
        require($customPagePath);
        echo "</main>";
        require(Path::PV_FRONTEND."v_cart.inc.php");
        require(Path::PV_FRONTEND."v_footer.inc.php");
    }
}

