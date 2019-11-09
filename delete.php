<?php
    include_once("models/DanhBa.php");
    $id = $_REQUEST["id"];
    DanhBa::deleteDanhBaDB($id);
?>
        
