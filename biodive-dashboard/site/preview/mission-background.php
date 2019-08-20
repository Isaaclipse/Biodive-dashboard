<?php
include_once 'php/helpers.php';
include_once 'php/vr-and-eggs.php';
standardHeader(true);?>
    <link rel="stylesheet" type="text/css" media="screen" href="css/global2.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/mission-background.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/vr-and-eggs.css">
</head>
<body>

  <div class="fixed-container yellow-folder opened-folder">

    <!-- FOLDER-CONTENTS -->
    <!-- ****************** -->
    <div class="folder-label">Mission Background</div>

    <!-- ARROW TO PREVIOUS -->
    <a href="tutorial.php" class="previous-page-arrow">
      <img src="images/arrow.png" alt="Previous Arrow">
    </a>

    <!-- ARROW TO CONTINUE -->
    <a href="#" class="next-button" style="z-index: 300; display: none;">
      <img src="images/arrow.png" alt="Next Arrow" />
    </a>
    <?php writeInitialClickToContinueArrow(".folder-left");?>

    <!-- PAGE NUMBER -->
    <div class="page-number">2</div>

    <!-- INFO-POST-IT -->
    <div class="folder-left" onclick="clickToContinueClicked('.folder-left');">
      <p>Welcome <?php showStudentName();?></p>
      <p>Your first mission is to investigate venomous marine snails and document your observations here in the S-Files.</p>
      <p>Click to watch the video on the right and then write down five questions you have about these mysterious creatures. </p>
    </div>

    <!-- ALERT ARROW -->
    <img class="alert-arrow " src="images/icons/alertarrow.png" alt="Alert Arrow">

    <!-- SNAIL PICTURE -->
    <a class="snail-picture" href="#">
      <div class="blue-box" onclick="showVideo('videos/two_cone_snails_eat_fish.mp4');">Tap to watch</div>
      <img src="images/snail-picture/1.png" alt="Snail Picture" onclick="showVideo('videos/two_cone_snails_eat_fish.mp4');" data-toggle="popover" data-placement="top" data-content="Tap to watch video"/>
    </a>

    <!-- MANDE'S IMAGE -->
    <div class="folder-left-img">
      <img class="mandy-img" src="images/scifriday.png" alt="Snail Picture"/>
    </div>

    <!-- ORANGE BOX FOR STATEMEMT -->
    <div class="orange-card">
      <p class="content">
        <strong>Did you see how those deadly creatures captured their <?php vocabularyWord("prey","noun","animal that is hunted and eaten by other animals."); ?>?</strong>
      </p>
    </div>

    <!-- BLUE BOX FOR QUESTINONS -->
    <div class="blue-card">
      <p class="card-question"><?php questionMarker("question-marker"); ?>
        Write down at least five questions you have about these
        <?php vocabularyWord("marine snails","noun","snails that live in saltwater, also called gastropods")?>
        and their environment.
      </p>
      <div class="all-questions">
        <ol class="questions">
          <?php for ($i = 1; $i <= 5; ++$i): ?>
            <li>
              <?php echo $i; ?>. <input id="question_line<?php echo $i; ?>" class="question" type="text" />
            </li>
          <?php endfor; ?>
        </ol>
      </div>
    </div>

    <!-- FB&I LOGO -->
    <img class="fbi-logo" src="images/fb&ilogo.png" alt="FB&I Logo" />

    <!-- NEWSPAPER -->
    <div class="newspaper-section">
      <img class="newspaper" src="images/newspapers/1.png" alt="Newspaper" />
    </div>
    <?php
    $content = <<<EOD
    Do you think you have what it takes?<br/>
    <br/>
    Let's head over to the VR experience...
EOD;
    writeEggAndVRInstructions("VIEW HUNT","hunt",$content);?>
    <?php writeArticlesIFrameDiv(); ?>
    <?php writeUIButtons(); ?>
    <?php addVideoOverlay("videos/two_cone_snails_eat_fish.mp4");?>
    <?php writeVocabDiv(); ?>
  </div>

  <script type="text/javascript">
    <?php enableQuestionMarkers() ?>
    <?php enableEnterToTab(); ?>
    <?php enableClickToContinue(); ?>
    <?php enablePopovers(); ?>
    <?php enableVocab(); ?>
    <?php enableArticles(); ?>
    <?php enableEasterEggs(); ?>
    trackPageUnload = () => {
      updateQuestion(1,true);
      updateQuestion(2,true);
      updateQuestion(3,true);
      updateQuestion(4,true);
      updateQuestion(5,true);
    }
    <?php enablePageLoadAndUnload(); ?>
    updateQuestion = (field, done) => {
      var value = $(`<div/>`).text($(`#question_line` + field).val()).html();
      $.ajax({
        url: `<?php echo $_SERVER['PHP_SELF']; ?>?marine_questions=` + field + `&result=` + value,
      });
      if (done) {
        $.ajax({
          url: `<?php echo $_SERVER['PHP_SELF']; ?>?marine_questions=` + field + `&result=---END---`,
        });
      }
    };
  </script>
  <script type="text/javascript" src="js/mission-background.js"></script>
  <script src="js/videoplayer.js"></script>
  <script type="text/javascript" src="js/scale.js"></script>.
</body>
</html>
