<?php
$wasser=   $_POST["giessen"] ?? '';

?>
<!DOCTYPE html>
<html lang="de">
<head>
  <metacharset="UTF-8">
  <title>Pflanzi</title>
  <link rel="stylesheet" href="stylesheet/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>



    <div class="wrapper">
    <form action ="index.php" method="post">
    <h1>  Pflanzi</h1>
    <div  class="gif">
      <img src="https://media.giphy.com/media/11VosuGXFyZ88o/giphy.gif" alt="Pflanzi gif" />
      <h4>Giess deine Pflanze</h4>
    </div>
      <input type="submit" class="giessenbutton" name="giessen" value="1" />
    </form>
    </div>
    <?php



      $empfaenger = "fynnbucher1@gmail.com";
      $betreff = "Die Mail-Funktion";
      $from = "From: Fynn Bucher <fynnbucher1@gmail.com>\n";
      $from .= "Reply-To: fynnbucher1@gmail.com\n";
      $from .= "Content-Type: text/html\n";
      $text1 = "Ich verdurste!!";
      $text2 = "Ich ertrinke!!";
      $text3 = "Mir geht's suppi!!";

      date_default_timezone_set("Europe/Berlin");
      $timestamp = time();
      $datum = date("d.m.Y",$timestamp);
      $uhrzeit = date("H:i",$timestamp);
      $dbh = new PDO('mysql:host=localhost;dbname=pflanze', 'root' ,'');
      $stmt = $dbh->query("INSERT INTO daten (wasser) VALUES ($wasser)");


      $stmt = $dbh->prepare("SELECT COUNT(*) AS anzahl FROM daten");
      $stmt->execute();
      $anzahl_wasser = $stmt->fetch();
        if ($anzahl_wasser["anzahl"] <= 12) {
          $inhalt = "Ich verdurste!!!!:$datum $uhrzeit";
          $handle = fopen("../twitterBot/content.txt", "w+");
          fwrite($handle, $inhalt);
          fclose($handle);
          mail($empfaenger, $betreff, $text1, $from);

        } else if ($anzahl_wasser["anzahl"] >= 15) {
          $inhalt = "Ich ertrinke!!!!:$datum $uhrzeit";
          $handle = fopen("../twitterBot/content.txt", "w+");
          fwrite($handle, $inhalt);
          fclose($handle);
          mail($empfaenger, $betreff, $text2, $from);
        }
        elseif ($anzahl_wasser["anzahl"] === "13"||"14"||"15" ) {
          $inhalt = "Mir geth's supiii!!:$datum $uhrzeit";
          $handle = fopen("../twitterBot/content.txt", "w+");
          fwrite($handle, $inhalt);
          fclose($handle);
          mail($empfaenger, $betreff, $text3, $from);

          ini_set("SMTP","ssl://smtp.gmail.com");
          ini_set("smtp_port","465");

        }
    ?>
</body>
</html>
