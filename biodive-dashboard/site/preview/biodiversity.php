<?php
include_once 'php/helpers.php';
standardHeader(true);?>
    <link rel="stylesheet" type="text/css" media="screen" href="css/global2.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/biodiversity.css">
</head>
<body>

  <div class="fixed-container yellow-folder opened-folder">

    <!-- FOLDER-CONTENTS -->
    <div class="folder-label">SEAS UNDER SIEGE</div>

    <!-- ARROW TO PREVIOUS -->
    <a href="trophic-level.php" class="previous-page-arrow">
      <img src="images/arrow.png" alt="Previous Arrow">
    </a>

    <!-- ARROW TO CONTINUE -->
    <a href="build-model.php" class="next-button" onclick="nextArrowClicked();" style="z-index: 300;">
        <img src="images/arrow.png" alt="Next Arrow">
    </a>

    <!-- PAGE NUMBER -->
    <div class="page-number">9</div>

    <!-- INFO-POST-IT -->
    <div class="biodiverity-info" onclick="clickToContinueClicked('.biodiverity-info');">
      <p>Tap each of the circles to see what happens to the biodiversity in a marine environment when you change the quantity of different trophic levels.</p>
    </div>
    <?php writeInitialClickToContinueArrow(".biodiverity-info");?>

    <!-- OCEAN IMAGE -->
    <div class="biodiversity-image">
      <img id="biodiversity-image" src="images/biodiversity/homeostasis.png" alt="Biodiversity Picture"/>
      <p id="image-info">Changes over time...</p>
    </div>

    <!-- ANIMALS SPECIES IMAGES -->
    <div class="left-side-image">
      <p>The Food Web: A food web is made up of interconnected food chains.</p>
      <img src="images/papers/foodweb.png" />
    </div>

    <!-- BOTTOM RIGHT BLUE BOX -->
    <div class="blue-card">
      <div class="blue-card-instructions">
        Tap the circles to see what happends to the biodiversity in a marine enviroment when you change the quantity of different trophic levels.
      </div>
      <div class="blue-card-headers">
        Trophic Level
        <span class="header-less">Less</span>
        <span class="header-homeostatis">Homeostasis</span>
        <span class="header-more">More</span>
      </div>
      <div class="slider-group" id="slider-primary-producer">
        <div class="slider-lable"><span class="pp">Primary Producers</span> </div>
        <div  class="slider-zone">
          <span class="dot less"></span>
          <span class="dot homeostasis active"></span>
          <span class="dot more"></span>
        </div>
        <div class="slider-info">Producers provide energy to the organisms that consume them</div>
      </div>
      <div class="slider-group" id="slider-primary-consumer">
        <div class="slider-lable"><span class="pc">Primary Consumers</span> </div>
        <div class="slider-zone">
          <span class="dot less"></span>
          <span class="dot homeostasis active"></span>
          <span class="dot more"></span>
        </div>
        <div class="slider-info">Primary consumers provide energy to secondary consumers and control the population of producers.</div>
      </div>
      <div class="slider-group" id="slider-secondary-consumer">
        <div class="slider-lable"><span class="sc">Secondary Consumers</span> </div>
        <div class="slider-zone">
          <span class="dot less"></span>
          <span class="dot homeostasis active"></span>
          <span class="dot more"></span>
        </div>
        <div class="slider-info">Secondary consumers provide energy to tertiary consumers and control the population of primary consumers.</div>
      </div>
      <div class="slider-group" id="slider-tertiary-consumer">
        <div class="slider-lable"><span class="tc">Tertiary Consumers</span> </div>
        <div class="slider-zone">
          <span class="dot less" ></span>
          <span class="dot homeostasis active" ></span>
          <span class="dot more"></span>
        </div>
        <div class="slider-info">Tertiary consumers provide energy to secondary consumers and control the population of the secondary consumers.</div>
      </div>
    </div>

    <!-- INFO POST IT -->
    <div class="darkness"></div>
    <div class="info-post-it">
      <p class="content"></p>
    </div>

    <?php writeUIButtons(); ?>
    <?php writeVocabDiv(); ?>
  </div>

  <script type="text/javascript">
    <?php enableClickToContinue(); ?>
    <?php enablePopovers(); ?>
    <?php enableVocab(); ?>
  </script>
  <script type="text/javascript" src="js/biodiversity.js"></script>
  <script type="text/javascript" src="js/scale.js"></script>.
</body>
</html>
