<?php
$dbh = new PDO('mysql:host=localhost;dbname=pflanze', 'root' ,'');
$stmt = $dbh->prepare("SELECT COUNT(*) AS anzahl FROM daten");
      $stmt->execute();
      $anzahl_wasser = $stmt->fetch();
      if ($anzahl_wasser["anzahl"] >=13) {
	$stmt = $dbh->query("DELETE FROM daten WHERE id > 297 AND id > 298 AND id > 299 AND id > 300 AND id > 301 AND id > 301 AND id > 302 AND id > 303 AND id > 304 AND id > 305 AND id > 337 AND id > 338 AND id > 339");
      }
?>