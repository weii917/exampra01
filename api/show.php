<?php
include_once "db.php";
$row = $Que->find($_POST['id']);
// $row['sh'] = ($row['sh'] == 2) ? 0 : 1;
$row['sh'] = ($row['sh'] + 1) % 2;
$Que->save($row);
