<?php
include_once 'php/helpers.php';

if(isset($_REQUEST["tertiary-consumer"])) {
	writeToTrackerFile("tertiary-consumer",$_REQUEST["tertiary-consumer"]);
	die();
} elseif(isset($_REQUEST["secondary-consumer"])) {
	writeToTrackerFile("secondary-consumer",$_REQUEST["secondary-consumer"]);
	die();
} elseif(isset($_REQUEST["primary-consumer"])) {
	writeToTrackerFile("primary-consumer",$_REQUEST["primary-consumer"]);
	die();
} elseif(isset($_REQUEST["primary-producer"])) {
	writeToTrackerFile("primary-producer",$_REQUEST["primary-producer"]);
	die();
} elseif(isset($_REQUEST["pageloaded"])) {
	writeToTrackerFile("tertiary-consumer","--START--");
	writeToTrackerFile("secondary-consumer","--START--");
	writeToTrackerFile("primary-consumer","--START--");
	writeToTrackerFile("primary-producer","--START--");
	die();
}

standardHeader(true);?>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/global2.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/trophic-level.css">
</head>
<body>

  <div class="fixed-container yellow-folder opened-folder">

    <!-- FOLDER-CONTENTS -->
    <div class="folder-label">
      <?php vocabularyWordAlternate("TROPHIC&nbsp;&nbsp;LEVEL", "Trophic level","noun","Organisms that share the same level in the food chain"); ?>
    </div>

    <!-- ARROW TO PREVIOUS -->
    <a href="seas-under-siege.php" class="previous-page-arrow">
      <img src="images/arrow.png" alt="Previous Arrow">
    </a>

    <!-- ARROW TO CONTINUE -->
    <a href="biodiversity.php" class="next-button" style="z-index: 300;">
        <img src="images/arrow.png" alt="Next Arrow">
    </a>
    <?php writeInitialClickToContinueArrow(".left-text");?>

    <!-- PAGE NUMBER -->
    <div class="page-number">8</div>

    <!-- ORANGE POPUP POST IT -->
    <div class="left-text" onclick="clickToContinueClicked('.left-text');">
      <p>Dr Big is threatening the stability of the snail’s ecosystem. Any changes to one trophic level affects all levels.</p>
    </div>

    <!-- BLUE BOX UNDER ORANGE IN THE LEFT -->
    <div class="instructions">
      <p class="message">
        <?php questionMarker("food-chain"); ?>Drag the <?php vocabularyWordAlternate("organisms","organism","noun","A single living thing."); ?> to the <strong>correct</strong> tropic levels:
      </p>
    </div>

    <!-- ASWER PROMPT -->
    <!-- <div class="answer-prompt" style="display: none;"><p class="message"></p></div> -->

    <!-- ORANGE BOX AT THE BOTTOM RIGHT -->
    <div class="right-text">
      <p class="message">
				Organisms need energy, or food, to live. When organisms are eaten about 10% of their energy
				is transferred to the organism that eats them. The rest of their <?php vocabularyWordAlternate("energy is transferred","energy transfer","noun","conversion of one energy form to another out"); ?> as heat as they live or as waste products.
			</p>
    </div>

    <!-- STICKERS -->
    <div class="stickers">
