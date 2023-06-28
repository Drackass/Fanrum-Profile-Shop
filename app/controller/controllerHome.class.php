<?php

class controllerHome{

  public function __construct() {
        
  }

  public function show(){
    GlobalVariables::$categories = modelCategory::readAll();
    GlobalVariables::$products = modelProduct::readAll();
    Utils::showContentWithCustomPage("SAUZET SHOP 👋","Products",Path::V_FRONTEND."v_home.inc.php");
  }

  public function showApropos(){
    Utils::showContentWithCustomPage("A Propos ℹ️","Products",Path::V_FRONTEND."v_propos.inc.php");
  }
  
}
