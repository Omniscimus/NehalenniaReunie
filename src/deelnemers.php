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
          Hieronder ziet u de oud-leerlingen die zich al hebben ingeschreven voor de reünie.
        </p>
      </div>

      <div class="medium-12 columns field" style="padding: 0;">
        <table style="width: 100%; margin:0;">
          <tr>
            <th width="80%">Naam</th>
            <th>Examenjaar</th>
          </tr>

        </table>
      </div>

    </div>
  </div>

  <?php
  include 'resources/includes/footer.php';
  ?>
</body>
</html>
