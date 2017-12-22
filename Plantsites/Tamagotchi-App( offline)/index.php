<?php
$wasser= $_POST["giessen"] ?? '';

?>
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



    <div class="wrapper">
    <form action ="index.php" method="post">
    <h1>Pflanzi</h1>
    <div class="gif">
      <img src="https://media.giphy.com/media/11VosuGXFyZ88o/giphy.gif" alt="Pflanzi gif" />
      <h4>Giess deine Pflanze</h4>
    </div>
      <input type="submit" class="giessenbutton" name="giessen" value="1" />
    </form>
    </div>
    <?php
      $dbh = new PDO('mysql:host=localhost;dbname=pflanze', 'root' ,'');
      $stmt = $dbh->query("INSERT INTO daten (wasser) VALUES ($wasser)");


      $stmt = $dbh->prepare("SELECT COUNT(*) AS anzahl FROM daten");
      $stmt->execute();
      $anzahl_wasser = $stmt->fetch();
        if ($anzahl_wasser["anzahl"] <= 6) {
          echo "Ich verdurste!!!!";
        } else if ($anzahl_wasser["anzahl"] >= 10) {
          echo "Ich ertrinke!!!!";
        }
        elseif ($anzahl_wasser["anzahl"] === "7"||"8"||"9" ) {
          echo "mir gehts supiiii!";
        }

    ?>
</body>
</html>
