<?php
global $vocabConent;
$vocabConent = "";

/** @todo Replace with information from login */
function showStudentName($bold = true) {
	$studentName = "";
	$result = "Scientist";
	echo "<i>" . $result . "</i>";
}

/** @todo Replace with information from login */
function showTeacherName($bold = true) {
	$teacherName = "";
	$result = "The Chief Scientist";
	echo "<i>" . $result . "</i>";
}

/** @todo Replace with database references */
global $pages, $currentPageId, $currentPageTitle;
$pages = array(
	array ( "id" => "001", "link" => "tutorial.php", "title" => "Tutorial"),
	array ( "id" => "002", "link" => "mission-background.php", "title" => "Mission Background"),
	array ( "id" => "003", "link" => "more-about-snails.php", "title" => "More About Snails"),
	array ( "id" => "004", "link" => "ocean-zones.php", "title" => "Ocean Zones"),
	array ( "id" => "005", "link" => "ecosystem.php", "title" => "Ecosystem"),
	array ( "id" => "006", "link" => "back-from-field.php", "title" => "Back From Field"),
	array ( "id" => "007", "link" => "seas-under-siege.php", "title" => "Seas Under Siege"),
	array ( "id" => "008", "link" => "trophic-level.php", "title" => "Trophic Level"),
	array ( "id" => "009", "link" => "biodiversity.php", "title" => "Biodiversity"),
	array ( "id" => "010", "link" => "build-model.php", "title" => "Build A Model"),
	array ( "id" => "011", "link" => "abiotic-biotic.php", "title" => "Abiotic & Biotic"),
	array ( "id" => "012", "link" => "dive-equipment.php", "title" => "Dive Equipment"),
	array ( "id" => "013", "link" => "dive-locations.php", "title" => "Dive Locations"),
	array ( "id" => "014", "link" => "analyzing-and-interpreting.php", "title" => "Analyzing & Interpreting")
);
setCurrentPage();
setCurrentPageTitle();

function setCurrentPage() {
	global $pages, $currentPageId;
	$currentPageId = array_search(basename($_SERVER['PHP_SELF']),array_column($pages,"link"));
}

function setCurrentPageTitle() {
	global $pages, $currentPageTitle;
	$index = array_search(basename($_SERVER['PHP_SELF']),array_column($pages,"link"));
	if($index!==false) {
		$currentPageTitle = $pages[$index]["title"];
	} else {
		$currentPageTitle = "Killer Snails";
	}
}

function writePageNumber() {
	global $currentPageId;
?>
			<div class="page-number"><?php echo ($currentPageId + 1); ?></div>
<?php
}

function writeBackPageArrow() {
	global $pages, $currentPageId;
	if($currentPageId>0) {
		?>
			<a href="<?php echo $pages[$currentPageId-1]["link"];  ?>" class="back-button"><img src="images/arrow.png" alt="Back" /></a>
<?php
	}
}

function writeForwardPageArrow($show = true) {
	global $pages, $currentPageId;
	if($currentPageId<count($pages)-1) {
?>
			<a href="<?php writeNextPageURL(); ?>" class="next-button" <?php if($show==false) { echo ' style="display: none;"'; } ?>><img src="images/arrow.png" alt="Next" /></a>
<?php
	}
}

function writeNextPageURL() {
	global $pages, $currentPageId;
	echo $pages[$currentPageId+1]["link"];
}

function writeInitialClickToContinueArrow($divToAnimate) {
?>
			<a href="#" class="click-to-continue-button" onclick="clickToContinueClicked('<?php echo $divToAnimate; ?>');">
				<img src="images/arrow.png" alt="Continue" />
			</a>
			<div id="click-to-continue"></div>
<?php
}

function standardHeader($newHeaders = false) {
	global $currentPageTitle;
?>
<!doctype html>
	<html lang="en">
	<head>
		<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php echo $currentPageTitle; ?> - BioDive Digital Journal</title>
		<link href="https://fonts.googleapis.com/css?family=Bevan|Raleway:400,600,700,800" rel="stylesheet">
<?php if($newHeaders==false) { ?>
		<link rel="stylesheet" href="css/reset.css">
		<link rel="stylesheet" href="css/global.css">
<?php } else { ?>
		<link rel="stylesheet" href="css/reset.css">
<?php } ?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="js/anime.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="css/popover.css">
<?php
}

function enablePopovers() {
?>
				$('[data-toggle="popover"]').popover({
					trigger: 'hover',
					delay: { "show": 1000, "hide": 100 },
					html: true,
				});
<?php
}

function enableInstantPopovers() {
?>
				$('[data-toggle="popover"]').popover({
					trigger: 'hover',
					delay: { "show": 10, "hide": 10 },
					html: true,
				}).off("click");
<?php
}

function enablePageLoadAndUnload() {
?>
			$(window).on('beforeunload',  trackPageUnload );

			function trackPageload() {
				$.ajax({ url: "<?php echo $_SERVER['PHP_SELF']; ?>?pageloaded=" + true, });
			}

<?php
}

