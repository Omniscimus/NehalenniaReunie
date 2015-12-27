<!DOCTYPE html>
<html>
  <head>
    <?php include 'includes.php'; ?>
    <title>Veelgestelde vragen</title>
  </head>
  <body>

    <?php
    $pagina = "faq";
    include 'menu.php';
    ?>

    <div class="row">
      <div class="small-12 columns">
        <h1>Veelgestelde vragen</h1>
        <p>
          Op deze pagina kunt u antwoorden vinden op een aantal vragen aangaande
          de reünie. Mocht u na het lezen van deze pagina nog vragen hebben, dan
          kunt u <a href="contact.php">contact opnemen</a> met ons.
        </p>
        <?php foreach ($config["veelgestelde-vragen"] as $vraag => $antwoord): ?>
        <h4><?php echo $vraag; ?></h4>
        <p><?php echo $antwoord; ?></p>
        <?php endforeach; ?>
        <h3></h3>
      </div>
    </div>

    <?php
    include 'footer.php';
    ?>

  </body>
</html>
