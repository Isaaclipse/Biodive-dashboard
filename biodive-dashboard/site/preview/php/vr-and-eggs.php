<?php
function enableEasterEggs() {
	?>
			function showEasterEggs() {
				$('.easter-egg-selections').show();
				$(".next-button").hide();
				$(".back-button").hide();
				$("#egg-hint").hide();
			}

			function hideEasterEggs() {
				$('.easter-egg-selections').hide();
				$(".next-button").show();
				$(".back-button").show();
			}
<?php
}

function writeEggAndVRInstructions($diveLabel,$diveClass,$content) {
	writeOpeningEggsAndVR();
?>
					<div class="instruction-page1">
						<p>
<?php echo $content; ?>
						</p>
<?php writeVRIcon($diveLabel, $diveClass);?>
					</div>
<?php
writeEndingEggsAndVR();
}

function writeOpeningEggsAndVR() {
?>
			<div class="vr-instructions" style="display: none">
				<a href="#easter-eggs" onclick="">
					<img src="images/easter-eggs/divedeeper.png" class="easter-egg-toggle" alt="Easter Eggs" data-toggle="popover" data-placement="top" data-content="Easter Eggs" onclick="showEasterEggs();"/>
				</a>
				<div id="egg-hint">
					<div class="egg-hint-arrow">
						<img src="images/fancy-arrow.png"/>
					</div>
					<div class="egg-hint-text">
						<p>If you’re waiting for the headset dive deeper into the world of killer snails here</p>
					</div>
				</div>
				<div class="vr-popup" style="display: inherit;">
<?php
}

function writeEndingEggsAndVR() {
?>
				</div>
			</div>
			<div class="easter-egg-selections" style="display: none;" onclick="hideEasterEggs();">
				<a class="easter-egg-button egg1" onclick="showVideo('videos/two_cone_snails_eat_fish.mp4'); event.stopPropagation();">
					<img src="images/easter-eggs/video.png" alt="Easter Egg" data-toggle="popover" data-placement="top" data-content="Snail Attack"/>
					<p>Snail Attack</p>
				</a>

				<a class="easter-egg-button egg2" onclick="showVideo('videos/lrg-conesnail-110217.mp4'); event.stopPropagation();">
					<img src="images/easter-eggs/video.png" alt="Easter Egg" data-toggle="popover" data-placement="top" data-content="Breakthrough"/>
					<p>Breakthrough</p>
				</a>

				<a class="easter-egg-button egg3" href="articles/abc-news/index.html" target="article-iframe-source" onclick="showArticle(); event.stopPropagation();">
					<img src="images/easter-eggs/article.png" alt="Easter Egg" data-toggle="popover" data-placement="top" data-content="Tourist Attacked"/>
					<p>Tourist Attacked</p>
				</a>

				<a class="easter-egg-button egg4" href="articles/washington-post/index.html" target="article-iframe-source" onclick="showArticle(); event.stopPropagation();">
					<img src="images/easter-eggs/article.png" alt="Easter Egg" data-toggle="popover" data-placement="top" data-content="Snails Treat Cancer"/>
					<p>Snails Treat Cancer</p>
				</a>
			</div>
<?php
}

function writeVRIcon($diveLabel, $diveClass) {
?>
						<div class="vr-indicator">
							<img class="vr-icon" src="images/icons/vr.png" alt="VR - <?php echo $diveLabel?>" data-toggle="popover" data-placement="top" data-content="VR - <?php echo $diveLabel?>"/>
							<p class="vr-<?php echo $diveClass ?>-label"><?php echo $diveLabel?></p>
						</div>
<?php
}
?>
