<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
<script src="resources/js/jquery.min.js"></script>
<script>
    $(window).bind("load", function () {
        var footer = $("#footer");
        var pos = footer.position();
        var height = $(window).height();
        height = height - pos.top;
        height = height - footer.height();
        if (height > 0) {
            footer.css({
                'margin-top': height + 'px'
            });
        }
    });
</script>
<script src="resources/js/foundation.min.js"></script>
<script>
  $(document).foundation();
</script>
<div id="footer">
  <div class="row" >
    <div class="small-12 medium-10 small-centered columns" style="padding: 0">
      <div class="small-12 columns field footer text-center">

        <?php
        $menu = $config['menu'];
        foreach ($menu as $item)
        {
          echo "
      <div class=\"small-6 medium-4 large-3 columns\">
        <a href=\"$item[1]\">$item[0]</a>
      </div>
          ";
        }
        ?>
        <div class="small-12 columns" style="margin-top: 0.7em;">
          Dit is een website van <a href="http://pr.nehalennia.nl/">SG
          Nehalennia</a>.
        </div>
      </div>

    </div>
  </div>
</div>
