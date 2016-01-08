<!DOCTYPE html>
<html>
  <head>
    <?php include 'includes.php'; ?>
    <title>Reünie Nehalennia</title>
  </head>

  <?php
  if (is_string($_POST["password"])) {
      if ($_POST["password"] == $config["results-password"]) {
          if (is_string($_POST["cms-config"])) {
              // Correct password, sent a new cms-config.php
              $mode = 3;
          } else {
              // Correct password, wants to edit cms-config
              $mode = 0;
          }
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
      include 'menu.php';
      ?>

      <div class="padding-top-1"></div>
      <div class="row">
        <div class="medium-10 medium-offset-1 columns">

          <h4>Resultaten</h4>

          <?php if ($mode === 0): ?>
            <form action="admin.php" method="post">
              <textarea name="cms-config" style="width: 100%; height: 400px;" ><?php
                $handle = fopen("cms-config.php", 'r');
                echo fread($handle, filesize('cms-config.php'));
                fclose($handle);
                ?></textarea>
                <input type="hidden" value="<?php echo $config["results-password"]; ?>" name="password" />
              <input class="button" type="submit" value="Opslaan" />
            </form>
          <?php elseif ($mode === 1 || $mode === 2): ?>
            <form action="admin.php" method="post">
              <?php if ($mode === 1): ?>
              <p>Verkeerd wachtwoord.</p>
              <?php endif; ?>
              Wachtwoord: <input type="password" name="password" />
              <input class="button" type="submit" value="Verder" />
            </form>
          <?php elseif ($mode === 3): ?>
            <?php
            $handle = fopen("cms-config.php", 'w');
            fwrite($handle, $_POST["cms-config"]);
            fclose($handle);
            ?>
            <p>De gegevens zijn geüpdate.</p>
          <?php endif; ?>
        </div>
      </div>

      <?php
      include 'footer.php';
      ?>
    </div>
  </body>
</html>
