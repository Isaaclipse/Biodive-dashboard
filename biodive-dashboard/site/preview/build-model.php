<?php
include_once 'php/helpers.php';

if(isset($_REQUEST["foodwebimage"])) {
	$img = $_POST["foodwebimage"];
	$base_to_php = explode(",", $img);
	$data = base64_decode($base_to_php[1]);
	file_put_contents("food-web-images/".dechex(time()).".jpg", $data);
} elseif(isset($_REQUEST["tertiary-consumer"])) {
	writeToTrackerFile("build-model-tertiary-consumer",$_REQUEST["tertiary-consumer"]);
	die();
} elseif(isset($_REQUEST["secondary-consumer"])) {
	writeToTrackerFile("build-model-secondary-consumer",$_REQUEST["secondary-consumer"]);
	die();
} elseif(isset($_REQUEST["primary-consumer"])) {
	writeToTrackerFile("build-model-primary-consumer",$_REQUEST["primary-consumer"]);
	die();
} elseif(isset($_REQUEST["producer"])) {
	writeToTrackerFile("build-model-producer",$_REQUEST["producer"]);
	die();
} elseif(isset($_REQUEST["pageloaded"])) {
	writeToTrackerFile("build-model-tertiary-consumer","--START--");
	writeToTrackerFile("build-model-secondary-consumer","--START--");
	writeToTrackerFile("build-model-primary-consumer","--START--");
	writeToTrackerFile("build-model-producer","--START--");
	die();
}

standardHeader(true);?>
    <link rel="stylesheet" type="text/css" media="screen" href="css/global2.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/build-model.css">
