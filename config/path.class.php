<?php

/**
 * Classe contenant les chemins d'accès pour les dossiers du projet.
 */
class Path {

    // Chemins à l'intérieur du dossier APP
    const CONTROLLER = "app/controller/";
    const MODEL = "app/model/";

    const VIEW = "app/view/";
    const V_BACKEND = "app/view/backend/";
    const PV_BACKEND = "app/view/backend/partials/";
    const V_FRONTEND = "app/view/frontend/";
    const PV_FRONTEND = "app/view/frontend/partials/";
    const V_ERROR = "app/view/error/";

    // Chemins à l'intérieur du dossier PUBLIC
    const IMG = "public/img/";
    const IMG_PRODUCT = "public/img/product/";
    const IMG_DESIGN = "public/img/design/";
    const IMG_PROFILE = "public/img/profile/";

    const JS = "public/js/"; 
    const CSS = "public/css/";

    // Autres chemins
    const CONFIG = "config/";
    const DATABASE = "config/database/";
    const LIB = "lib/";
}

?>