<?php
        $stickers = array(
          array( "name" => "bearded-fireworm", "class" => "primary-consumer sticker",   "level" => "primary-consumer",   "response" => "Bearded fireworms get their energy from corals" ),
          array( "name" => "coral",            "class" => "primary-consumer sticker",   "level" => "primary-consumer",   "response" => "Coral gets its energy from eating floating animals like zooplankton" ),
          array( "name" => "clownfish",        "class" => "primary-consumer sticker",   "level" => "primary-consumer",   "response" => "Clownfish get their energy from algae and small animals like zooplankton" ),
          array( "name" => "conus-geographus", "class" => "secondary-consumer sticker", "level" => "secondary-consumer", "response" => "Conus geographus gets its energy from small fish" ),
          array( "name" => "conus-marmoreous", "class" => "secondary-consumer sticker", "level" => "secondary-consumer", "response" => "Conus marmoreus get their energy from molluscs" ),
          array( "name" => "conus-tessulatus", "class" => "secondary-consumer sticker", "level" => "secondary-consumer", "response" => "Conus tessulatus get their energy from worms" ),
          array( "name" => "dusky-frillgoby",  "class" => "primary-consumer sticker",   "level" => "primary-consumer",   "response" => "Dusky frillgoby gets its energy from seaweed" ),
          array( "name" => "lobster",          "class" => "tertiary-consumer sticker",  "level" => "tertiary-consumer",  "response" => "Lobsters get their energy from other fish and smaller lobsters" ),
          array( "name" => "periwinkle",       "class" => "primary-consumer sticker",   "level" => "primary-consumer",   "response" => "Periwinkle gets its food from algae" ),
          array( "name" => "orange-croaker",   "class" => "tertiary-consumer sticker",  "level" => "tertiary-consumer",  "response" => "Orange croakers get their energy from smaller fish and snails" ),
          array( "name" => "seaweed",          "class" => "primary-producer sticker",   "level" => "primary-producer",   "response" => "Seaweed gets its energy from the sun" ),
          array( "name" => "shark",            "class" => "tertiary-consumer sticker",  "level" => "tertiary-consumer",  "response" => "Sharks get their energy from smaller fish" ),
          array( "name" => "sea-turtle",       "class" => "tertiary-consumer sticker",  "level" => "tertiary-consumer",  "response" => "Sea turtles get their energy from jellyfish and other animals" ),
        );

        shuffle($stickers);

        foreach ($stickers as $sticker) {
          $level = $sticker["level"];

          echo "<img data-content='" . ucwords( str_replace("-"," ",$sticker["response"]) ) . "'
              data-toggle='popover'
              id='sticker-{$sticker["name"]}'
              data-id='{$sticker["name"]}'
              data-level='{$sticker["level"]}'
              data-response='{$sticker["response"]}'
              class='{$sticker["class"]}'
              src='images/stickers/{$sticker["name"]}.png'
            />";
        }
?>
    </div>

    <!-- TROPIC LEVELS, COLOR BOXES -->
    <div class="trophic-levels">
      <div class="side-label autotrophs-label"><?php vocabularyWordAlternate("AUTOTROPHS","Autotrophs","noun","all producers"); ?></div>
      <div class="side-label heterotrophs-label"><?php vocabularyWordAlternate("HETEROTROPHS","Heterotrophs","noun","all consumers"); ?></div>
<?php
        $levels = array(
          array( "id" => "tertiary-consumer",  "name" => "Tertiary Consumer",  "partOfSpeech" => "noun", "definition" => "carnivores (meat eaters) and omnivores (plant or meat eaters) that eat secondary consumers" ),
          array( "id" => "secondary-consumer", "name" => "Secondary Consumer", "partOfSpeech" => "noun", "definition" => "carnivores (meat eaters) and omnivores (plant or meat eaters) that eat primary consumers" ),
          array( "id" => "primary-consumer",   "name" => "Primary Consumer",   "partOfSpeech" => "noun", "definition" => "herbivores that must gain energy by eating primary producers." ),
          array( "id" => "primary-producer",   "name" => "Primary Producer",   "partOfSpeech" => "noun", "definition" => "usually plants and algae. The sun's energy helps them perform photosynthesis to manufacture their own food." )
        );

        foreach ($levels as $level) {
          echo "
            <div id='{$level["id"]}' class='trophic-level'>
              <div class='tropic-level-title'>";
          vocabularyWord($level["name"], $level["partOfSpeech"], $level["definition"]);
          echo ":</div>
              <div class='level-stickers'></div>
            </div>
          ";
        }
?>
    </div>

    <!-- IMAGE NEED IT TO MAKE EVERYTHING DRAGABLE -->
    <img class='dragged-sticker' src='images/stickers/clownfish.png' />

    <?php writeUIButtons(); ?>
    <?php addVideoOverlay("videos/food-chain-animation.mp4");?>
    <?php writeVocabDiv(); ?>
  </div>
  <script type="text/javascript">
    <?php enableClickToContinue(); ?>
    <?php enableQuestionMarkers(); ?>
    <?php enableVocab(); ?>
    <?php enablePopovers(); ?>

    trackPageload();
    trackPageUnload = () => {
      updateStickerDrop("tertiary-consumer","--END--");
      updateStickerDrop("secondary-consumer","--END--");
      updateStickerDrop("primary-consumer","--END--");
      updateStickerDrop("primary-producer","--END--");
    }
    <?php enablePageLoadAndUnload(); ?>

    updateStickerDrop = (which, value) => {
      $.ajax({ url: "<?php echo $_SERVER['PHP_SELF']; ?>?" + which + "=" + value, });
    }
  </script>
  <script src="js/videoplayer.js"></script>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script type="text/javascript" src="js/scale.js"></script>.
  <script type="text/javascript" src="js/trophic-level.js"></script>
</body>
</html>
