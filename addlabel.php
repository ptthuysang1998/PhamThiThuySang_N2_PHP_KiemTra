
<?php
    include_once("models/Label.php");
    $id_label = $_REQUEST["idlabel"];
    $id_danhba = $_REQUEST["iddanhba"];
    Label::addDanhBaToLabel($id_danhba, $id_label);
?>
