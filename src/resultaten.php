<!DOCTYPE html>
<html>
  <head>
    <?php include 'resources/includes/includes.php'; ?>
    <title>Reünie Nehalennia</title>
  </head>

  <?php
  if (is_string($_POST["password"])) {
      if ($_POST["password"] == $config["results-password"]) {
          $mode = 0; // Correct password
      } else {
          $mode = 1; // Wrong password
      }
  } else {
      $mode = 2; // No password yet
  }
  ?>

  <body>
    <div>
      <?php
      $pagina = "results";
      include 'resources/includes/menu.php';
      ?>

      <div class="padding-top-1"></div>
      <div class="row">
        <div class="medium-4 medium-offset-1 columns">

          <h4>Resultaten</h4>

          <?php if ($mode === 0): ?>
          <table>
            <tr>
              <th>Voornaam</th>
              <th>Achternaam</th>
              <th>Examenjaar</th>
            </tr>
            <?php
            require_once 'resources/includes/MySQL_Manager.php';
            $mysql = new MySQL_Manager();
            try {
                $mysql->connect();
                $results = $mysql->getResults();
                $mysql->closeConnection();

                if ($results->num_rows > 0) {
                    while ($row = $results->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["voornaam"] . "</td><td>"
                        . $row["achternaam"] . "</td><td>"
                        . $row["examenjaar"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "Er zijn nog geen inschrijvingen.";
                }
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
            ?>
          </table>
          <?php else: ?>
          <form action="results.php" method="post">
              <?php if ($mode === 1): ?>
              <p>Verkeerd wachtwoord.</p>
              <?php endif; ?>
              Wachtwoord: <input type="password" name="password" />
              <input class="button" type="submit" value="Verder" />
          </form>
          <?php endif; ?>
        </div>
      </div>

      <?php
      include 'resources/includes/footer.php';
      ?>
    </div>
  </body>
</html>
