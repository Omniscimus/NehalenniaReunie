<?php
function captcha_is_valid($g_recaptcha_response) {
    if (!isset($g_recaptcha_response)) {
        return false;
    }
    $config = include 'config/config.php';
    $data = array('secret' => $config["captcha-secretkey"], 'response' => $g_recaptcha_response);
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ),
    );
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $decoded_response = json_decode($response, true);
    return $decoded_response["success"];
}
 
$input_valid = 0;
if (is_string($_POST["voornaam"])) {
  $input_valid++;
}
if (is_string($_POST["achternaam"])) {
  $input_valid++;
}
if (is_string($_POST["email"])) {
  $input_valid++;
}
if (isset($_POST['dag']))
{
  $input_valid++;
}
$captcha_valid = captcha_is_valid($_POST["g-recaptcha-response"]);
?>
 
<!DOCTYPE html>
<html>
  <head>
    <?php include 'resources/includes/includes.php'; ?>
    <title>Inschrijven</title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript">
    <!--
        var errors = 0;
        var firsttime = true;
        function validate()
        {
            errors = 0;
            clear_all();
 
            validate_field("voornaam");
            validate_field("achternaam");
            if (!validate_field("email"))
            {
                var email = document.getElementById("email").value;
                if (!email.match(/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\b/i))
                {
                    document.getElementById("err_email").innerHTML = "Dit is geen geldig e-mail adres.";
                    errors += 1;
                }
                }
 
            if (!document.getElementById("vrijdag").checked && !document.getElementById("zaterdag").checked)
            {
                document.getElementById("err_dag").innerHTML = "Kies minstens één dag.";
                errors += 1;
            }
            var year = document.getElementById("examenjaar").value;
            if (year < 1900 || year > 2016)
            {
                document.getElementById("err_jaar").innerHTML = "Kies a.u.b. het goede examenjaar.";
                errors += 1;
            }
 
            if (errors == 0)
            {
                document.forms[0].submit();
            }
            else if (errors == 1)
            {
                document.getElementById("err_submit").innerHTML = "Er is " + errors + " veld niet correct ingevuld.";
            }
            else
            {
                document.getElementById("err_submit").innerHTML = "Er zijn " + errors + " velden niet correct ingevuld.";
            }
        }
        function validate_field(fieldname)
        {
            if (document.getElementById(fieldname).value == "")
            {
                document.getElementById("err_" + fieldname).innerHTML = "Dit veld is verplicht";
                errors += 1;
                return true;
            }
            else
            {
                return false;
            }
        }
        function clear_all()
        {
            clear("voornaam");
            clear("achternaam");
            clear("email");
            clear("dag");
        }
        function clear(fieldname)
        {
            document.getElementById("err_" + fieldname).innerHTML = "";
        }
        function updateScreen()
        {
            document.getElementById("les").disabled = !document.getElementById("zaterdag").checked;
            if (firsttime || !document.getElementById("zaterdag").checked)
            {
                document.getElementById("les").checked = document.getElementById("zaterdag").checked;
                firsttime = false;
            }
            }
    //-->
    </script>
  </head>
  <body>
 
    <?php
    $pagina = "inschrijven";
    include 'resources/includes/menu.php';
    ?>
    <div class="padding-top-1"></div>
 
    <div class="row">
      <div class="medium-10 medium-offset-1 columns">
 
          <div class="small-12 columns field">
            <h4>Inschrijven</h4>
            <p><?php echo $cms_config["inschrijven-tekst"]; ?></p>
          </div>
 
 
        <div class="medium-12 columns field">
            <?php if ($input_valid < 4 || !$captcha_valid): ?>
              <h5>Schrijf u in
          voor de reünie:</h5>
            <?php if (!$captcha_valid && $input_valid !== 0): ?>
              <div class="warning">
                U bent niet geregistreerd vanwege een verkeerd
                CAPTCHA-resultaat. Probeert u het alstublieft nog eens.
                Vergeet niet op het vakje voor 'Ik ben geen robot' te
                klikken.
              </div>
            <?php elseif ($input_valid !== 0): ?>
              <div class="warning">Gelieve alle velden in te vullen.</div>
            <?php endif; ?>
              </div>
            <div data-equalizer>
            <div class="medium-6 columns field" data-equalizer-watch>
              <form action="inschrijven.php" method="POST">
                <legend>Informatie over uzelf</legend>
 
                <label>
                  Voornaam: <i style="color: #c40d4c">*</i>
                  <input type="text" name="voornaam" id="voornaam" class="name-input" />
                  <p class="error" id="err_voornaam"></p>
                </label>
 
                <label>
                  Achternaam: <i style="color: #c40d4c">*</i>
                  <input type="text" name="achternaam" id="achternaam" class="name-input" />
                  <p class="error" id="err_achternaam"></p>
                </label>
 
                <label>
                  E-mailadres: <i style="color: #c40d4c">*</i>
                  <input type="text" name="email" id="email" class="name-input" />
                  <p class="error" id="err_email"></p>
                </label>

                <label>
                  Examenjaar:
                  <input type="number" name="examenjaar" id="examenjaar" class="name-input" value="1985" />
                  <p class="error" id="err_examenjaar"></p>
                </label>
 
          </div>
          <div class="medium-6 columns field" data-equalizer-watch>
 
                <label>
                  Huidige beroep:
                  <input type="text" name="beroep" class="name-input" />
                </label>
 
                <legend>Wanneer bezoekt u de reunie:<i style="color: #c40d4c">*</i></legend>
                <label>
                  Vrijdag 18 maart 2016
                  <input type="checkbox" name="vrijdag" id="vrijdag"><br />
                </label>
 
                <label>
                  Zaterdag 19 maart 2016
                  <input type="checkbox" name="zaterdag" id="zaterdag" onclick="updateScreen();"><br />
                </label>

                <label style="padding-left: 1em; margin-top: -0.8em;">
                  <input type="checkbox" name="les" id="les" disabled>Ja, ik bezoek ook graag de les van dhr. J.M. van Weele in het
                  oude gymnasium
                </label>
 
                <p class="error" id="err_dag"></p>
 
                <div class="g-recaptcha" style="width: 100%; height: 5em;" data-sitekey="<?php echo $config["captcha-sitekey"] ?>"></div>
 
                <div class="padding-top-1"></div>
 
                <input type="button" class="button green" value="Versturen" class="button"
                       style="margin-bottom: 0;" onclick="validate();"/>
                       <p class="error" id="err_submit"></p>
                </div>
              </form>
            </div>
 
        <?php else: ?>
 
              <?php
                require_once 'resources/includes/MySQL_Manager.php';
                $mysql = new MySQL_Manager();
 
                try {
                    $mysql->connect();
                    $mysql->insertNewSubscription($_POST["voornaam"],
                      $_POST["achternaam"], $_POST['email'], $_POST["examenjaar"],
                      $_POST['beroep'], $_POST['vrijdag'],
                      $_POST['zaterdag'], $_POST['les']);
                    $mysql->closeConnection();
                } catch (\Exception $e) {
                    echo $e->getMessage();
                }
 
                // Sending bevestigingsmail
                $to = $_POST["email"];
                $subject = "Bevestiging inschrijving Nehalenniareünie";
                $message = "Beste ".$_POST["voornaam"]." ".$_POST["achternaam"].",<br><br>Bedankt voor uw inschrijving. Uw inschrijving is pas definitief als u €15,- euro heeft overgemaakt:<br>Rekeningnummer: NL25 ABNA **** **** **<br>t.n.v. Stichting OVO Walcheren<br>o.v.v. 650 jaar Gymnasium + naam.<br><br>Controleert u alstublieft of onderstaande gegevens kloppen:<br><br>";
                $message .= "U komt op ";
 
                if ($_POST['vrijdag'])
                {
                    $message .= "vrijdag";
                }
                if ($_POST['vrijdag'] && $_POST['zaterdag'])
                {
                    $message .= " en ";
                }
                if ($_POST['zaterdag'])
                {
                    $message .= "zaterdag";
                }
                if ($_POST['les'])
                {
                    $message .= ".<br>U bezoekt zaterdag ook de de les van dhr. J.M. van Weele";
                }
                $message .= ".<br>U heeft examen gedaan in "
                  .$_POST["examenjaar"].".";
                $message .= "<br><br>Vriendelijke groeten,<br>SSG Nehalennia<br><br><i>Dit is een automatisch gegenereerd bericht waarop u niet kunt reageren. Klopt er iets niet of heeft u vragen, aarzel niet om contact op te nemen via <a href=\"mailto:info@nehalenniareunie.nl\">info@nehalenniareunie.nl</a>.</i>";
 
                require 'resources/mail/PHPMailerAutoload.php';
                $config = include 'config/config.php';
 
                $mail = new PHPMailer;
 
                $mail->isSMTP();
                $mail->Host = $config['mail-host'];
                $mail->SMTPAuth = true;
                $mail->Username = $config['mail-user'];
                $mail->Password = $config['mail-password'];
                $mail->SMTPSecure = $config['mail-smtp-secure'];
                $mail->Port = $config['mail-smtp-port'];
 
                $mail->setFrom($config['mail-user'], $config['mail-name']);
                $mail->addAddress($to, ($_POST["voornaam"]." "
                  .$_POST["achternaam"]));
                $mail->addReplyTo($config['mail-reply-to'], $config['mail-reply-to-name']);
 
                $mail->isHTML(true);
                $mail->CharSet="UTF-8";
 
                $mail->Subject = $subject;
                $mail->Body = $message;
                $mail->AltBody = $mail->Body;
 
                if (!$mail->send())
                {
                  echo 'Mail is niet verzonden, probeer het nog een keer';
                }
              ?>
                <p>Bedankt voor uw inschrijving!</p>
            <?php endif; ?>
                </div>
 
          </div>
 
      </div>
    </div>
 
    <?php
    include 'resources/includes/footer.php';
    ?>
 
  </body>
</html>
