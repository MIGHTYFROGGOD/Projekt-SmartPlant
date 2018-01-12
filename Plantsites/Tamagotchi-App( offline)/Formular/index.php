<?php
$nickname= '';
$mail= '';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nickname = $_POST["nickname"] ?? '';

  if (empty($nickname)) {
    array_push($errors, "Bitte geben Sie einen Benutzernamen ein.");
  } else if (!empty($nickname)) {

    $nickname = htmlspecialchars($nickname);

  }
  $mail = $_POST["email"] ?? '';

  if (empty($mail)) {
    array_push($errors, "Bitte geben Sie eine E-Mail ein.");
  } else if (!empty($mail)) {

    $mail = htmlspecialchars($mail);

  }
}
 ?>

<!DOCTYPE html>
<html lang="de">
<head>
  <metacharset="UTF-8">
  <title>Pflanzi</title>
  <link rel="stylesheet" href="../stylesheet/style.css">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
  <div class="tamagotchi">
    <a href="http://localhost/ProjectSmartPlant/Plantsites/Tamagotchi-App(%20offline)/index.php"></a>
  </div>
  <div class="formularwrapper">
    <form action ="index.php" method="post">
      <h1>Pflanzi Registrations-Formular </h1>
              <h3>Registriere Dich:</h3>
              <p><label class="nicknamelabel" for="nickname"><b>Nickname:</b></label>
                <input type="text" class="nickname" name="nickname">
              </p>
              <p><label class="emaillabel" for="email"><b>Email:</b></label>
                <input type="email" class="email" name="email">
            </p>

          <div class="submittbuttoncenter">
        <label for="submitbutton"><b>Abschicken</b>
          <input type="submit" class="submitbutton" name="send" value="SENDEN" />
            </div>
      </label>
      <?php
    if (!empty($errors)) { ?>
    <div class="errors">
      <ul>
      <?php
      foreach ($errors as $error_ausgabe) {
        echo '<li>' . $error_ausgabe . '</li>';
      } ?>
      </ul>
    </div>
    <?php } ?>
    </div>
      <?php

    if (empty($errors) && !empty($nickname) && !empty($mail)) {
      $stmt = '';
      $dbh = new PDO('mysql:host=localhost;dbname=pflanze', 'root' ,'');
      $stmt = $dbh->query("INSERT INTO `registration` (nickname,email) VALUES ('$nickname','$mail')");
    } ?>


    </div>
  </form>
</body>
</html>
