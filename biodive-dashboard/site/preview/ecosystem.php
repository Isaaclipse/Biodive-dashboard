<?php
include_once 'php/helpers.php';
include_once 'php/vr-and-eggs.php';

if(isset($_REQUEST["ecosystem_questions"])) {
	writeToTrackerFile("ecosystem_questions".$_REQUEST["ecosystem_questions"],$_REQUEST["result"]);
	die();
} elseif(isset($_REQUEST["pageloaded"])) {
	for($i=1;$i<7;$i++) {
		writeToTrackerFile("ecosystem_questions".$i,"--START--");
	}
	die();
}

standardHeader(true);?>
    <link rel="stylesheet" type="text/css" media="screen" href="css/global2.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/vr-and-eggs.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/ecosystem.css">
</head>
<body>

  <div class="fixed-container blue-folder opened-folder">

    <!-- FOLDER-CONTENTS -->
    <div class="folder-label">Cone Snails</div>

    <!-- ARROW TO PREVIOUS -->
    <a href="ocean-zones.php" class="previous-page-arrow">
      <img src="images/arrow.png" alt="Previous Arrow">
    </a>

    <!-- ARROW TO CONTINUE -->
    <a href="#" class="next-button" onclick="nextArrowClicked();" style="z-index: 300;">
        <img src="images/arrow.png" alt="Next Arrow">
    </a>
		<?php writeInitialClickToContinueArrow(".info-post-it");?>

    <!-- PAGE NUMBER -->
    <div class="page-number">5</div>

		<!-- INFO-POST-IT -->
		<div class="info-post-it" onclick="clickToContinueClicked('.info-post-it');">
			<p>An ecosystem is made up of interactions between living things like producers, consumers and microorganisms with non-living things like the soil, rocks, minerals and water sources that make up their environment.</p>
		</div>

		<!-- BIG MARINE ECOSYSTEM IMAGE -->
		<img class="ecosystem-image" src="images/marine-ecosystem.png" alt="Marine Ecosystem">

		<!-- QUESTIONSS PROMPT -->
		<div class="question-prompt">
			<p></p>
		</div>

		<!-- CORRECT PROMPT -->
		<div class="correct-prompt">
			<p></p>
		</div>

		<!-- HINT PROMPT -->
		<div class="hint-prompt">
			<p></p>
		</div>

		<!-- ZONES THAT CAN BE CLICK -->
		<div id="click-zones">
			<?php
			$zones = array(
			array( "id" => "sand", "placement" => "top", "offset" => "-5%,-20%" ),
			array( "id" => "shark", "placement" => "right" ),
			array( "id" => "periwinkle", "placement" => "top" ),
			array( "id" => "sun", "placement" => "bottom" ),
			array( "id" => "zooplankton", "placement" => "right" ),
			array( "id" => "phytoplankton", "placement" => "right" ),
			array( "id" => "bacteria/decomposers", "placement" => "right" ),
			array( "id" => "seaweed", "placement" => "top", "offset" => "-50%,-50%" ),
			array( "id" => "coral", "placement" => "top", "offset" => "10%,-50%" ),
			array( "id" => "conus-geographus", "placement" => "right" ),
			array( "id" => "conus-marmoreous", "placement" => "right" ),
			array( "id" => "lobster", "placement" => "top" ),
			array( "id" => "sea-turtle", "placement" => "left" ),
			array( "id" => "orange-croaker", "placement" => "right" ),
			array( "id" => "clownfish", "placement" => "top" ),
			array( "id" => "dusky-frillgoby", "placement" => "top" ),
			array( "id" => "angelfish", "placement" => "right" ),
			);

			foreach($zones as $zone) {
			echo "\t\t\t" . '<div class="' . $zone["id"] . '-zone" data-toggle="popover" data-placement="' . $zone["placement"] . '" data-content="' . ucwords( str_replace("-"," ",$zone["id"]) ) . '" ' . ($zone["offset"]!="" ? 'data-offset="' . $zone["offset"] . '" ' : '' ) . ' onclick="answerQuestion(\'' . $zone["id"] . '\')"></div>';
			}
			?>
		</div>

		<?php writeUIButtons(); ?>
    <?php writeVocabDiv(); ?>

		<!-- VR INSTRUCTIONS -->
		<?php writeOpeningEggsAndVR(); ?>
		<p class="para">
			Good work, <?php showStudentName(false); ?>. These killer snails live in a delicate and mysterious ecosystem.
			<?php showTeacherName(false); ?> needs to collect more intel on their surroundings so the F&BI team can keep
			them safe and scientists can continue to use their venomous peptides for <?php vocabularyWord("palliative","verb","1 : to reduce the violence of (a disease); <br/>2: to ease (symptoms) without curing the underlying disease. drugs to palliate the pain"); ?> cures.
			<br/><br/>
			<strong class="str">It’s time to head back to the field to collect intel.<strong>
		</p>
		<?php
		writeVRIcon("START DIVE","dive");
		writeEndingEggsAndVR();
		?>
		<?php addVideoOverlay('videos/two_cone_snails_eat_fish.mp4');?>
  </div>
	<script type="text/javascript">
		<?php enableQuestionMarkers(); ?>
		<?php enableClickToContinue(); ?>
		<?php enablePopovers(); ?>
    <?php enableVocab(); ?>
		<?php enableEasterEggs(); ?>
		<?php enableArticles(); ?>
		<?php enableInstantPopovers(); ?>

		trackPageUnload = () => {
			updateQuestion(1,"",true);
			updateQuestion(2,"",true);
			updateQuestion(3,"",true);
			updateQuestion(4,"",true);
			updateQuestion(5,"",true);
			updateQuestion(6,"",true);
		}
		<?php enablePageLoadAndUnload(); ?>
		updateQuestion = (which, value, done) => {
			$.ajax({ url: "<?php echo $_SERVER['PHP_SELF']; ?>?ecosystem_questions=" + which + "&result=" + value, });
			if(done) {
				$.ajax({ url: "<?php echo $_SERVER['PHP_SELF']; ?>?ecosystem_questions=" + which + "&result=---END---", });
			}
		}

		displayQuestion = () => {
			$(".question-prompt").show();
			$(".question-prompt").html('<p><?php questionMarker("question-marker"); ?>' + questions[currentQuestion] + "</p>");
			$(".hint-prompt").hide();
			$(".correct-prompt").hide();
			clickToContinueActive = false;
		}
	</script>
	<script src="js/videoplayer.js"></script>
	<script type="text/javascript" src="js/ecosystem.js"></script>
  <script type="text/javascript" src="js/scale.js"></script>
</body>
</html>
