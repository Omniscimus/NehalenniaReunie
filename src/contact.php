<!DOCTYPE html>
<html>
  <head>
    <?php include 'resources/includes/includes.php'; ?>
    <title>Contact</title>
        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <script type="text/javascript">
        <!--
        function initializemap()
        {
            var div = document.getElementById("map");
            var neh =  new google.maps.LatLng(51.494377, 3.596289)
            var mapoptions = {
                    center: neh,
                    zoom: 11,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
            var map = new google.maps.Map(div, mapoptions);

                var marker = new google.maps.Marker({
                    position: neh,
                    map: map,
                    title:"SSG Nehalennia"
                });

                var contentString = "<a href=\"http://pr.nehalennia.nl\" target=\"_new\">SSG Nehalennia</a><br>Breeweg 71E<br>4335 AP, Middelburg<br>tel. 0123-456789";
                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });

                google.maps.event.addListener(marker, 'click', function() {
                  infowindow.open(map,marker);
                });
          }
          //-->
        </script>
        <style type="text/css">
        div#map
        {
            width: 100%;
            height: 400px;
            background-color: #DDDDDD;
            padding: 20px;
        }
        </style>
  </head>
  <body onload="initializemap();">

    <?php
    $pagina = "contact";
    include 'resources/includes/menu.php';
    ?>
    <div class="padding-top-1"></div>
    <div class="row">
      <div class="medium-10 medium-offset-1 columns">

        <div class="small-12 columns field">
          <h4>Contactinformatie</h4>
          <p>
            U kunt contact opnemen met de organisatie van de reünie door een e-mail
            te sturen naar het adres
            <a href="mailto:<?php echo $cms_config["e-mail"] ?>">
              <?php echo $cms_config["e-mail"] ?></a>.
          </p>
          <p>
            <?php
            foreach ($cms_config["contactgegevens"] as $gegeven) {
              echo $gegeven . "<br />";
            }
            ?>
          </p>
        </div>

      <div data-equalizer>
        <div class="medium-6 columns field" data-equalizer-watch>
          <h5>Ik kom met het openbaar vervoer</h5>
          <p>
            De trein uit de richting van Roosendaal arriveert 16 minuten na heel en half op station Middelburg. Aan uw kant van het station is meteen het busstation. U kunt met lijn 53, 56 en 58 reizen naar halte Toorenvliedt. U bent dan bij Nehalennia Kruisweg. Loop de Kruisweg uit en ga aan het einde naar rechts, de Breeweg in. Nehalennia Breeweg is na ongeveer 300 meter aan uw rechterzijde.
          </p>
        </div>

        <div class="medium-6 columns field" data-equalizer-watch>
          <h5>Ik kom met het de auto</h5>
          <p>
            Rij naar de Breeweg. Direct tegenover de Nehalennia Breeweg vindt u de Aanloop (met een groot bord "De Sprong"). Aan het einde van deze straat is voldoende (gratis) parkeergelegenheid.
          </p>
        </div>
      </div>

        <div class="small-12 columns field" style="padding: 0;">
          <div id="map">De kaart kon helaas niet geladen
            worden...</div>
        </div>

      </div>
    </div>


    <?php
    include 'resources/includes/footer.php';
    ?>

  </body>
</html>
