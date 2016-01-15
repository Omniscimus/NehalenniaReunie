<!DOCTYPE html>
<html>
  <head>
    <?php include 'resources/includes/includes.php'; ?>
    <title>Veelgestelde vragen</title>
  </head>
  <body>

    <?php
    $pagina = "Veelgestelde vragen";
    include 'resources/includes/menu.php';
    ?>

    <div class="padding-top-1"></div>
    <div class="row">
      <div class="medium-10 medium-offset-1 columns">
        <div class="small-12 columns field">

          <h4>Veelgestelde vragen</h4>
          <p>
            Op deze pagina kunt u antwoorden vinden op een aantal vragen aangaande
            de reünie. Mocht u na het lezen van deze pagina nog vragen hebben, dan
            kunt u <a href="contact.php">contact opnemen</a> met ons.
          </p>

        </div>
        <?php foreach ($cms_config["veelgestelde-vragen"] as $vraag => $antwoord): ?>
          <div class="small-12 medium-6 columns field">
            <h5><?php echo $vraag; ?></h5>
            <p><?php echo $antwoord; ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <?php
    include 'resources/includes/footer.php';
    ?>

  </body>
</html>
