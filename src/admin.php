<?php
function fancify($string) {
    return str_replace("\n", "<br>", str_replace("'", "\'", $string));
}
function defancify($string) {
    return str_replace("<br>", "\n", str_replace("\'", "'", $string));
}
?>

<!DOCTYPE html>
<html>
  <head>
    <?php include 'resources/includes/includes.php'; ?>
    <title>Reünie Nehalennia</title>

    <script>
      // Zorgt ervoor dat je bijv. bij de FAQ velden op de + en - kan drukken

      // Maak DOM 'remove' methods aan
      Element.prototype.remove = function() {
        this.parentElement.removeChild(this);
      }
      NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
        for (var i = 0; i > this.length; i--) {
          if (this[i] && this[i].parentElement) {
            this[i].parentElement.removeChild(this[i]);
          }
        }
      }

      // Haalt een element weg, aangeroepen als er op de - gedrukt wordt
      function minus(id) {
        document.getElementById(id).parentElement.remove();
      }

      function createMinusButton(id) {
        return '<input id="' + id + '" type="button" onclick="minus(this.id)" value="-" />';
      }

      // Houdt bij hoeveel FAQ-secties erbij zijn geplust (gaat niet omlaag als er op een - gedrukt wordt)
      var faqCount = 0;
      function createFAQElement(vraag, antwoord) {
        faqCount = faqCount + 1;
        var newElement = document.createElement('div');
        newElement.innerHTML =
                createMinusButton(faqCount)
                + '<input type="text" name="vragen[]" value="' + vraag + '" />'
                + '<textarea name="antwoorden[]" >' + antwoord + '</textarea>'
                + '<br />';
        return newElement;
      }
    </script>

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
      include 'resources/includes/menu.php';
      ?>

      <div class="padding-top-1"></div>
      <div class="row">
        <div class="medium-10 medium-offset-1 columns">

          <h4>Inhoud</h4>

          <?php if ($mode === 0): ?>

            <form action="admin.php" method="post">

              <h5>Tekst voorpagina</h5>
              <textarea name="homepage-tekst" style="height: 300px;"><?php echo defancify($cms_config["homepage-tekst"]); ?></textarea>

              <h5>Inschrijven</h5>
              <textarea name="inschrijven-tekst" style="height: 200px;"><?php echo defancify($cms_config["inschrijven-tekst"]); ?></textarea>

              <h5>Veelgestelde vragen</h5>
              <div id="faqdiv">
              <script>
                <?php
                foreach ($cms_config["veelgestelde-vragen"] as $vraag => $antwoord) {
                  $vraag = defancify($vraag);
                  $antwoord = defancify($antwoord);
                  echo "document.getElementById('faqdiv').appendChild(createFAQElement('$vraag', '$antwoord'));";
                }
                ?>
              </script>
              </div>
              <input type="button" onclick="document.getElementById('faqdiv').appendChild(createFAQElement('', ''))" value="+" />

              <h5>Agenda</h5>
              <?php
              foreach ($cms_config["agenda"] as $tijd => $agendapunt) {
                $tijd = defancify($tijd);
                $agendapunt = defancify($agendapunt);
                echo "<input type=\"text\" name=\"agendatijden[]\" value=\"$tijd\" />";
                echo "<textarea name=\"agendapunten[]\" >$agendapunt</textarea>";
                echo "<br />";
              }
              ?>

              <h5>E-mail</h5>
              <input type="email" value="<?php echo $cms_config["e-mail"]; ?>" name="e-mail" />

              <h5>Contactgegevens</h5>
              <?php
              foreach ($cms_config["contactgegevens"] as $gegeven) {
                $gegeven = defancify($gegeven);
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
              $vraag = fancify($vragen[$i]);
              $antwoord = fancify($antwoorden[$i]);
              $veelgestelde_vragen = $veelgestelde_vragen . "'$vraag' => '$antwoord',\n";
            }

            $agendatijden = $_POST["agendatijden"];
            $agendapunten = $_POST["agendapunten"];
            $agenda = "";
            for ($i=0; $i<count($agendatijden); $i++) {
              $agendatijd = fancify($agendatijden[$i]);
              $agendapunt = fancify($agendapunten[$i]);
              $agenda = $agenda . "'$agendatijd' => '$agendapunt',\n";
            }

            $contactgegevens = "";
            foreach ($_POST["contactgegevens"] as $gegeven) {
              $gegeven = fancify($gegeven);
              $contactgegevens = $contactgegevens . "'$gegeven',";
            }

            $template = file_get_contents("config/cms-config-template.txt");
            $template = str_replace("_homepage-tekst_", fancify($_POST["homepage-tekst"]), $template);
            $template = str_replace("_inschrijven-tekst_", fancify($_POST["inschrijven-tekst"]), $template);
            $template = str_replace("_facebook-link_", $_POST["facebook-link"], $template);
            $template = str_replace("_veelgestelde-vragen_", $veelgestelde_vragen, $template);
            $template = str_replace("_agenda_", $agenda, $template);
            $template = str_replace("_e-mail_", $_POST["e-mail"], $template);
            $template = str_replace("_contactgegevens_", $contactgegevens, $template);

            $handle = fopen("config/cms-config.php", 'w');
            fwrite($handle, $template);
            fclose($handle);
            ?>
            <p>De gegevens zijn geüpdate.</p>
          <?php endif; ?>
        </div>
      </div>

      <?php
      include 'resources/includes/footer.php';
      ?>
    </div>
  </body>
</html>
