<?php
$dbh = new PDO('mysql:host=localhost;dbname=pflanze', 'root' ,'');
$stmt = $dbh->("DELETE FROM daten WHERE wasser < 1");
?>