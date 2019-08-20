<?php
include_once 'php/helpers.php';
standardHeader(true);?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dive Equipment</title>
    <meta name="viewport" content="user-scalable=no, width=1280">
    <link rel="stylesheet" type="text/css" media="screen" href="css/global2.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/dive-equipment.css">    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha256-pS96pU17yq+gVu4KBQJi38VpSuKN7otMrDQprzf/DWY=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="js/dive-equipment.js"></script>
    <script type="text/javascript">
        <?php enableVocab(); ?>
        <?php enableClickToContinue();?>

        $(function() { 
        <?php enablePopovers(); ?>
        });

        $('[data-toggle="popover"]').popover({
            trigger: 'hover',
            delay: {"show": 1000, "hide": 100},
            html: true,
        });
    </script>

</head>
<body>

  <div class="fixed-container blue-folder opened-folder">

    <!-- FOLDER-CONTENTS -->
    <!-- ****************** -->
    <a href="abiotic-biotic.php" class="previous-page-arrow">
      
    <img src="images/arrow.png" alt="Previous Arrow">
    </a>
    <?php writeUIButtons();?>
    <?php writeVocabDiv();?>

    <div class="text-box"> <p>Now that you know the abiotic data you are collecting, hover over each tool to see what it does and drag it to the correct post it note on the right.</p> </div>
    <div class="container"></div>
    <div class="question"><p>What tool do you use to measure the level of salinity?</p></div>
    <div class="question2"><p> What tool do you use to collect the pH?</p></div>
    <div class="question3"><p> What tool do you use to measure the temperature?</p></div>
    <div class="question4"><p> What tool do you use to measure how clear or turbid the water is?</p></div>
    <div class="question5"><p> What tool do you use to measure how much oxygen is in the water?</p></div>
    <div>
          <img class="refractometer sticker"            src="images/stickers/stickerrefractometer.png" data-toggle="popover" data-content="This refractometer accurately measures how much salt is dissolved in the water." alt="Refractometer">
          <img class="ph-meter sticker"            src="images/stickers/stickerphmeter.png" data-toggle="popover" data-content="This is a pH (potential of Hydrogen) probe that measures the acidity or alkalinity of a liquid." alt="PH Meter">
          <img class="temperature-probe sticker"             src="images/stickers/stickertemperatureprobe.png" data-toggle="popover" data-content="This temperature probe is used for measuring soil or water temperature." alt="Temperature probe">
          <img class="turbidity-tube sticker"      src="images/stickers/stickerturbiditytube.png" data-toggle="popover" data-content="This turbidity tube with sechhi disk measures water transparency. Turbidity is measured by depth at which the secchi disk is no longer visible." alt="turbidity tube">
          <img class="oxygen-probe sticker"        src="images/stickers/stickeroxygenprobe.png" data-toggle="popover" data-content="A dissolved oxygen probe measures the concentration of oxygen in aquatic environments." alt="Oxygen probe">
    </div>

        <div class="next-page-box next-button"> <p>Good job scientist!</p></div>
        <a href="dive-locations.php" class="next-button"><img src="images/arrow.png" alt="Next"></a>
    <!-- ****************** -->

  </div>
</body>
                        <!-- SCALE FUNCTION -->
<script type="text/javascript" src="js/scale.js"></script>
</html>
