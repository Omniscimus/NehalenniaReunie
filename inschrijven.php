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
    <div class="padding-top-1"></div>

    <div class="row">
      <div class="medium-10 medium-offset-1 columns">
        <h4>Inschrijven</h4>

          <div class="row">
            <div class="medium-6 large-8 columns left">
              <p>
                Hier kunt u zich inschrijven voor de reünie. Dit houd een
                aantal dingen in. blablablaaaa.

                Er zijn een aantal vereisten blablablaaa
                <ul>
                  <li>Je moet >4 jaar zijn</li>
                  <li>Je moet van koffie houden</li>
                  <li>Je moet ......</li>
                </ul>
              </p>
            </div>
            <div class="medium-6 large-4 columns right">

              <?php if ($input_valid < 2): ?>

                  <h5>Schrijf u in voor de reünie:</h5>
                  <?php if ($input_valid !== 0): ?>
                      <p>Gelieve alle velden in te vullen.</p>
                  <?php endif; ?>
                  <form action="inschrijven.php" method="POST">
                    <label>
                      Voornaam: <i style="color: #c40d4c">*</i>
                      <input type="text" name="voornaam" class="name-input" />
                    </label>
                    <label>
                      Achternaam: <i style="color: #c40d4c">*</i>
                      <input type="text" name="achternaam" class="name-input" />
                    </label>
                    <br />
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

      </div>
    </div>

    <?php
    include 'footer.php';
    ?>

  </body>
</html>
