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

  $agenda = array(
    array("9:00 - 10:00", "Dansen aan de zee"),
    array("10:00 - 10:30", "Pauze")
  )
  ?>

  <div class="row">
    <div class="medium-10 medium-offset-1 columns">

      <div class="medium-12 columns field">
        <p>
          Hieronder ziet u een schema van de dagen van de reünie.
        </p>
      </div>

      <div class="medium-12 columns field" style="padding: 0;">
        <table style="width: 100%; margin:0;">
          <tr>
            <th width="20%">Datum</th>
            <th width="20%">Tijd</th>
            <th>Agendapunt</th>
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
