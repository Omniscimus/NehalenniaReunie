
<div id="menu-bar" class="top-bar">
  <div class="row">
    <div class="medium-10 medium-offset-1">
      <div class="top-bar-left hide-for-small-only">
        <img src="http://pr.nehalennia.nl/images/logoNehalennia.png" style="margin-left: 2em; height: 2.5em; width: auto;">
      </div>
      <div class="top-bar-right">
        <div class="scroller">
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
          </div>
        </ul>
        <!--    --><?php
        //    echo "<p>Dit is het menu van de pagina '$pagina'.</p>"
        //    ?>
      </div>
    </div>
  </div>
</div>
