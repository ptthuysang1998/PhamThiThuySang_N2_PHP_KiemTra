<?php
    include_once("models/Label.php");
    $id = $_REQUEST["id"];
    Label::deleteLabelInDanhBa($id);
?>
        
