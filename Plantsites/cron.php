<?php
$dbh = new PDO('mysql:host=localhost;dbname=pflanze', 'root' ,'');
$stmt = $dbh->prepare("SELECT COUNT(*) AS anzahl FROM daten");
      $stmt->execute();
      $anzahl_wasser = $stmt->fetch();
      if ($anzahl_wasser["anzahl"] >=13) {
	$stmt = $dbh->query("DELETE FROM daten WHERE id > 0 AND id > 1 AND id > 2 AND id > 3 AND id > 4 AND id > 5 AND id > 6 AND id > 7 AND id > 8 AND id > 9 AND id > 10 AND id > 11");
      }
?>