<!DOCTYPE html>
<html>
  <head>
    <?php include 'includes.php'; ?>
    <title>Reünie Nehalennia</title>
  </head>
  <body>
    <div>
      <?php
      $pagina = "index";
      include 'menu.php';
      ?>

      <iframe class="slideshow field" src="slideshow/header.php" style="width: 100%; height: 300px; position: relative; z-index: -1; " >
        De slideshow kon niet geladen worden omdat uw browser geen iframes accepteert.
      </iframe>

      <div class="row" style="margin-top: -4em;">
        <div class="medium-10 medium-offset-1 columns">

          <div class="medium-12 left columns field header">
            <h4>Nehalennia Gymnasium Reunie</h4>
          </div>

          <div class="medium-12 columns field">
            <?php echo $cms_config["homepage-tekst"]; ?>
          </div>

          <div class='medium-12 columns field' style="text-align: center;">
            <a href="<?php echo $cms_config["facebook-link"]; ?>" target="_blank">
              <img src="resources/img/fb.png" alt="Facebook"
                   style="width: 20%; min-width: 114px; height: auto;"/>
            </a>
          </div>

        </div>
      </div>

      <?php
      include 'footer.php';
      ?>
    </div>
  </body>
</html>
