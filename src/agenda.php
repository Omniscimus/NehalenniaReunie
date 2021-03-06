<!DOCTYPE html>
<html>
<head>
  <?php include 'resources/includes/includes.php'; ?>
  <title>Reünie Nehalennia</title>
</head>
<body>
  <?php
  $pagina = "agenda";
  include 'resources/includes/menu.php';

  date_default_timezone_set("Europe/Amsterdam");
  $agenda = array(
    array("9:00 - 10:00", "Dansen aan de zee"),
    array("10:00 - 10:30", "Pauze")
  )
  ?>

  <div class="row">
    <div class="medium-10 medium-offset-1 columns">

      <div class="medium-12 columns field">
        <p>
          Hieronder ziet u een schema van de dagen van de reünie. U kunt ook een flyer downloaden met meer informatie over het programma door op <a href="reunie_klein.pdf" target="_blank">deze link</a> te klikken.
				</p>
				<p style="text-align: center; font-weight: bold;">
					ALLE ACTIVITEITEN VINDEN PLAATS OP DE LOCATIE BREEWEG VAN STEDELIJKE SCHOLENGEMEENSCHAP NEHALENNIA:
					<br><br>
					BREEWEG 71<sup>E</sup>
					<br>
					MIDDELBURG
				</p>
				<p>
					(Parkeermogelijkheden: achterzijde school in de Burgemeester Smytegeldlaan, parkeerterrein Sportcomplex De Sprong (tegenover de ingang van de school.))
				</p>
      </div>

      <div class="medium-12 columns field" style="padding: 0;">
        <table style="width: 100%; margin:0;">
          <tr>
            <th width="20%">Datum</th>
            <th width="20%">Tijd</th>
            <th>Activiteit</th>
          </tr>

          <?php
            $dag = "Vrijdag 18 maart 2016";
            $lasttime;
            foreach($cms_config["agenda"] as $item)
            {
                $tijd = $item[0];
                $agendapunt = $item[1];
                $thistime = strtotime(substr($tijd,0,5));
                if (isset($lasttime))
                {
                    if ($thistime < $lasttime)
                    {
                        $dag = "Zaterdag 19 maart 2016";
                    }
                }
                $lasttime = $thistime;
              echo "
              <tr>
                <td>$dag</td>
                <td class='time'>$tijd</td>
                <td>$agendapunt</td>
              </tr>";
            }
          ?>

        </table>
      </div>

    </div>
  </div>

  <?php
  include 'resources/includes/footer.php';
  ?>
</body>
</html>
