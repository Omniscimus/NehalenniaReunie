
<div class="row">
  <div class="medium-10 medium-offset-1">
    <div id="menu-bar" class="top-bar">
      <div class="top-bar-left hide-for-small-only">
        <img class="logo <?php if ($pagina==='index') echo "index"; ?>" src="resources/icon/logoNehalennia.png">
      </div>
      <div class="top-bar-right">
        <ul class="menu">
        <?php
          $menu = $config['menu'];
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
      </div>
    </div>
  </div>
</div>
