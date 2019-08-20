<?php
include_once 'php/helpers.php';
standardHeader(true);?>
    <link rel="stylesheet" type="text/css" media="screen" href="css/global2.css">
</head>
<body>

  <div class="fixed-container yellow-folder opened-folder">

    <!-- FOLDER-CONTENTS -->
    <div class="folder-label">tutorial</div>

    <!-- ARROW TO PREVIOUS -->
    <a href="tutorial.php" class="previous-page-arrow">
      <img src="images/arrow.png" alt="Previous Arrow">
    </a>

    <!-- ARROW TO CONTINUE -->
    <a href="#" class="next-button" onclick="nextArrowClicked();" style="z-index: 300;">
        <img src="images/arrow.png" alt="Next Arrow">
    </a>

    <!-- PAGE NUMBER -->
    <div class="page-number">1</div>



    <?php writeUIButtons(); ?>
    <?php writeBackPageArrow(); ?>
    <?php writeForwardPageArrow(false);?>
    <?php writeVocabDiv(); ?>
  </div>
  <script type="text/javascript" src="js/scale.js"></script>.
</body>
</html>
