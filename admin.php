<!DOCTYPE html>
<html>
  <head>
    <?php include 'includes.php'; ?>
    <title>Reünie Nehalennia</title>
  </head>

  <?php
  if (is_string($_POST["password"])) {
      if ($_POST["password"] == $config["results-password"]) {
          if (is_string($_POST["facebook-link"])) {
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

          <h4>Inhoud</h4>

          <?php if ($mode === 0): ?>

            <form action="admin.php" method="post">

              <h5>Tekst voorpagina</h5>
              <textarea name="homepage-tekst" style="height: 300px;"><?php echo $cms_config["homepage-tekst"]; ?></textarea>

              <h5>Veelgestelde vragen</h5>
              <?php
              foreach ($cms_config["veelgestelde-vragen"] as $vraag => $antwoord) {
                echo "<input type=\"text\" name=\"vragen[]\" value=\"$vraag\" />";
                echo "<textarea name=\"antwoorden[]\" >$antwoord</textarea>";
                echo "<br />";
              }
              ?>

              <h5>E-mail</h5>
              <input type="email" value="<?php echo $cms_config["e-mail"]; ?>" name="e-mail" />

              <h5>Contactgegevens</h5>
              <?php
              foreach ($cms_config["contactgegevens"] as $gegeven) {
                echo "<input type=\"text\" name=\"contactgegevens[]\" value=\"$gegeven\" />";
              }
              ?>

              <h5>Facebook link</h5>
              <input type="text" value="<?php echo $cms_config["facebook-link"]; ?>" name="facebook-link" />

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

            $vragen = $_POST["vragen"];
            $antwoorden = $_POST["antwoorden"];
            $veelgestelde_vragen = "";
            for ($i=0; $i<count($vragen); $i++) {
              $vraag = htmlspecialchars($vragen[$i]);
              $antwoord = htmlspecialchars($antwoorden[$i]);
              $veelgestelde_vragen = $veelgestelde_vragen . "'$vraag' => '$antwoord',\n";
            }

            $contactgegevens = "";
            foreach ($_POST["contactgegevens"] as $gegeven) {
              $gegeven = htmlspecialchars($gegeven);
              $contactgegevens = $contactgegevens . "'$gegeven',";
            }

            $template = file_get_contents("cms-config-template.txt");
            $template = str_replace("_homepage-tekst_", htmlspecialchars($_POST["homepage-tekst"]), $template);
            $template = str_replace("_facebook-link_", $_POST["facebook-link"], $template);
            $template = str_replace("_veelgestelde-vragen_", $veelgestelde_vragen, $template);
            $template = str_replace("_e-mail_", $_POST["e-mail"], $template);
            $template = str_replace("_contactgegevens_", $contactgegevens, $template);

            $handle = fopen("cms-config.php", 'w');
            fwrite($handle, $template);
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
