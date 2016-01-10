<!DOCTYPE html>
<html>
  <head>
    <?php include 'resources/includes/includes.php'; ?>
    <title>Reünie Nehalennia</title>
  </head>
  <body>
    <div>
      <?php
      $pagina = "index";
      include 'resources/includes/menu.php';
      ?>
      <div class="row" style="padding:0;">
        <div class="medium-10 medium-offset-1 columns" style="padding:0;">
          <iframe class="slideshow field" src="slideshow/slideshow.php" style="width: 100%; height: 300px; position: relative; z-index: -1; " >
            De slideshow kon niet geladen worden omdat uw browser geen iframes accepteert.
          </iframe>
        </div>
      </div>


      <div class="row" style="margin-top: -25px;">
        <div class="medium-10 medium-offset-1 columns">

          <div class="medium-12 left columns field header">
            <h4>Nehalennia Gymnasium Reunie</h4>
          </div>

          <div class="medium-12 columns field">
            <?php echo $cms_config["homepage-tekst"]; ?>
          </div>

          <div class='medium-12 columns field' style="text-align: center;">
            <a href="<?php echo $cms_config["facebook-link"]; ?>" target="_blank">
              <img src="resources/icon/fb.png" alt="Facebook"
                   style="width: 20%; min-width: 114px; height: auto;"/>
            </a>
          </div>

        </div>
      </div>

      <?php
      include 'resources/includes/footer.php';
      ?>
    </div>
  </body>
</html>
