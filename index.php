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

      <iframe class="slideshow" src="slideshow/header.php" style="width: 100%; height: 300px;" >
        De slideshow kon niet geladen worden omdat uw browser geen iframes accepteert.
      </iframe>

      <div class="row">
        <div class="medium-10 medium-offset-1 columns">

          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a diam
            lectus. Sed sit amet ipsum mauris. Maecenas congue ligula ac quam
            viverra nec consectetur ante hendrerit. Donec et mollis dolor. Praesent
            et diam eget libero egestas mattis sit amet vitae augue. Nam tincidunt
            congue enim, ut porta lorem lacinia consectetur. Donec ut libero sed
            arcu vehicula ultricies a non tortor. Lorem ipsum dolor sit amet,
            consectetur adipiscing elit. Aenean ut gravida lorem. Ut turpis felis,
            pulvinar a semper sed, adipiscing id dolor. Pellentesque auctor nisi id
            magna consequat sagittis. Curabitur dapibus enim sit amet elit pharetra
            tincidunt feugiat nisl imperdiet. Ut convallis libero in urna ultrices
            accumsan. Donec sed odio eros. Donec viverra mi quis quam pulvinar at
            malesuada arcu rhoncus. Cum sociis natoque penatibus et magnis dis
            parturient montes, nascetur ridiculus mus. In rutrum accumsan ultricies.
            Mauris vitae nisi at sem facilisis semper ac in est.
          </p>

          <div style="text-align: center;">
            <a href="<?php echo $config["facebook-link"]; ?>" target="_blank">
              <img src="resources/img/fb.png" alt="Facebook"
                   style="width: 10%; min-width: 114px; height: auto;"/>
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
