<?php
class controllerAdmin{
  public function __construct()
  {
  }

  public function showTable() {
    if (isset($_SESSION['is_admin'])) {
      GlobalVariables::$theTable = $_REQUEST['tableName'];
      GlobalVariables::$theFields = modelePDO::getFieldNamesByTableInsert(GlobalVariables::$theTable);
      GlobalVariables::$theOccurrences = modelePDO::getTuplesByTable(GlobalVariables::$theTable);
      GlobalVariables::$nbTuples = modelePDO::getTupleCount(GlobalVariables::$theTable);
      // VariablesGlobales::$theTables = modelePDO::getTableNames();
      Utils::showContentWithCustomPage("Table ".GlobalVariables::$theTable." ⚙️","Administration / Table ".GlobalVariables::$theTable,Path::V_BACKEND."v_showTable.inc.php");

  }
  else {
    Utils::putAlert("Vous n'êtes pas autorisé à accéder à cette page", "error", "index.php?controller=Identification&action=showLogin");
  }

  }

  public function deleteOccurence() {
    
    GestionBoutique::deleteByTable($_POST['choicePrimaryKey'], $_SESSION['tableName'], $_SESSION['theFieldPrimaryKey']);
    header(Utils::getPreviousURI());
}
}
