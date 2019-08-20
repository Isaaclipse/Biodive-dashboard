<?php
include_once 'php/helpers.php';
standardHeader(true);?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tutorial</title>
    <meta name="viewport" content="user-scalable=no, width=1280">
    <link rel="stylesheet" type="text/css" media="screen" href="css/global2.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/tutorial.css"/>
</head>
<body>

  <div class="fixed-container blue-folder closed-folder">

    <!-- FOLDER-CONTENTS -->
    <!-- ****************** -->
    <div class="folder-label">tutorial</div>
    <!-- ****************** -->

    <!-- TUTORIAL_01 -->
    <!-- ********************************************************************************************* -->
    <div id="page-1">
      <img class="bluecard" src="images/post-it/BlueCard.png" alt="Blue-colored box containing text">
      <div class="text">
        <p> <strong> Welcome to Biodive, Scientist.</strong> </p>
        <br>
        <p>For this mission you are part of the Field and Beaker Intelligators (F&BI).</p>
        <br>
        <p>You will use your VR goggles to make observations in the field and the digital science journal to collect your data.
        </p>
      </div>

      <div class="postitsize">
        <img class="yellowpostit" src="images/post-it/yellow.png" alt="Pink post it">
        <img class="pinkpostit" src="images/post-it/pink.png" alt="Yellow post it">
      </div>

      <div class="questions">
        <div class="question1">
          <p> What will you use to make observations?</p>
          <img class="headset-1" src="images/icons/Headset.png" alt="headset choice">
          <img class="folder-1" src="images/icons/dsj.png" alt="yellow opened folder">
          <div class="correct-1"> <img src="images/icons/correct.png" alt="Correct Icon"> </div>
          <div class="rightAnswer-1"></div>
          <div class="incorrect-1"> <img src="images/icons/incorrect.png" alt="Incorrect Icon"> </div>
          <div class="wrongAnswer-1"></div>
        </div>

        <div class="question2">
          <p>Where will you document observations?</p>
          <img class="headset-2" src="images/icons/Headset.png" alt="headset choice">
          <img class="folder-2" src="images/icons/dsj.png" alt="yellow opened folder">
          <div class="correct-2"> <img src="images/icons/correct.png" alt="Correct Icon"> </div>
          <div class="rightAnswer-2"></div>
          <div class="incorrect-2"> <img src="images/icons/incorrect.png" alt="Incorrect Icon"> </div>
          <div class="wrongAnswer-2"></div>
        </div>
      </div>
    </div>

    <!-- TUTORIAL_02A -->
    <!-- ********************************************************************************************* -->
    <div id="page-2">
      <div class="orange-Card">
        <div class="content">
          <p>You'll use this journal to document observations and answer questions.</p>
          <br>
          <p>Select the white arrow to move forward.</p>
        </div>
      </div>

      <div class="bluish-Card">
        <p class="header" >Show what you'll do to move to the next screen.</p>
      </div>
      <img class="next" src="images/arrow.png" alt="Arrow Picture">
    </div>

    <!-- TUTORIAL_02B -->
    <!-- ********************************************************************************************* -->
    <div id="page-3">
      <div class="orange-Card">
        <div class="content">
          <p>The white arrow only appears when you've answered all questions on the page.</p>
        </div>
      </div>

      <div class="bluish-Card">
        <p class="header" >If you can't move forward it's because: </p>
        <div class="dashed-p">
          <p>The journal is broken</p>
          <p>You did not answer all the questions</p>
        </div>
        <div class="correct"> <img src="images/icons/correct.png" alt="Correct Icon"> </div>
        <div class="rightAnswer-3"></div>
        <div class="incorrect"> <img src="images/icons/incorrect.png" alt="Incorrect Icon"> </div>
        <div class="wrongAnswer-3"></div>
      </div>
      <img class="next" src="images/arrow.png" alt="Arrow Picture">
    </div>

    <!-- TUTORIAL_03A -->
    <!-- ********************************************************************************************* -->
    <div id="page-4">
      <div class="orange-Card">
        <div class="content">
          <p> <span>Underlined words</span> have definitions, hover over to see.</p>
        </div>
      </div>

      <div class="bluish-Card">
        <p class="header" >Which word has a definition: </p>
        <div class="dashed-p">
          <p class="rightAnswer-4">
          <span id="turbid"><strong><?php vocabularyWord("turbid","adjective","cloudy or opaque"); ?></strong></span>
          </p>
          <p>clear</p>
          <p>water</p>
          <div class="correct"> <img src="images/icons/correct.png" alt="Correct Icon"> </div>
          <div class="incorrect-4-1"> <img src="images/icons/incorrect.png" alt="Incorrect Icon"> </div>
          <div class="wrongAnswer-4-1"></div>
          <div class="incorrect-4-2"> <img src="images/icons/incorrect.png" alt="Incorrect Icon"> </div>
          <div class="wrongAnswer-4-2"></div>
        </div>
      </div>
    </div>

    <!-- TUTORIAL_03B -->
    <!-- **************************************************************************** -->
    <div id="page-5">
      <div class="orange-Card">
        <div class="content">
          <p>All vocabulary words live here. <img src="images/icons/vocab.png" alt="Vocab Icon"> </p>
        </div>
      </div>

      <div class="bluish-Card">
        <p class="header" >Where will you find all vocab words? </p>
        <div class="dashed-p">
          <img class="answers" src="images/icons/vocab.png" alt="Vocab Icon">
          <img class="answers" src="images/icons/MailIcon.png" alt="Mail Icon">
          <div class="correct"> <img src="images/icons/correct.png" alt="Correct Icon"> </div>
          <div class="rightAnswer-5"></div>
          <div class="incorrect"> <img src="images/icons/incorrect.png" alt="Incorrect Icon"> </div>
          <div class="wrongAnswer-5"></div>
        </div>
      </div>
    </div>

    <!-- TUTORIAL_04 -->
    <!-- **************************************************************************** -->
    <div id="page-6">
      <div class="orange-Card">
        <img class="vrIcon" src="images/icons/vr.png" alt="VR Icon">
        <div class="content">
          <div class="orange"><p>View Hunt</p></div>
          <p>When you see the VR icon,</p>
          <p>the label on top tells you which scene to visit.</p>
        </div>
      </div>

      <div class="bluish-Card">
        <p class="header">Click on the place that tells you which scene to visit next in VR.</p>
        <img class="vrIcon" src="images/icons/vr.png" alt="VR Icon">
        <div class="orange"><p>View Hunt</p></div>
        <div class="rightAnswer-6"></div>
        <div class="wrongAnswer-6"></div>
        <div class="correct"> <img src="images/icons/correct.png" alt="Correct Icon"> </div>
        <div class="incorrect"> <img src="images/icons/incorrect.png" alt="Incorrect Icon"> </div>
      </div>
    </div>

    <!-- TUTORIAL_05 -->
    <!-- **************************************************************************** -->
    <div id="page-7">
      <img src="images/post-it/blue.png" alt="Blue Poster Icon">
      <div class="info-post-it">
        <p>Click the button that you think will help you move around and select things in VR.</p>
        <img src="images/icons/Headset.png" alt="Headset Icon">
      </div>
      <div class="answer-7"></div>
      <div class="correct"> <img src="images/icons/correct.png" alt="Correct Icon"> </div>
    </div>

    <!-- TUTORIAL_06A -->
    <!-- **************************************************************************** -->
    <div id="page-8">
      <div class="orange-Card">
        <div class="content">
          <p>Holding the button down moves you forward.</p>
        </div>
      </div>

      <div class="blue-PostIt">
        <img src="images/post-it/blue.png" alt="Blue Poster Icon">
        <div class="info-post-it">
          <img src="images/icons/vr-button.png" alt="VR-Button Image">
        </div>
      </div>

      <div class="bluish-Card">
        <p class="header">How do you move forward?</p>
        <div class="dashed-p">
          <p>Hold down button</p>
          <p>Click button quickly</p>
        </div>
        <div class="correct"> <img src="images/icons/correct.png" alt="Correct Icon"> </div>
        <div class="rightAnswer-8"></div>
        <div class="incorrect"> <img src="images/icons/incorrect.png" alt="Incorrect Icon"> </div>
        <div class="wrongAnswer-8"></div>
      </div>
    </div>

    <!-- TUTORIAL_06B -->
    <!-- **************************************************************************** -->
    <div id="page-9">
      <div class="orange-Card">
        <div class="content">
          <p>When the orange dot turns into a circle, tap the button to select the object.</p>
        </div>
      </div>

      <div class="blue-PostIt">
        <img src="images/post-it/blue.png" alt="Blue Poster Icon">
        <div class="info-post-it">
          <img src="images/icons/vr-button.png" alt="VR-Button Image">
        </div>
      </div>

      <div class="green-Card">
        <p class="header">Which one shows an item that can be selected?</p>
        <div class="reticles">
          <img class="closed-reticle" src="images/reticle-closed.jpg" alt="Closed reticle screenshot">
          <img class="opened-reticle"   src="images/reticle-opened.jpg" alt="Opened reticle screenshot">
        </div>
        <div class="correct"> <img src="images/icons/correct.png" alt="Correct Icon"> </div>
        <div class="rightAnswer-9"></div>
        <div class="incorrect"> <img src="images/icons/incorrect.png" alt="Incorrect Icon"> </div>
        <div class="wrongAnswer-9"></div>
      </div>
    </div>

    <!-- TUTORIAL_07 -->
    <!-- **************************************************************************** -->
    <div id="page-10">
      <div class="orange-Card">
        <div class="content">
          <p>If you get to the VR icon <img class="vr" src="images/icons/vr.png" alt="VR Image"> before you have
          goggles, click this icon <img class="easter-egg" src="images/easter-eggs/divedeeper.png" alt="Star Icon"> to dive deeper.</p>
        </div>
      </div>

      <div class="bluish-Card">
        <p class="header">Click which icon to dive deeper?</p>
        <img class="startIcon" src="images/easter-eggs/divedeeper.png" alt="Star Icon">
        <img class="vrIcon" src="images/icons/vr.png" alt="VR Image">
        <div class="correct"> <img src="images/icons/correct.png" alt="Correct Icon"> </div>
        <div class="rightAnswer-10"></div>
        <div class="incorrect"> <img src="images/icons/incorrect.png" alt="Incorrect Icon"> </div>
        <div class="wrongAnswer-10"></div>
      </div>
    </div>

    <!-- TUTORIAL_08A -->
    <!-- **************************************************************************** -->
    <div id="page-11">
      <div class="blue-PostIt">
        <img src="images/post-it/blue.png" alt="Blue Poster Icon">
        <div class="info-post-it">
          <img src="images/icons/Headset.png" alt="Headset Icon">
        </div>
      </div>

      <div class="orange-Card">
        <div class="content">
          <p>Please look up, down, and all around.</p>
          <br>
          <p>Please do NOT look up and down <strong>quickly</strong>.</p>
        </div>
      </div>

      <div class="bluish-Card">
        <p class="header" >What is something you should do in VR?</p>
        <div class="dashed-p">
          <p>Look around smoothly</p>
          <p>Look up & down quickly</p>
        </div>
        <div class="correct"> <img src="images/icons/correct.png" alt="Correct Icon"> </div>
        <div class="rightAnswer-11"></div>
        <div class="incorrect"> <img src="images/icons/incorrect.png" alt="Incorrect Icon"> </div>
        <div class="wrongAnswer-11"></div>
      </div>
    </div>

    <!-- TUTORIAL_08B -->
    <!-- **************************************************************************** -->
    <div id="page-12">
      <div class="blue-PostIt">
        <img src="images/post-it/blue.png" alt="Blue Poster Icon">
        <div class="info-post-it">
          <img src="images/icons/Headset.png" alt="Headset Icon">
        </div>
      </div>

      <div class="orange-Card">
        <div class="content">
          <p>To move around in VR hold button.</p>
          <br>
          <p>But please do <strong>NOT WALK</strong> around.</p>
        </div>
      </div>

      <div class="green-Card">
        <p class="header" >How do you move around in VR?</p>
        <div class="dashed-p">
          <p>Hold down the button</p>
          <p>Walk around with your body</p>
        </div>
        <div class="correct"> <img src="images/icons/correct.png" alt="Correct Icon"> </div>
        <div class="rightAnswer-12"></div>
        <div class="incorrect"> <img src="images/icons/incorrect.png" alt="Incorrect Icon"> </div>
        <div class="wrongAnswer-12"></div>
      </div>
    </div>

    <!-- TUTORIAL_09 -->
    <!-- **************************************************************************** -->
    <div id="page-13">
      <img src="images/post-it/pink.png" alt="Pink Poster Icon">
      <div class="info-post-it">
        <p>Do you think you're up for the task? Click the arrow to begin!</p>
      </div>
    </div>

    <?php writeUIButtons(); ?>
    <?php writeForwardPageArrow(false);?>
    <?php writeVocabDiv(); ?>
    <?php enableVocab(); ?>
  </div>
  <script type="text/javascript"> 
      <?php enableVocab(); ?>
      <?php enablePopovers(); ?>
  </script>
  <script type="text/javascript" src="js/scale.js"></script>
  <script type="text/javascript" src="js/tutorial.js"></script>
</body>
</html>
