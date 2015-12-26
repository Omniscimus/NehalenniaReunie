<?php
$input_valid = 0;
if (is_string($_POST["email"])) {
    $input_valid++;
}
if (is_string($_POST["message"])) {
    $input_valid++;
}
?>

<!DOCTYPE html>
<html>
  <head>
      <?php include 'includes.php'; ?>
    <title>Contact</title>
  </head>
  <body>

    <?php
    $pagina = "contact";
    include 'menu.php';
    ?>

    <div>
        <?php $config = include 'config.php'; ?>
      <h1>Contactinformatie</h1>
      <h4>Organisatie</h4>
      <p>
        <?php echo $config["schoolnaam"] ?><br />
        <?php echo $config["postadres"] ?><br />
        e-mail: <?php echo $config["e-mail"] ?><br />
        tel. <?php echo $config["telefoon"] ?>
      </p>
      <?php if ($input_valid < 2): ?>
          <h4>Stuur een bericht</h4>
          <form method="POST" action="contact.php">
            <?php if ($input_valid != 0): ?>
                Vult u alstublieft alle velden in.<br />
            <?php endif; ?>
            Uw e-mailadres: <input type="email" name="email" /><br />
            Onderwerp<br />
            <input type="text" name="subject" /><br />
            Bericht<br />
            <input type="text" name="message" /><br />
            <input type="submit" />
          </form>
      <?php else: ?>
          <?php
          $to = $config["e-mail"];
          $subject = (is_string($_POST["subject"])) ? $_POST["subject"] : "";
          $message = $_POST["message"];
          if (mail($to, $subject, $message)) {
              echo "<p>Bedankt voor uw bericht!</p>";
          } else {
              echo "<p>Er is iets foutgegaan bij het verzenden van uw bericht.</p>";
          }
          ?>
      <?php endif; ?>
    </div>

    <?php
    include 'footer.php';
    ?>

  </body>
</html>
