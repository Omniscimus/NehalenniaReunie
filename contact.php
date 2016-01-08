<!DOCTYPE html>
<html>
  <head>
    <?php include 'includes.php'; ?>
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
    include 'menu.php';
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
        <div class="small-12 columns field" style="padding: 0;">
          <div id="map">De kaart kon helaas niet geladen
            worden...</div>
        </div>
      </div>
    </div>


    <?php
    include 'footer.php';
    ?>

  </body>
</html>
