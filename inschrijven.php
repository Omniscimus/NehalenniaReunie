<?php
function captcha_is_valid($g_recaptcha_response) {
    if (!isset($g_recaptcha_response)) {
        return false;
    }
    $config = include 'config.php';
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
$captcha_valid = captcha_is_valid($_POST["g-recaptcha-response"]);
?>

<!DOCTYPE html>
<html>
  <head>
    <?php include 'includes.php'; ?>
    <title>Inschrijven</title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
  </head>
  <body>

    <?php
    $pagina = "inschrijven";
    include 'menu.php';
    ?>
    <div class="padding-top-1"></div>

    <div class="row">
      <div class="medium-10 medium-offset-1 columns">
        <h4>Inschrijven</h4>

          <div class="row">
            <div class="medium-6 large-8 columns left">
              <p>
                Hier kunt u zich inschrijven voor de reünie. Dit houdt een
                aantal dingen in. blablablaaaa.

                Er is een aantal vereisten blablablaaa
                <ul>
                  <li>Je moet >4 jaar zijn</li>
                  <li>Je moet van koffie houden</li>
                  <li>Je moet ......</li>
                </ul>
              </p>
            </div>
            <div class="medium-6 large-4 columns right">

              <?php if ($input_valid < 2 || !$captcha_valid): ?>

                  <h5>Schrijf u in voor de reünie:</h5>
                  <?php if (!$captcha_valid && $input_valid !== 0): ?>
                      <p>
                        U bent niet geregistreerd vanwege een verkeerd
                        CAPTCHA-resultaat. Probeert u het alstublieft nog eens.
                        Vergeet niet op het vakje voor 'Ik ben geen robot' te
                        klikken.
                      </p>
                  <?php elseif ($input_valid !== 0): ?>
                      <p>Gelieve alle velden in te vullen.</p>
                  <?php endif; ?>
                  <form action="inschrijven.php" method="POST">
                    <fieldset class="fieldset">
                      <label>
                        Voornaam: <i style="color: #c40d4c">*</i>
                        <input type="text" name="voornaam" class="name-input" />
                      </label>
                      <label>
                        Achternaam: <i style="color: #c40d4c">*</i>
                        <input type="text" name="achternaam" class="name-input" />
                      </label>
                      <label>
                        Examenjaar:
                        <input type="number" name="examenjaar" class="name-input" value="1985" />
                      </label>
                      <div class="g-recaptcha" data-sitekey="<?php echo $config["captcha-sitekey"] ?>"></div>
                      <div class="padding-top-1"></div>
                      <input type="submit" value="Versturen" class="button"
                             style="margin-bottom: 0;"/>
                    </fieldset>
                  </form>

              <?php else: ?>

                  <?php
                  require_once 'MySQL_Manager.php';
                  $mysql = new MySQL_Manager();
                  try {
                      $mysql->connect();
                      $mysql->insertNewSubscription($_POST["voornaam"], $_POST["achternaam"], $_POST["examenjaar"]);
                      $mysql->closeConnection();
                  } catch (\Exception $e) {
                      echo $e->getMessage();
                  }
                  ?>
                  <p>Bedankt voor uw inschrijving!</p>
              <?php endif; ?>

          </div>
        </div>

      </div>
    </div>

    <?php
    include 'footer.php';
    ?>

  </body>
</html>
