<?php
include_once 'php/helpers.php';

if(isset($_REQUEST["zone_drop"])) {
	writeToTrackerFile("zone_drop",$_REQUEST["zone_drop"]);
	die();
} elseif(isset($_REQUEST["zone_choice"])) {
	writeToTrackerFile("zone_choice",$_REQUEST["zone_choice"]);
	die();
} elseif(isset($_REQUEST["zone_writein"])) {
	writeToTrackerFile("zone_writein",$_REQUEST["zone_writein"]);
	die();
} elseif(isset($_REQUEST["pageloaded"])) {
	writeToTrackerFile("zone_drop","--START--");
	writeToTrackerFile("zone_choice","--START--");
	writeToTrackerFile("zone_writein","--START--");
	die();
}

standardHeader(true);?>
    <link rel="stylesheet" type="text/css" media="screen" href="css/global2.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/ocean-zones.css">
</head>
<body>

  <div class="fixed-container blue-folder opened-folder">

    <!-- FOLDER-CONTENTS -->
    <div class="folder-label">CONE SNAILS</div>

		<!-- ARROW TO PREVIOUS -->
    <a href="more-about-snails.php" class="previous-page-arrow">
      <img src="images/arrow.png" alt="Previous Arrow">
    </a>

		<!-- ARROW TO CONTINUE -->
    <a href="ecosystem.php" class="next-button" style="z-index: 300;">
        <img src="images/arrow.png" alt="Next Arrow">
    </a>
		<?php writeInitialClickToContinueArrow(".ocean-zone-info");?>

		<!-- PAGE NUMBER -->
    <div class="page-number">4</div>

		<!-- INFO-POST-IT -->
    <div class="ocean-zone-info" onclick="clickToContinueClicked('.ocean-zone-info');">
      <p> Learn More about where these snails live in different oceanic zones.</p>
    </div>

		<!-- OCEAN ZONE MAIN IMAGE -->
		<img class="ocean-zone-image" src="images/ocean-zones.png" alt="Ocean Zones">

		<!-- DRAG INSTRUCTION -->
		<div class="drag-instructions">
			<p class="header">
				<?php questionMarker("zone-drop-question-marker"); ?>
				Drag the post it notes to label the oceanic zones.
			</p>
		</div>

		<!-- DRAGABLE POSTERS -->
		<div id="benthic-label" class="draggable zone" >
			<div class="note-paper-text">
				<b><?php vocabularyWord("Benthic", "1,000-4,000 meters", "The deepest part of the ocean, here the water is very cold and there is greater pressure.")?>:</b>
				<p class="text">Below the pelagic, this zone gets little to no light and is much colder than the pelagic zone.</p>
			</div>
		</div>
		<div id="abyssal-label" class="draggable zone">
			<div class="note-paper-text">
				<b><?php vocabularyWord("Abyssal", "4,000-6,000 meters", "Below the pelagic, this zone gets little to no light and is much colder than the pelagic zone.")?>:</b>
				<p class="text">The deepest part of the ocean, here the water is very cold and there is greater pressure.</p>
			</div>
		</div>
		<div id="pelagic-label" class="draggable zone">
			<div class="note-paper-text">
				<b><?php vocabularyWord("Pelagic", "3-1,000 meters", "This is the open sea where sunlight still reaches seaweeds and other flora to provide food for many species of fish and mammals.")?>:</b>
				<p class="text">This is the open sea where sunlight still reaches seaweeds and other flora to provide food for many species of fish and mammals.</p>
			</div>
		</div>
		<div id="intertidal-label" class="draggable zone">
			<div class="note-paper-text">
				<b><?php vocabularyWord("Intertidal", "0-3 meters", "This is the seashore where the ocean meets land. It is above water at low tide and below water at high tide.")?>:</b>
				<p class="text">This is the seashore where the ocean meets land. It is above water at low tide and below water at high tide.</p>
			</div>
		</div>

		<!-- DROPPABLE POSTERS HOLDERS FOR ANSWERS -->
		<div id="intertidal-zone-drop" class="droppable zone"></div>
		<div id="benthic-zone-drop" class="droppable zone"></div>
		<div id="pelagic-zone-drop" class="droppable zone"></div>
		<div id="abyssal-zone-drop" class="droppable zone"></div>

		<!-- QUESTIONS PROMPT -->
		<div class="zone-question-prompt" style="display: none;">
			<p class="header">
				<?php questionMarker("zone-click-question-marker"); ?>
				Based on your prior knowledge, in what zone would whales live?</p>
		</div>

		<!-- FILL IN BLANK QUESTIONS -->
		<div class="end-screen">
			<div class="index-card">
				<p class="instruction">
					<?php questionMarker("prey-drop-question-marker"); ?>
					Great job! Why do you think the pelagic zone is a good place for whales to live?
				</p>
				<p class="hint">Hint: Use the text in the post-it to help you answer the question!</p>
				<p class="notes">
					<textarea id="question"></textarea>
				</p>
			</div>
		</div>

    <?php writeUIButtons(); ?>
    <?php writeVocabDiv(); ?>
  </div>

	<script type="text/javascript">
		<?php enablePopovers(); ?>
		<?php enableVocab(); ?>
		<?php enableQuestionMarkers(); ?>
		<?php enableClickToContinue(); ?>
		<?php enablePageLoadAndUnload(); ?>

		trackPageload();

		function trackPageUnload() {
		  updateZoneDrop("--END--");
		  updateZoneChoice("--END--");
		  updateWriteIn(true);
		}

		updateZoneDrop = (value) => {
		  $.ajax({ url: "<?php echo $_SERVER['PHP_SELF']; ?>?zone_drop=" + value, });
		}

		updateZoneChoice = (value) => {
		  $.ajax({ url: "<?php echo $_SERVER['PHP_SELF']; ?>?zone_choice=" + value, });
		}

		updateZoneWriteIn = (value) => {
		  $.ajax({ url: "<?php echo $_SERVER['PHP_SELF']; ?>?zone_writein=" + value, });
		}
	</script>
	<script type="text/javascript" src="js/ocean-zones.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
	<script type="text/javascript" src="js/scale.js"></script>.
</body>
</html>
