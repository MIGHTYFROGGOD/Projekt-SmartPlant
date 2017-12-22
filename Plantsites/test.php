<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Pflanzi</title>
  <link rel="stylesheet" href="stylesheet/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>

  <h1>kaofksdfasf</h1>


    <form action ="index.php" method="post">
      </form>
    </body>
    </html>
<?php


$dbh = new PDO('mysql:host=localhost;dbname=pflanze', 'root' ,'');

$stmt = $dbh->query("DELETE FROM daten WHERE id < 139");
var_dump($stmt);

?>
