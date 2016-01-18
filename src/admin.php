<?php
/**
 * Methods die ervoor zorgen dat informatie goed verwerkt worden tussen
 * admin.php en cms-config.php. Een enter moet bijvoorbeeld gezien worden als
 * <br> in HTML.
 */
function fancify($string) {
    return str_replace("\n", "<br>", str_replace("'", "\'", $string));
}
function defancify($string) {
    return str_replace("<br>", "\n", htmlspecialchars($string));
}
?>

<!DOCTYPE html>
<html>
  <head>
    <?php include 'resources/includes/includes.php'; ?>
    <title>Reünie Nehalennia</title>

    <script>
      // Dit scriptje zorgt ervoor dat je bijv. bij de FAQ velden op de + en - kan drukken.

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

      // Geeft de HTML-code voor een - knop
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
                + '<textarea name="antwoorden[]" >' + antwoord + '</textarea>';
        return newElement;
      }

      // Houdt bij hoeveel agenda-secties erbij zijn geplust (gaat niet omlaag als er op een - gedrukt wordt)
      var agendaCount = 0;
      function createAgendaElement(time, activity) {
        agendaCount = agendaCount + 1;
        var newElement = document.createElement('div');
        newElement.innerHTML =
                createMinusButton(agendaCount)
                + '<input type="text" name="agendatijden[]" value="' + time + '" />'
                + '<textarea name="agendapunten[]" >' + activity + '</textarea>';
        return newElement;
      }

      // Houdt bij hoeveel agenda-secties erbij zijn geplust (gaat niet omlaag als er op een - gedrukt wordt)
      var gegevensCount = 0;
      function createGegevensElement(gegeven) {
        gegevensCount = gegevensCount + 1;
        var newElement = document.createElement('div');
        newElement.innerHTML =
                createMinusButton(gegevensCount)
                + '<input type="text" name="contactgegevens[]" value="' + gegeven + '" />';
        return newElement;
      }
    </script>

  </head>

  <?php
  // Validatie van wachtwoord en controle of er content is opgestuurd.
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
            <!-- Heeft net correct wachtwoord ingevuld. Toon het formulier voor het bewerken van cms_config.php. -->

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
              De datum wordt automatisch bepaald. Hiervoor is het nodig dat de items op volgorde worden ingevuld en dat het eerste item op zaterdag niet later begint dan het laatste op vrijdag.
              <div id="agendadiv">
              <script>
                <?php
                foreach ($cms_config["agenda"] as $item) {
                  $tijd = defancify($item[0]);
                  $agendapunt = defancify($item[1]);
                  echo "document.getElementById('agendadiv').appendChild(createAgendaElement('$tijd', '$agendapunt'));";
                }
                ?>
              </script>
              </div>
              <input type="button" onclick="document.getElementById('agendadiv').appendChild(createAgendaElement('', ''))" value="+" />

              <h5>E-mail</h5>
              <input type="email" value="<?php echo $cms_config["e-mail"]; ?>" name="e-mail" />

              <h5>Contactgegevens</h5>
              <div id="contactdiv">
              <script>
                <?php
                foreach ($cms_config["contactgegevens"] as $gegeven) {
                  $gegeven = defancify($gegeven);
                  echo "document.getElementById('contactdiv').appendChild(createGegevensElement('$gegeven'));";
                }
              ?>
              </script>
              </div>
              <input type="button" onclick="document.getElementById('contactdiv').appendChild(createGegevensElement(''))" value="+" />

              <h6>Openbaar vervoer</h6>
              <textarea name="ovreis" style="height: 200px;"><?php echo defancify($cms_config["ovreis"]); ?></textarea>

              <h6>Auto</h6>
              <textarea name="autoreis" style="height: 200px;"><?php echo defancify($cms_config["autoreis"]); ?></textarea>

              <h5>Facebook link</h5>
              <input type="text" value="<?php echo $cms_config["facebook-link"]; ?>" name="facebook-link" />

              <input type="hidden" value="<?php echo $config["results-password"]; ?>" name="password" />
              <input class="button" type="submit" value="Opslaan" />

            </form>

          <?php elseif ($mode === 1 || $mode === 2): ?>
            <!-- Nog geen wachtwoord ingevuld, of verkeerd wachtwoord ingevuld. -->
            <form action="admin.php" method="post">
              <?php if ($mode === 1): ?>
              <p>Verkeerd wachtwoord.</p>
              <?php endif; ?>
              Wachtwoord: <input type="password" name="password" />
              <input class="button" type="submit" value="Verder" />
            </form>
          <?php elseif ($mode === 3): ?>
            <!-- Heeft zojuist het formulier opgestuurd; verwerking. -->
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
              $agenda .= "array('$agendatijd','$agendapunt'),\n";
            }

            $contactgegevens = "";
            foreach ($_POST["contactgegevens"] as $gegeven) {
              $gegeven = fancify($gegeven);
              $contactgegevens = $contactgegevens . "'$gegeven',";
            }

            // Beschouw de cms-config-template als een bestand en open het
            $template = file_get_contents("config/cms-config-template.txt");
            // Vervang alle template stukjes door de zojuist verwerkte gegevens
            $template = str_replace("_homepage-tekst_", fancify($_POST["homepage-tekst"]), $template);
            $template = str_replace("_inschrijven-tekst_", fancify($_POST["inschrijven-tekst"]), $template);
            $template = str_replace("_facebook-link_", $_POST["facebook-link"], $template);
            $template = str_replace("_veelgestelde-vragen_", $veelgestelde_vragen, $template);
            $template = str_replace("_agenda_", $agenda, $template);
            $template = str_replace("_e-mail_", $_POST["e-mail"], $template);
            $template = str_replace("_contactgegevens_", $contactgegevens, $template);
            $template = str_replace("_ovreis_", fancify($_POST["ovreis"]), $template);
            $template = str_replace("_autoreis_", fancify($_POST["autoreis"]), $template);

            // Schrijf de gemaakte config naar cms-config.php; overwrite existing.
            $handle = fopen("config/cms-config.php", 'w');
            fwrite($handle, $template);
            fclose($handle);
            ?>
            <p>De gegevens zijn geüpdated.</p>
          <?php endif; ?>
        </div>
      </div>

      <?php
      include 'resources/includes/footer.php';
      ?>
    </div>
  </body>
</html>
