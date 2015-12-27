<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
<div id="footer">
  <footer style="text-align: center;">
    <hr />
    Dit is een website van <a href="http://pr.nehalennia.nl/">SG Nehalennia</a>.
  </footer>
</div>
