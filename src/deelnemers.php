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
          Hieronder ziet u de docenten en leerlingen die zich al hebben ingeschreven voor de reünie.
        </p>
      </div>

      <div class="medium-12 columns field" style="padding: 0;">
        <h5 style="text-align: center;">Docenten</h5>
        <table style="width: 100%; margin:0;">
          <tr>
            <th>Naam</th>
            <th>Docent</th>
            <th>Oud-docent</th>
          </tr>
          <?php
            foreach ($cms_config['docenten'] as $docent => $is_oud_docent) {
                echo "<tr><td>$docent</td><td style=\"text-align: center; width: 100px;\">";
                if ($is_oud_docent) {
                  echo '</td><td style="text-align: center; width: 100px;">✓</td></tr>';
                } else {
                  echo '✓</td><td></td></tr>';
                }
            }
          ?>
        </table>
      </div>

      <div class="medium-12 columns field" style="padding: 0;">
        <h5 style="text-align: center;">Leerlingen</h5>
        <table style="width: 100%; margin:0;">
          <tr>
            <th width="80%">Naam</th>
            <th>Examenjaar</th>
          </tr>

          <?php
            require_once 'resources/includes/MySQL_Manager.php';
            $mysql = new MySQL_Manager();
            try {
                $mysql->connect();
                $results = $mysql->getSubs();
                $mysql->closeConnection();

                while ( $row = mysql_fetch_row($results) ) {
		    echo "<tr>";
                    echo "<td>$row[0] $row[1]</td>";
                    echo "<td style=\"text-align: center\">$row[2]</td>";
                    echo "</tr>";
                }
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
