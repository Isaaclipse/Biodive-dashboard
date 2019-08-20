<?php
include_once 'php/helpers.php';

if(isset($_REQUEST["turbidity"])) {
	writeToTrackerFile("turbidity",$_REQUEST["turbidity"]);
	die();
} elseif(isset($_REQUEST["prey_question"])) {
	writeToTrackerFile("prey_question",$_REQUEST["prey_question"]);
	die();
} elseif(isset($_REQUEST["predator_question"])) {
	writeToTrackerFile("predator_question",$_REQUEST["predator_question"]);
	die();
} elseif(isset($_REQUEST["pageloaded"])) {
	writeToTrackerFile("turbidity","--START--");
	writeToTrackerFile("prey_question","--START--");
	writeToTrackerFile("predator_question","--START--");
	writeToTrackerFile("clear_or_turbid_question","--START--");
	die();
}

standardHeader(true); ?>
    <link rel="stylesheet" type="text/css" media="screen" href="css/global2.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/more-about-snails.css">
</head>
<body>

  <div class="fixed-container blue-folder opened-folder">

    <!-- FOLDER-CONTENTS -->
    <div class="folder-label">CONE SNAILS</div>

    <!-- ARROW TO PREVIOUS -->
    <a href="mission-background.php" class="previous-page-arrow">
      <img src="images/arrow.png" alt="Previous Arrow">
    </a>

    <!-- ARROW TO CONTINUE -->
    <a href="ocean-zones.php" class="next-button" style="display: none;">
        <img class="next" src="images/arrow.png" alt="Next Arrow">
    </a>

    <!-- PAGE NUMBER -->
    <div class="page-number">3</div>

    <!-- ORANGE BOX FOR STATEMEMT -->
    <div class="orange-card">
      <p class="content">
        Let’s learn more about these awesome snails!
      </p>
    </div>

    <!-- PREY QUESTIONS BOX -->
    <div class="prey-drop-holder">
      <p class="header">
        <?php questionMarker("prey-drop-question-marker"); ?>Select the <b>three prey</b> that these venomous snails eat.
        <div class="prey-drop"><?php
        function placeStickers($clickFunctionName) {
          $stickers = array(
            "bearded-fireworm",
            "lobster",
            "periwinkle",
            "coral",
            "shark",
            "sea-turtle",
            "seaweed",
            "dusky-frillgoby",
          );

          shuffle($stickers);

          foreach ($stickers as $sticker) {
            echo "<span>
              <img
                data-content='" . ucwords( str_replace("-"," ",$sticker) ) . "'";

            echo "data-toggle='popover'
                data-placement='top'
                id='sticker-{$sticker}'
                data-id='{$sticker}'
                class='selectSticker questionChoice'
                src='images/stickers/{$sticker}.png'
                onclick='{$clickFunctionName}($(this)); event.preventDefault();'
              /></span>";
          }
        }

        placeStickers('preySelectHandler');?>
        </div>
      </p>
    </div>

    <!-- PREDATOR QUESTIONS BOX -->
    <div class="predator-drop-holder">
      <p class="header">
        <?php questionMarker("predator-drop-question-marker"); ?>Select the <b>two creatures</b> you think are <?php vocabularyWordAlternate("predators","predator","noun","animal that hunts other animals for food."); ?> of the venomous snails:
        <div class="predator-drop"><?php placeStickers('predatorSelectHandler'); ?></div>
      </p>
    </div>

    <!-- SNAIL PICTURE -->
    <div class="snail-picture-2">
      <img src="images/snail-picture/2.png" alt="Snail Picture">
    </div>

    <!-- HEALTHY ECOSYSTEM QUESTIONS -->
    <div class="healthy-ecosystem-question">
      <p class="turbid-water-question">
        <?php questionMarker("turbid-water-question-marker"); ?>Was the water surrounding these snails <span id="clear"><strong>clear</strong></span> or <span id="turbid"><strong><?php vocabularyWord("turbid","adjective","cloudy or opaque"); ?></strong></span>? (please select one of the glasses below)
      </p>
    </div>

    <!-- CONTAINERS OF WATER IMAGES -->
    <div class="turbid-water">
      <ul class="water-cups">
        <?php for ($i = 0; $i < 4; ++$i): ?>
          <li class="water-cup" onclick="HandleCupClick(<?php echo $i; ?>)">
            <img src="images/icons/correct.png">
          </li>
        <?php endfor; ?>
      </ul>
    </div>

    <?php writeUIButtons(); ?>
    <?php writeVocabDiv(); ?>
  </div>

  <script type="text/javascript">
    <?php enablePopovers(); ?>
    <?php enableVocab(); ?>
    <?php enableQuestionMarkers(); ?>

    $(function () {
      <?php enableInstantPopovers(); ?>
      trackPageload();
    });

    trackPageUnload = () => {
      updateTurbidity(`--END--`);
      updatePreyQuestion(`--END--`);
      updatePredatorQuestion(`--END--`);
    };
    <?php enablePageLoadAndUnload(); ?>

    updateTurbidity = (value) => {
      $.ajax({
        url: "<?php echo $_SERVER['PHP_SELF']; ?>?turbidity=" + value,
      });
    };

    updatePreyQuestion = (value) => {
      $.ajax({
        url: "<?php echo $_SERVER['PHP_SELF']; ?>?prey_question=" + value,
      });
    };

    updatePredatorQuestion = (value) => {
      $.ajax({
        url: "<?php echo $_SERVER['PHP_SELF']; ?>?predator_question=" + value,
      });
    };
  </script>
	<script type="text/javascript" src="js/scale.js"></script>.
  <script type="text/javascript" src="js/more-about-snails.js"></script>
</body>
</html>
