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

    <div class="row">
      <div class="small-12 columns">
        <h1>Contactinformatie</h1>
        <p>
          U kunt contact opnemen met de organisatie van de reünie door een e-mail
          te sturen naar het adres
          <a href="mailto:<?php echo $config["e-mail"] ?>">
          <?php echo $config["e-mail"] ?></a>.
        </p>
        <p>
          <?php
          foreach ($config["contactgegevens"] as $gegeven) {
              echo $gegeven . "<br />";
          }
          ?>
        </p>      
      </div>
    </div>

    <?php
    include 'footer.php';
    ?>

  </body>
</html>
