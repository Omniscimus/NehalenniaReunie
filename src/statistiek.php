 <!DOCTYPE html>
<html>
<head>
  <?php include 'resources/includes/includes.php'; ?>
  <title>Reünie Nehalennia</title>
</head>
<body>
  <?php
  $pagina = "deelnemers";
  include 'resources/includes/menu.php';
  ?>

  <div class="row">
    <div class="medium-10 medium-offset-1 columns">

      <div class="medium-12 columns field">
        <p>
          Hieronder een aantal gegevens over de inschrijvingen.
        </p>
      </div>

      <div class="medium-12 columns field" style="padding: 0;">
        <h5 style="text-align: center;">Gegevens</h5>
        <table style="width: 100%; margin:0;">
          <tr>
            <th width="80%">Inschrijvingen</th>
            <th>Aantal</th>
          </tr>

          <?php
            require_once 'resources/includes/MySQL_Manager.php';
            $mysql = new MySQL_Manager();
            try {
                $mysql->connect();
                $results = $mysql->getSubsByDay();
                $mysql->closeConnection();
                
                $vrijdag = 0;
                $zaterdag = 0;
                $beide = 0;
                $les = 0;
                $i=0;
                while ( $row = mysql_fetch_row($results) ) {
                    /*echo "<tr>";
                    echo "<td>$row[0] $row[1]</td>";
                    echo "<td style=\"text-align: center\">$row[2]</td>";
                    echo "</tr>";*/
                    if ($row[0] && $row[1])
                    {
                        $beide++;
                    }
                    elseif($row[0])
                    {
                        $vrijdag++;
                    }
                    elseif($row[1])
                    {
                        $zaterdag++;
                    }
                    if ($row[2])
                    {
                        $les++;
                    }
                    $i++;
                }
                echo "<tr><td>Totaal</td><td>$i</td></tr>";
                echo "<tr><td>Beide dagen</td><td>$beide</td></tr>";
                echo "<tr><td>Alleen vrijdag</td><td>$vrijdag</td></tr>";
                echo "<tr><td>Alleen zaterdag</td><td>$zaterdag</td></tr>";
                echo "<tr><td>Les van de heer Weele</td><td>$les</td></tr>";
            } catch (\Exception $e) {
                echo $e->getMessage();
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