function enableEnterToTab() {
?>
			function enterToTab(event) {
				if(event.which===13) {
					event.stopPropagation();
					event.preventDefault();

					inputs = $("input");

					if(event.shiftKey) {
						if(!$(event.target).is(inputs.first())) {
							inputs.eq(inputs.index( event.target ) - 1).focus();
						}
					} else {
						if(!$(event.target).is(inputs.last())) {
							inputs.eq(inputs.index( event.target ) + 1).focus();
						}
					}
				}
			}
<?php
}

function enableClickToContinue() {
?>
			function clickToContinueClicked(zoneToAnimate) {
				$(zoneToAnimate).addClass("next-anim");
				$("#click-to-continue").remove();
				$(".click-to-continue-button").remove();
			}
<?php
}

function vocabularyWordAlternate($wordToDisplay, $word, $partOfSpeech, $definition) {
	global $vocabConent;

	echo '<span class="vocabularyPopover" data-toggle="popover" data-placement="top" data-content="<div><b>' . ucfirst($word) . '</b>:&nbsp;&nbsp; <i>(' . $partOfSpeech . ')</i><br/>' . $definition . '</div>">' . $wordToDisplay . '</span>';

	$vocabConent .= '<div><p><b>'. ucfirst($word) . '</b>:&nbsp;&nbsp; <i>(' . $partOfSpeech . ')</i><br/>' . $definition . '</p></div>';
}

function vocabularyWord($word, $partOfSpeech, $definition) {
	vocabularyWordAlternate($word, $word, $partOfSpeech, $definition);
}

function writeToTrackerFile(string $filename, string $value) {
	$text = date('Y-m-d H:i:s') . "\t" . $_SERVER["REMOTE_ADDR"] . "\t" . $value . PHP_EOL;
	file_put_contents($filename . ".tsv", $text, FILE_APPEND);
}

function questionMarker($name) {
	echo '<span id="'. $name . '" class="question-marker-incomplete">&#9733;</span> ';
}

function enableQuestionMarkers() {
?>
			function questionMarkerComplete(which) {
				$("#" + which).removeClass("question-marker-incomplete");
				$("#" + which).addClass("question-marker-complete");
			}

			function questionMarkerIncomplete(which) {
				$("#" + which).addClass("question-marker-incomplete");
				$("#" + which).removeClass("question-marker-complete");
			}
<?php
}

function addVideoOverlay($video, $onClickOff = true, $showNextPage = false) {
?>
			<div class="video-background" <?php if($onClickOff) { ?>onclick="hideVideo($(this))"<?php } ?>>
				<div id="video-container">
					<video id="video-player" controls controlsList="nodownload">
							<source src="<?php echo $video; ?>" type="video/mp4">
						</video>
<?php if($showNextPage) { writeForwardPageArrow() ; } ?>
				</div>
			</div>
<?php
}

/* ---- UI ---- */
function writeUIButtons() {
	global $vocabConent;
?>
			<ul class="buttons">
				<li><a href="#mail-icon"><img class="comingSoon" src="images/icons/MailIcon.png" alt="mail Icon" /></a></li>
				<li><a id="vocab-button" data-toggle="popover" data-placement="top" data-content="Vocabulary" href="#vocab"><img <?php echo ($vocabConent!="") ? ' onclick="showVocab();" ' : 'class="comingSoon" '; ?>src="images/icons/vocab.png" alt="Vocab Icon" /></a></li>
			</ul>
<?php
}

/* ---- Vocab ---- */
function writeVocabDiv() {
	global $vocabConent;
	if(strlen($vocabConent)==0) { return; }
?>
		<div class="vocab-view" style="display:none;">
			<a href="#" onclick="hideVocab();" class="vocab-close-link" >
				<img src="images/icons/exit.png" onclick="hideVocab();">
			</a>
			<div class="vocab-folder">
				<div class="vocab-folder-label">
					<a href="#" onclick="hideVocab();" class="vocab-title-link">Vocabulary</a>
				</div>
				<div class="vocab-text">
					<h1>Vocabulary</h1>
<?php echo $vocabConent; ?>
				</div>
			</div>
		</div>
<?php
}

function enableVocab() {
?>
			function showVocab() { $(".vocab-view").fadeIn(); }

			function hideVocab() { $(".vocab-view").fadeOut(); }
<?php
}

/* ---- Article iFrames ---- */
function writeArticlesIFrameDiv() {
?>
			<div class="article-iframe" onclick="hideArticle();" style="display: none;">
				<div class="iframe-container article-iframe-container">
					<iframe name="article-iframe-source" src="articles/washington-post/index.html"></iframe>
				</div>
			</div>
<?php
}

function enableArticles() {
?>
			function showArticle() { $(".article-iframe").fadeIn(); }

			function hideArticle() { $(".article-iframe").fadeOut(); }
<?php
}
?>
