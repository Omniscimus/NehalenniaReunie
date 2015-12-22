<html>
    <head>
        <title>Slideshow</title>
        <!-- deze pagina komt (denk ik) in een frame. Kan ook direct op hoofdpagina geplaatst worden. -->
        <script type="text/javascript">
        <!--
            // Globale variabele die bijhoudt welke afbeelding weergegeven wordt.
            var i = 0;
            
            // Bij het laden een Array met afbeeldingen laden;
            // PHP gaat verzorgen welke afbeeldingen.
            var slideArray = new Array();
            slideArray[0] = new Image();
//            slideArray[0].src = "./photos/foto1.PNG";
            slideArray[0].src = "http://cdn.spacetelescope.org/archives/images/wallpaper2/heic1509a.jpg";
            slideArray[1] = new Image();
            slideArray[1].src = "http://cdn.spacetelescope.org/archives/images/wallpaper2/heic1501a.jpg";
            slideArray[2] = new Image();
            slideArray[2].src = "http://cdn.spacetelescope.org/archives/images/wallpaper2/heic1107a.jpg";
            
            // Deze functie verzorgt het verwisselen van de afbeeldingen.
           function transform() 
           {
               i++;
               if (i > slideArray.length - 1)
               {
                   i = 0;
               }
               document.getElementById("displaypanel").style.backgroundImage = "url('" + slideArray[i].src + "')";
               
               //Nieuw afbeelding na 3 sec
               setTimeout("transform()",3000);
           }
        //-->
        </script>
    </head>
    <body onload="transform();" style="margin: 0;">
        <div id="displaypanel"  alt="foto" style="height: 300px; width: 100%; padding: 0; background-size: cover; background-position: 50% 100%;"/>
    </body>
</html>
