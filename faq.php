<!DOCTYPE html>
<html>
  <head>
    <?php include 'includes.php'; ?>
    <title>Veelgestelde vragen</title>
  </head>
  <body>

    <?php
    $pagina = "Veelgestelde vragen";
    include 'menu.php';
    ?>

    <div class="padding-top-1"></div>
    <div class="row">
      <div class="medium-10 medium-offset-1 columns">
        <h4>Veelgestelde vragen</h4>
        <p>
          Op deze pagina kunt u antwoorden vinden op een aantal vragen aangaande
          de reünie. Mocht u na het lezen van deze pagina nog vragen hebben, dan
          kunt u <a href="contact.php">contact opnemen</a> met ons.
        </p>
        <?php foreach ($config["veelgestelde-vragen"] as $vraag => $antwoord): ?>
        <p><h5><?php echo $vraag; ?></h5>
        <?php echo $antwoord; ?></p>
        <?php endforeach; ?>
        <h3></h3>
      </div>
    </div>

    <?php
    include 'footer.php';
    ?>

  </body>
</html>
