<?php
class session{
    public static function is_user($login){
        return (!empty($_SESSION['login']) && ($_SESSION['login'] == $login));
    }

    public static function is_admin(){
        return (isset($_SESSION['is_admin']));
    }
}
