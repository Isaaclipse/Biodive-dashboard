<?php
include_once 'php/helpers.php';

if(isset($_REQUEST["organism-changes"])) {
	writeToTrackerFile("organism-changes",$_REQUEST["organism-changes"]);
	die();
} else if(isset($_REQUEST["turbity-changes"])) {
	writeToTrackerFile("turbity-changes",$_REQUEST["turbity-changes"]);
	die();
} else if(isset($_REQUEST["features-of-ecosystem"])) {
	writeToTrackerFile("features-of-ecosystem",$_REQUEST["features-of-ecosystem"]);
	die();
} elseif(isset($_REQUEST["pageloaded"])) {
	writeToTrackerFile("organism-changes","--START--");
	writeToTrackerFile("turbity-changes","--START--");
	writeToTrackerFile("features-of-ecosystem","--START--");
	die();
}

standardHeader(true);?>
    <link rel="stylesheet" type="text/css" media="screen" href="css/global2.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/seas-under-siege.css">
</head>
<body>

  <div class="fixed-container yellow-folder opened-folder">

    <!-- FOLDER-CONTENTS -->
    <div class="folder-label">SEAS UNDER SIEGE</div>

    <!-- ARROW TO PREVIOUS -->
    <a href="back-from-field.php" class="previous-page-arrow">
      <img src="images/arrow.png" alt="Previous Arrow">
    </a>

    <!-- ARROW TO CONTINUE -->
    <a href="trophic-level.php" class="next-button" onclick="nextArrowClicked();" style="z-index: 300;">
        <img src="images/arrow.png" alt="Next Arrow">
    </a>
		<?php writeInitialClickToContinueArrow(".information");?>

    <!-- PAGE NUMBER -->
    <div class="page-number">7</div>

		<!-- ORANGE POPUP -->
		<div class="information" onclick="clickToContinueClicked('.information');">
			<div class="information-text">
				<p>Dr. B.I.G.’s impact is evident across these two scenes. What do you notice about the changes to <?php vocabularyWord("biodiversity","noun","many different species of plants and animals in an environment"); ?>:</p>
			</div>
		</div>

		<!-- ORIGINAL ECOSYSTEM -->
		<div class="original-ecosystem">
			<img src="images/2-months-ago-ecosystem.png"/>
			<p>2 Months Ago</p>
		</div>

		<!-- CURRENT ECOSYSTEM -->
		<div class="current-ecosystem">
			<img src="images/current-ecosystem.png"/>
			<p>Current</p>
		</div>

		<!-- QUESTIONS -->
		<div class="questions">
			<p class="main-question">What changes do you notice between the image from two months ago and the current scene regarding each of the following:</p>
			<div class="quest">
				<p class="question">
				<?php questionMarker("organism-changes-question-marker"); ?>
				Organisms? <input id="organism-changes-question" class="question" type="text"/>
				</p>
				<p class="question">
				<?php questionMarker("turbity-changes-question-marker"); ?>
				Water clarity or turbidity? <input id="turbity-changes-question" class="question" type="text"/>
				</p>
				<p class="question">
				<?php questionMarker("features-of-ecosystem-question-marker"); ?>
				General features of the ecosystem? <input id="features-of-ecosystem-question" class="question" type="text"/>
				</p>
			</div>
		</div>

    <?php writeUIButtons(); ?>
    <?php writeVocabDiv(); ?>
  </div>
	<script type="text/javascript">
		<?php enablePopovers(); ?>
		<?php enableVocab(); ?>
	 	<?php enableClickToContinue(); ?>
		<?php enableQuestionMarkers(); ?>
		<?php enableEnterToTab(); ?>


		trackPageUnload = () => {
			updateQuestion("organism-changes",true);
			updateQuestion("turbity-changes",true);
			updateQuestion("features-of-ecosystem",true);
		}

		trackPageload();
		<?php enablePageLoadAndUnload(); ?>

		updateQuestion = (field, done) => {
			$.ajax({ url: "<?php echo $_SERVER['PHP_SELF']; ?>?" + field + "=" + $("#" + field + "-question").val(), });
			if(done) {
				$.ajax({ url: "<?php echo $_SERVER['PHP_SELF']; ?>?" + field + "=--END--", });
			}
		}
	</script>
	<script type="text/javascript" src="js/scale.js"></script>.
	<script type="text/javascript" src="js/seas-under-siege.js"></script>
</body>
</html>
