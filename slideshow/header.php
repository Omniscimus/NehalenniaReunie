<html>
    <head>
        <title>Slideshow</title>
        <link rel="stylesheet" type="text/css" href="animation.css"/>
        <!--optimised for: Firefox/Chrome-->
        <!-- deze pagina komt (denk ik) in een frame. Kan ook direct op hoofdpagina geplaatst worden. -->
        <script type="text/javascript">
        <!--
            // Globale variabele die bijhoudt welke afbeelding weergegeven wordt.
            var i = 0;
            
            // Bij het laden een Array met afbeeldingen laden;
            // PHP gaat verzorgen welke afbeeldingen.
            var slideArray = new Array();
            <?php
                $urls  = Array("http://cdn.spacetelescope.org/archives/images/wallpaper2/heic1506a.jpg","http://cdn.spacetelescope.org/archives/images/wallpaper2/heic1501a.jpg","http://cdn.spacetelescope.org/archives/images/wallpaper2/heic1509a.jpg","http://cdn.spacetelescope.org/archives/images/wallpaper2/heic1108a.jpg","http://cdn.spacetelescope.org/archives/images/wallpaper2/heic1500a.jpg","http://cdn.spacetelescope.org/archives/images/wallpaper2/heic1510a.jpg","http://cdn.spacetelescope.org/archives/images/wallpaper2/heic1109a.jpg");
                $urlslength = count($urls) - 1;
                // deze variabele wordt een lijst van alle in een map beschikbare
                // (foto) bestanden. Hiervan worden er willekeurig 4 (of 6 of 8 of etc...) gekozen.
                
                $stored = 0;
                while ($stored < 4)
                {
                    $rnd = rand(0, $urlslength);
                    echo "slideArray[$stored] = new Image();\n";
                    echo "slideArray[$stored].src = '".$urls[$rnd]."';\n";
                    
                    unset($urls[$rnd]);
                    $urls = array_values($urls);
                    $urlslength = count($urls) - 1;
                    
                    $stored++;
                }
            ?>
            
            
            //De functie transform1 en transform2() wisselen elkaar af. Er zijn twee divs, waarvan de voorste afwisselend in/uit fade.
            function transform1() 
            {
                var div1 = document.getElementById("displaypanel1");
                var div2 = document.getElementById("displaypanel2");
                i += 2;
                if (i > slideArray.length - 2)
                {
                    i = 0;
                }
                div2.style.backgroundImage = "url('" + slideArray[i + 1].src + "')";
                div2.classList.remove("fadeout");
                div2.classList.add("fadein");
                div2.style.opacity = 1;
               
                //Nieuw afbeelding na 3 sec
                setTimeout("transform2();",3000);
            }
            function transform2()
            {
                var div2 = document.getElementById("displaypanel2");
                var div1 = document.getElementById("displaypanel1");
                div1.style.backgroundImage = "url('" + slideArray[i].src + "')";
                div2.classList.remove("fadein");
                div2.classList.add("fadeout");
                div2.style.opacity = 0;
                
                //Nieuw afbeelding na 3 sec
                setTimeout("transform1();",3000);
            }
        //-->
        </script>
    </head>
    <body onload="transform1();">
            <div class="panel" id="displaypanel1" alt="foto"/>
            <div class="panel" id="displaypanel2" alt="foto"/>
    </body>
</html>
