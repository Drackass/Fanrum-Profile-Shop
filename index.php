<?php
    session_start();
    ob_start();
    // Si il existe un cookie id_user, donc si l'admin c'est déjà connecter
    if (isset($_COOKIE['id_user'])) {
        $_SESSION['id_user'] = $_COOKIE['id_user']; // Provoque une connexion automatique.
    }
    
    if (isset($_COOKIE['is_admin'])) {
        $_SESSION['is_admin'] = $_COOKIE['is_admin'];
    }
    require_once 'config/require.inc.php';


