<?php
include_once 'php/helpers.php';
include_once 'php/vr-and-eggs.php';
standardHeader(true);?>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Map</title>
    <meta name="viewport" content="user-scalable=no, width=1280">
    <link rel="stylesheet" type="text/css" media="screen" href="css/global2.css">
    <link rel="stylesheet" href="css/vr-and-eggs.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/dive-locations.css">    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha256-pS96pU17yq+gVu4KBQJi38VpSuKN7otMrDQprzf/DWY=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
   <script src="js/dive-locations.js"></script>
   <script type="text/javascript"> 
   <?php enableArticles(); ?>
   <?php enableEasterEggs(); ?>
    </script>
</head>
<body>
  <div class="fixed-container blue-folder opened-folder">

    <!-- FOLDER-CONTENTS -->
    <div class="folder-label">Dive Prep</div>

    <div><img class="map" src="images/map.png" alt="Dive Map"></div>
    <div class="text-box"><p>Dr. BIG has set up his dirty factories in three locations around the globe. Pick the location you would like to investigate.</p></div>
    <div class="pin1"><img class="hover" src="images/icons/vr-marker.png" alt="Vr icon"><p class="dive-location">Eastern Pacific</p><p class="dive-site">Las Perlas and Culebra</p></p></div>
    <div class="pin2"><img class="hover" src="images/icons/vr-marker.png" alt="Vr icon"><p class="dive-location">Eastern Atlantic</p><p class="dive-site">Senegal and Cape Verde</p></div>
    <div class="pin3"><img class="hover" src="images/icons/vr-marker.png" alt="Vr icon"><p class="dive-location">Indo-Pacific</p><p class="dive-site">Solomon Islands and Papa New Guinea</p></div> 
    <?php writeUIButtons();?>
    

    <?php
    $content = <<<EOD
    Your vessel is ready, scientist. <br/> It’s time to set sail. Let's head over to 
EOD;
   writeEggAndVRInstructions("VIEW HUNT","hunt",$content);?>
  <?php writeArticlesIFrameDiv(); ?>
  <?php addVideoOverlay("videos/two_cone_snails_eat_fish.mp4");?>

        <!-- ARROW TO PREVIOUS -->
    <a href="dive-equipment.php" class="previous-page-arrow">
      <img src="images/arrow.png" alt="Previous Arrow">
    </a>

    

    <!-- ARROW TO CONTINUE -->
    <a href="#" class="next-button" onclick="nextArrowClicked();" style="z-index: 301; display: none;">
        <img src="images/arrow.png" alt="Next Arrow">
    </a>
    

  <!-- FUNCTIONS FOR ARROWS AND BUTTONS -->
  </div>
</body>
<script type="text/javascript" src="js/scale.js"></script>
<script src="js/videoplayer.js"></script>
</html>