</head>
<body>

  <div class="fixed-container yellow-folder opened-folder">

    <!-- FOLDER-CONTENTS -->
    <div class="folder-label">SEAS UNDER SIEGE</div>

    <!-- ARROW TO PREVIOUS -->
    <a href="biodiversity.php" class="previous-page-arrow">
      <img src="images/arrow.png" alt="Previous Arrow">
    </a>

    <!-- ARROW TO CONTINUE -->
    <a href="abiotic-biotic.php" class="next-button" style="z-index: 300;">
        <img src="images/arrow.png" alt="Next Arrow">
    </a>

    <!-- PAGE NUMBER -->
    <div class="page-number">10</div>

		<!-- DRAWABLE AREA -->
		<div class="paper-area">
			<p class="instructions">
				<?php questionMarker("food-chain"); ?> <b>Model</b> a Food Web that shows ALL the animals that would prey on each other (hint: more than one arrow should come from each animal!
			</p>
			<div id="answer" class="model-area droppable">
				<canvas id="drawing-board"></canvas>
			</div>
		</div>

		<!-- STICKERS -->
		<div class="stickers droppable">
<?php
				$stickers = array(
					array( "name" => "bearded-fireworm", "level" => "primary-consumer",   "response" => "Bearded fireworms get their energy from corals" ),
					array( "name" => "coral",            "level" => "primary-consumer",   "response" => "Coral gets its energy from eating floating animals like zooplankton" ),
					array( "name" => "clownfish",        "level" => "primary-consumer",   "response" => "Clownfish get their energy from algae and small animals like zooplankton" ),
					array( "name" => "conus-geographus", "level" => "secondary-consumer", "response" => "Conus geographus gets its energy from small fish" ),
					array( "name" => "conus-marmoreous", "level" => "secondary-consumer", "response" => "Conus marmoreus get their energy from molluscs" ),
					array( "name" => "conus-tessulatus", "level" => "secondary-consumer", "response" => "Conus tessulatus get their energy from worms" ),
					array( "name" => "dusky-frillgoby",  "level" => "primary-consumer",   "response" => "Dusky frillgoby gets its energy from seaweed" ),
					array( "name" => "lobster",          "level" => "tertiary-consumer",  "response" => "Lobsters get their energy from other fish and smaller lobsters" ),
					array( "name" => "periwinkle",       "level" => "primary-consumer",   "response" => "Periwinkle gets its food from algae" ),
					array( "name" => "orange-croaker",   "level" => "tertiary-consumer",  "response" => "Orange croakers get their energy from smaller fish and snails" ),
					array( "name" => "seaweed",          "level" => "primary-producer",   "response" => "Seaweed gets its energy from the sun" ),
					array( "name" => "shark",            "level" => "tertiary-consumer",  "response" => "Sharks get their energy from smaller fish" ),
					array( "name" => "sea-turtle",       "level" => "tertiary-consumer",  "response" => "Sea turtles get their energy from jellyfish and other animals" ),
				);

				shuffle($stickers);

				foreach ($stickers as $sticker) {
					$level = $sticker["level"];

					echo "<img data-content='" . ucwords( str_replace("-"," ",$sticker["name"]) ) . "'
							data-toggle='popover'
							id='sticker-{$sticker["name"]}'
							data-id='{$sticker["name"]}'
							data-level='{$sticker["level"]}'
							data-response='{$sticker["response"]}'
							class='sticker draggable'
							src='images/stickers/{$sticker["name"]}.png'
						/>";
				}
?>
		</div>

		<!-- QUESTIONSS -->
		<div class="questions">
			<div class="index-card blue-card">
				<p class="question">
					<?php questionMarker("primary-consumer-question-marker"); ?> What happens to the <b>food web</b> when there are changes to the <b>primary consumers</b>?
				</p>
				<p class="notes">
					<textarea id="primary-consumer-question"></textarea>
				</p>
			</div>

			<div class="index-card green-card">
				<p class="question">
					<?php questionMarker("secondary-consumer-question-marker"); ?> What happens to the <b>food web</b> when there are changes to the <b>secondary consumers</b>?
				</p>
				<p class="notes">
					<textarea id="secondary-consumer-question"></textarea>
				</p>
			</div>

			<div class="index-card red-card">
				<p class="question">
					<?php questionMarker("producer-question-marker"); ?> What happens to the <b>food web</b> when there are changes to the <b>producers</b>?
				</p>
				<p class="notes">
					<textarea id="producer-question"></textarea>
				</p>
			</div>

			<div class="index-card yellow-card">
				<p class="question">
					<?php questionMarker("tertiary-consumer-question-marker"); ?> What happens to the <b>food web</b> when there are changes to the <b>tertiary consumers</b>?
				</p>
				<p class="notes">
					<textarea id="tertiary-consumer-question"></textarea>
				</p>
			</div>
		</div>

		<!-- BUTTONS FOR LITTLE MENU -->
		<div class="button-area">
			<button id="pencil-button" class="highlighted tool-button action-buttons" onclick="toggleDraw();">Pencil</button>
			<button id="eraser-button" class="tool-button action-buttons" onclick="toggleErase();">Eraser</button>
			<button class="clear-button action-buttons" onclick="clearDrawingBoard();">Clear Drawing</button>
			<button class="save-button action-buttons">Done</button>
		</div>

		<!-- LIST OF VOCABULARY -->
		<div class="vocabulary">

			<ul class="vocab1">
				<strong>Vocabulary:</strong>
				<li><?php vocabularyWord("Marine Snails","noun","snails that live in saltwater, also called gastropods")?></li>
				<li>Venom</li>
				<li><?php vocabularyWord("Predator","noun","animal that hunts other animals for food."); ?></li>
				<li><?php vocabularyWord("Prey","noun","animal that is hunted and eaten by other animals.");?></li>
				<li><?php vocabularyWord("Turbid","adjective","cloudy or opaque"); ?></li>
				<li><?php vocabularyWord("Intertidal", "0-3 meters", "This is the seashore where the ocean meets land. It is above water at low tide and below water at high tide.")?></li>
				<li><?php vocabularyWord("Pelagic", "3-1,000 meters", "This is the open sea where sunlight still reaches seaweeds and other flora to provide food for many species of fish and mammals.")?></li>
				<li><?php vocabularyWord("Abyssal", "4,000-6,000 meters", "Below the pelagic, this zone gets little to no light and is much colder than the pelagic zone.")?></li>
				<li><?php vocabularyWord("Benthic", "1,000-4,000 meters", "The deepest part of the ocean, here the water is very cold and there is greater pressure.")?></li>
				<li>Ecosystem</li>
				<li><?php vocabularyWord("palliative","verb","1 : to reduce the violence of (a disease); <br/>2: to ease (symptoms) without curing the underlying disease. drugs to palliate the pain"); ?></li>
				<li><?php vocabularyWord("Siege","noun","serious attack");?></li>
				<li><?php vocabularyWord("Dire","adjective","desperately urgent");?></li>
				<li>Food Chain</li>
			</ul>
			<ul class="vocab2">
				<li><?php vocabularyWord("Autotrophs","noun","all producers"); ?></li>
				<li><?php vocabularyWord("organisms","noun","A single living thing.");?></li>
				<li>Interdependence</li>
				<li><?php vocabularyWord("Trophic Level","noun","Organisms that share the same level in the food chain");?></li>
				<li><?php vocabularyWord("Primary Producer","noun","Usually plants and algae. The sun's energy helps them perform photosynthesis to manufacture their own food."); ?></li>
				<li><?php vocabularyWord("Heterotrophs","noun","all consumers"); ?></li>
				<li><?php vocabularyWord("Primary Consumer","noun","herbivores that must gain energy by eating primary producers."); ?></li>
				<li><?php vocabularyWord("Secondary Consumer","noun","carnivores (meat eaters) and omnivores (plant or meat eaters) that eat primary consumers"); ?></li>
				<li><?php vocabularyWord("Tertiary Consumer","noun", "carnivores (meat eaters) and omnivores (plant or meat eaters) that eat secondary consumers"); ?></li>
				<li>Apex Predators</li>
				<li><?php vocabularyWord("Energy Transfer","noun","conversion of one energy form to another out");?></li>
				<li><?php vocabularyWord("Biodiversity","noun","many different species of plants and animals in an environment");?></li>
				<li><?php vocabularyWord("Homeostasis","noun","A balance or equilibrium in the environment.");?></li>
				<li><?php vocabularyWord("Food web","noun","all related food chains in an ecosystem. Also called a food cycle.");?></li>
			</ul>
		</div>

    <?php writeUIButtons(); ?>
    <?php writeVocabDiv(); ?>
  </div>
	<script src="js/html2canvas.min.js" type="text/javascript"></script>
	<script src="js/jquery.jqscribble.js" type="text/javascript"></script>
	<script type="text/javascript">
	<?php enablePopovers(); ?>
	<?php enablePageLoadAndUnload(); ?>
	<?php enableEnterToTab(); ?>
	<?php enableQuestionMarkers(); ?>
	<?php enableVocab(); ?>
	trackPageload();

	function trackPageUnload() {
		updateQuestion("tertiary-consumer",true);
		updateQuestion("secondary-consumer",true);
		updateQuestion("primary-consumer",true);
		updateQuestion("producer",true);
	}

	function updateQuestion(field, done) {
		$.ajax({ url: "<?php echo $_SERVER['PHP_SELF']; ?>?" + field + "=" + $("#" + field + "-question").val(), });
		if(done) {
			$.ajax({ url: "<?php echo $_SERVER['PHP_SELF']; ?>?" + field + "=--END--", });
		}
	}

	function saveImage() {
		html2canvas($("#answer").get(0)).then(function(canvas) {
			var base64encodedstring = canvas.toDataURL("image/jpeg", 1);
			$.ajax({
				type: "POST",
				url: "<?php echo $_SERVER['PHP_SELF']; ?>",
				data: {
					foodwebimage: base64encodedstring
				}
			}).done(function(e) {
				console.log("saved right!");
			}).fail(function(data) {
				console.log("oops didn't save");
			});
			questionMarkerComplete('food-chain');
			$('.save-button').addClass('clicked');
			checkDoneHandler()
		});
		// $('.questions').show();
		// $('.vocabulary').show();
		// $('.button-area').css({ display: "none" });
	}
	</script>
	<script type="text/javascript" src="js/build-model.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
<!--
	<script type="text/javascript" src="js/scale.js"></script>
-->
</body>
</html>
