<?php
include_once 'php/helpers.php';
standardHeader(true);?>
    <link rel="stylesheet" type="text/css" media="screen" href="css/global2.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/back-from-field.css">
</head>
<body>

  <div class="fixed-container no-folder closed-folder">

    <!-- ARROW TO PREVIOUS -->
    <a href="ecosystem.php" class="previous-page-arrow">
      <img src="images/arrow.png" alt="Previous Arrow">
    </a>

    <!-- ARROW TO CONTINUE -->
    <a href="#" class="next-button" style="z-index: 300;">
        <img src="images/arrow.png" alt="Next Arrow">
    </a>

		<!-- INFO MESSAGE -->
		<div class="folder-message">
			<p class="body-message">Welcome back, <?php showStudentName(); ?>.
      <br>
      <br>
			The seas are under <?php vocabularyWord("siege","noun","serious attack"); ?> and things are looking <?php vocabularyWord("dire","adjective","desperately urgent"); ?> for these venomous marine snails.
      <br>
      <br>
			What do we need to know about the snail's ecosystem to protect their environment?</p>
		</div>

		<!-- NEWSPAPER -->
		<div class="newspaper-section">
			<img class="newspaper" src="images/newspapers/2.png" alt="Newspaper" />
		</div>

    <!-- SECOND INFO MESSAGE  -->
    <div class="back-c"></div>
    <div class="second-info-message">
      <p class="message">
        While you were diving in the Caribbean,
        Dr. Big launched an all out assault on the seas just as
        scientists discovered a new coral trench with undescribed snail species.
      </p>
    </div>

		<?php writeVocabDiv(); ?>
  </div>
	<script type="text/javascript">
		<?php enablePopovers(); ?>
		<?php enableVocab(); ?>
	</script>
  <script type="text/javascript" src="js/scale.js"></script>.
	<script type="text/javascript" src="js/back-from-field.js"></script>
</body>
</html>
