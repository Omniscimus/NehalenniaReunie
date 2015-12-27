<?php
$input_valid = 0;
if (is_string($_POST["voornaam"])) {
    $input_valid++;
}
if (is_string($_POST["achternaam"])) {
    $input_valid++;
}
?>

<!DOCTYPE html>
<html>
  <head>
    <?php include 'includes.php'; ?>
    <title>Inschrijven</title>
  </head>
  <body>

    <?php
    $pagina = "inschrijven";
    include 'menu.php';
    ?>

    <div class="row">
      <div class="small-12 columns">
        <h1>Inschrijven</h1>

        <?php if ($input_valid < 2): ?>

            <p>Schrijf u in voor de reünie:</p>
            <?php if ($input_valid !== 0): ?>
                <p>Gelieve alle velden in te vullen.</p>
            <?php endif; ?>
            <form action="inschrijven.php" method="POST">
              Voornaam: <i style="color: #c40d4c">*</i>
              <input type="text" name="voornaam" class="name-input" />
              Achternaam: <i style="color: #c40d4c">*</i>
              <input type="text" name="achternaam" class="name-input" /><br />
              <input type="submit" value="Versturen" class="button" />
            </form>

        <?php elseif ($input_valid === 2): ?>

            <?php
            require_once 'MySQL_Manager.php';
            $mysql = new MySQL_Manager();
            $mysql->connect();
            $mysql->insertNewSubscription($_POST["voornaam"], $_POST["achternaam"]);
            $mysql->closeConnection();
            ?>
            <p>Bedankt voor uw inschrijving!</p>

        <?php endif; ?>

      </div>
    </div>

    <?php
    include 'footer.php';
    ?>

  </body>
</html>
