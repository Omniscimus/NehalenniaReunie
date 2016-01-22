<html>
    <head>
        <title>Slideshow</title>
        <link rel="stylesheet" type="text/css" href="animation.css"/>
        <!--optimised for: Firefox/Chrome-->
        <!-- deze pagina komt (denk ik) in een frame. Kan ook direct op hoofdpagina geplaatst worden. -->
        <script type="text/javascript">
            // Globale variabele die bijhoudt welke afbeelding weergegeven wordt.
            var i = 0;
            // Deze variabele geeft de tijd (in ms) aan die elke foto wordt weergegeven
            var displayTime = 3000;
            // Panels variabelen, zie init();
            var div1;
            var div2;

            // Bij het laden een Array met afbeeldingen laden;
            // PHP gaat verzorgen welke afbeeldingen.
            var slideArray = [];
            <?php
                $urls = scandir("../resources/slideshow-fotos");
                // Haal . en .. eruit
                $urls = array_slice($urls, 2);
                shuffle($urls);

                for($i=0; $i<6; $i++) {
                  echo "slideArray[".$i."] = new Image();"; 
                  echo "slideArray[".$i."].src = '../resources/slideshow-fotos/".$urls[$i]."';\n";
                }
            ?>

            function init() {
                div1 = document.getElementById("displaypanel1");
                div2 = document.getElementById("displaypanel2");
                transform1();
            }

            //De functie transform1 en transform2() wisselen elkaar af. Er zijn twee divs, waarvan de voorste afwisselend in/uit fade.
            function transform1()
            {
                increment();
                div2.style.backgroundImage = slideArray[i].src;//"url('" + slideArray[i] + "')";
                div2.classList.remove("fadeout");
                div2.classList.add("fadein");
                div2.style.opacity = 1;

                //Nieuw afbeelding na 3 sec
                setTimeout("transform2();",displayTime);
            }
            function transform2()
            {
                increment();
                div1.style.backgroundImage = slideArray[i].src;//"url('" + slideArray[i] + "')";
                div2.classList.remove("fadein");
                div2.classList.add("fadeout");
                div2.style.opacity = 0;

                //Nieuw afbeelding na 3 sec
                setTimeout("transform1();",displayTime);
            }

            function increment() {
                i++;
                if(i > slideArray.length - 1)
                {
                    i = 0;
                }
            }
        </script>
    </head>
    <body onload="init();">
            <div class="panel" id="displaypanel1" alt="foto"/>
            <div class="panel" id="displaypanel2" alt="foto"/>
    </body>
</html>
