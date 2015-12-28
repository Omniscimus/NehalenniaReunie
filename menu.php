
<div class="row">
  <div id="menubar" class="top-bar">
    <div class="medium-10 medium-offset-1">
      <div class="top-bar-left">
        <img src="http://pr.nehalennia.nl/images/logoNehalennia.png" style="margin-left: 2em; height: 2.5em; width: auto;">
      </div>
      <div class="top-bar-right">
        <ul class="menu">
          <?php
            $menu = array(
              array('Index', 'index.php'),
              array('Inschrijven', 'inschrijven.php'),
              array('Veelgestelde vragen', 'faq.php'),
              array('Contact', 'contact.php')
            );
            foreach ($menu as $item)
            {
              $selected = strtolower($item[0])===strtolower($pagina);
              echo "<li><a href=\"$item[1]\"". (($selected)?
                " class=\"selected\"" :
                "")
                .">$item[0]</a></li>";
            }
          ?>
        </ul>
        <!--    --><?php
        //    echo "<p>Dit is het menu van de pagina '$pagina'.</p>"
        //    ?>
      </div>
    </div>
  </div>
</div>
