<?php
$wasser=   $_POST["giessen"] ?? '';
$nickname = '';
$mail = '';
$dbh = new PDO('mysql:host=localhost;dbname=pflanze', 'root' ,'');
$stmt=$dbh->query("SELECT nickname, email FROM registration");

$arr = $stmt->fetchAll();


$nickname = $arr[0]["nickname"];
$email = $arr[0]["email"];


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
  <div class="formular">
    <a href="http://localhost/ProjectSmartPlant/Plantsites/Tamagotchi-App(%20offline)/Formular/index.php"></a>
  </div>
  <div class="wrapper">
    <form action ="index.php" method="post">
      <h1>  Pflanzi</h1>
        <div  class="gif">
            <img src="https://media.giphy.com/media/11VosuGXFyZ88o/giphy.gif" alt="Pflanzi gif" />
              <h4>Giess deine Pflanze</h4>
        </div>
      <input type="submit" class="giessenbutton" name="giessen" value="1" />
    <?php
      date_default_timezone_set("Europe/Berlin");
      $timestamp = time();
      $datum = date("d.m.Y",$timestamp);
      $uhrzeit = date("H:i",$timestamp);
      //Datenbank Verbindung:
      $dbh = new PDO('mysql:host=localhost;dbname=pflanze', 'root' ,'');
      $stmt = $dbh->query("INSERT INTO daten (wasser) VALUES ($wasser)");
      $stmt = $dbh->prepare("SELECT COUNT(*) AS anzahl FROM daten");
      //Asuwertungen 1:Twitter 2:E-mail
      $stmt->execute();
      $anzahl_wasser = $stmt->fetch();
        if ($anzahl_wasser["anzahl"] <= 12) {
          $inhalt = "Ich verdurste!!!!:$datum $uhrzeit";
          $handle = fopen("../twitterBot/content.txt", "w+");
          fwrite($handle, $inhalt);
          fclose($handle);
          $text1 = "Ich verdurste!!!!";

        } else if ($anzahl_wasser["anzahl"] >= 15) {
          $inhalt = "Ich ertrinke!!!!:$datum $uhrzeit";
          $handle = fopen("../twitterBot/content.txt", "w+");
          fwrite($handle, $inhalt);
          fclose($handle);
          $text2 = "Ich ertrinke!!!!";

        } else if ($anzahl_wasser["anzahl"] === "13"||"14"||"15" ) {
          $inhalt = "Mir geth's supiii!!:$datum $uhrzeit";
          $handle = fopen("../twitterBot/content.txt", "w+");
          fwrite($handle, $inhalt);
          fclose($handle);
          $text3 = "Mir geth's supiii!!";
        }                                                          // Import PHPMailer classes into the global namespace
                                                                  // These must be at the top of your script, not inside a function
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        //Load composer's autoloader
        require 'vendor/vendor/autoload.php';

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            //$mail->SMTPDebug = 2;                               // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'pflanzi1.0@gmail.com';             // SMTP username
            $mail->Password = 'pflanzi12345';                     // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('pflanzi1.0@gmail.com', 'Pflanzimier Pflanzitch');
            $mail->addAddress("$email", "$nickname");     // Add a recipient
            //$mail->addAddress('urs.nussbaumer@ict-bz.ch', 'Urs Nussbaumer');                            Name is optional
            //$mail->addReplyTo('fynnbucher1@gmail.com', 'Fynn Bucher');
            //$mail->addCC('adasdasd');
            //$mail->addBCC('asdasdasd');

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Pflanzi_Mail';
            if ($anzahl_wasser["anzahl"] <= 12){
                $mail->Body = $text1;
                $mail->AltBody = $text1;
            }else if ($anzahl_wasser["anzahl"] >= 15){
              $mail->Body = $text2;
              $mail->AltBody = $text2;
            }else if ($anzahl_wasser["anzahl"] === "13"||"14"||"15" ){
              $mail->Body = $text3;
              $mail->AltBody = $text3;
            }

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    ?>
    </div>
  </form>
</body>
</html>
