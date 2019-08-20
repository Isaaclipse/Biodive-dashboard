<?php
include_once 'php/helpers.php';
standardHeader(true);?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>abiotic-biotic</title>
    <meta name="viewport" content="user-scalable=no, width=1280">
    <link rel="stylesheet" type="text/css" href="css/global2.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/abiotic-biotic.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha256-pS96pU17yq+gVu4KBQJi38VpSuKN7otMrDQprzf/DWY=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="js/abiotic-biotic.js"></script>
     <script type="text/javascript">
        <?php enableVocab();?>
        <?php enableClickToContinue();?>
        $(function() {
        <?php enablePopovers();?>
        });
    <?php writeVocabDiv();?>
    <?php writeArticlesIFrameDiv(); ?>
  </script>
  </head>
<body>

  <div class="fixed-container blue-folder closed-folder">

    <!-- FOLDER-CONTENTS -->
    <!-- ****************** -->
    <div class="folder-label">DivePrep</div>
    <?php writeInitialClickToContinueArrow(".orange-text-box");?>
    
    <div class="orange-text-box click-to-continue-button" onclick="clickToContinueClicked('<?php echo $divToAnimate; ?>');"><p>Abiotic variables are non-living components of an environment. You'll need to collect abiotic clues to stop Dr. BIG from devastating the seas, but which of the following are abiotic variables?</p></div>

      <div class="text-box">
        <span class="text">Drag these <strong><?php vocabularyWord("abiotic", "adjective", "something that is not lifelike, a non-living organism.");?></strong> and <strong><?php vocabularyWord("biotic", "adjective", "something life-like, a living organism.");?></strong> factors into the correct buckets.</span>
      </div>
      <a href="build-model.php" class="previous-page-arrow">
      
      <img src="images/arrow.png" alt="Previous Arrow">
    <?php writeUIButtons();?>
   
    </a>
    <a href="dive-equipment.php" class="next-button" onclick="nextArrowClicked();" style="z-index:300">
        <img src="images/arrow.png" alt="Next Arrow">
    </a>

    <div class="next-page-box" style="z-index:300">
        <p>Good job scientist!</p>
    </div>
    <div>
      <img class="abiotic-bucket droppable-abiotic-bucket"   src="images/abiotic-biotic/abioticbucket.png" alt="abiotic-bucket">
      <img class="biotic-bucket droppable-biotic-bucket"   src="images/abiotic-biotic/bioticbucket.png"  alt="biotic-bucket">
        <div>
          <img class="sticker-salinity draggable-abiotic"  src="images/abiotic-biotic/stickersalinity.png" alt="sticker-salinity">
          <img class="clownfish draggable-biotic"  src="images/stickers/clownfish.png" alt="clownfish">
          <img class="bacteria draggable-biotic"  src="images/abiotic-biotic/stickerbacteria.png" alt="bacteria">
          <img class="o2 draggable-abiotic" src="images/abiotic-biotic/sticker02.png" alt="o2">
          <img class="seaturtle draggable-biotic"  src="images/stickers/sea-turtle.png" alt="seaturtle">
          <img class="ph draggable-abiotic"  src="images/abiotic-biotic/stickerph.png" alt="pH">
          <img class="seaweed draggable-biotic"  src="images/stickers/seaweed.png" alt="seaweed">
          <img class="temperature draggable-abiotic" src="images/abiotic-biotic/stickertemperature.png" alt="temperature">
          <img class="conus-geographus draggable-biotic"  src="images/stickers/conus-geographus.png" alt="conus-marmoreus">
          <img class="clarity draggable-abiotic"           src="images/abiotic-biotic/stickerclarity.png" alt="clarity">
       </div>
    </div>

  </div>
</body>
<script type="text/javascript" src="js/scale.js"></script>
</html>
