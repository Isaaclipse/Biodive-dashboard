let currentQuestion = 0;
let clickToContinueActive = false;
let questions = [
  'Where do producers like plants get their energy?',
  'Who is responsible for recycling material back to the producers?',
  'Algae is a small producer that lives inside a very important consumer in the reef, can you find which one?',
  'Other than the algae that lives inside coral, what is another microscopic producer?',
  'What do snails hide under while hunting their prey?',
  'What is the smallest consumer in this ecosystem?',
];

let answers = [
  'sun',
  'bacteria/decomposers',
  'coral',
  'phytoplankton',
  'sand',
  'zooplankton',
];

let correctResponse = [
  'Nice work!<br/><br/>The sun provides all of the original energy to the ecosystem.',
  'Well done!<br/><br/>These bacteria are decomposers that recycle material back to producers.',
  'Correct!<br/><br/>Coral is home to the small producer algae.',
  'Yes!<br/><br/>These phytoplankton are microscopic producers.',
  'Yes!<br/><br/>Sand is a good hiding spot for organisms to protect them from predators.',
  'Excellent!<br/><br/>This zooplankton is the smallest consumer that eats producers.',
];

$(document).ready(() => {
  $('.next-button').hide();
  displayQuestion();
  trackPageload();
});

answerQuestion = (which) => {
  if (clickToContinueActive) { return; }

  var response = '';
  $('.correct-prompt').off();
  $('.hint-prompt').hide();
  if (answers[currentQuestion] == which) {
    //$('.question-prompt').hide();
    questionMarkerComplete('question-marker');
    response = correctResponse[currentQuestion] + '<br/><span class=\'click-to-continue\'>Click to continue</span>';
    updateQuestion(currentQuestion + 1, 'CORRECT! ' + which, false);
    currentQuestion++;
    $('.correct-prompt').html('<p>' + response + '</p>');
    $('.correct-prompt').show();

    if (currentQuestion < answers.length) {
      clickToContinueActive = true;
      $('.correct-prompt').on('click', () => {
        displayQuestion();
        $('.question-prompt').toggleClass('blue-question');
      });
    } else {
      $('.question-prompt').hide();
      $('.correct-prompt').on('click', () => {
        showEndScreen();
      });
    }
  } else {
    updateQuestion(currentQuestion + 1, 'WRONG! ' + which, false);
    switch (which) {
      case 'sand':
        response = 'Sand is a good hiding spot for organisms';
        break;
      case 'sun':
        response = 'The sun provides all of the original energy to the ecosystem';
        break;
      case 'zooplankton':
        response = 'This zooplankton is the smallest consumer that eats producers';
        break;
      case 'phytoplankton':
        response = 'These phytoplankton are microscopic producers';
        break;
      case 'bacteria/decomposers':
        response = 'These bacteria are decomposers that recycle material back to producers';
        break;
      case 'seaweed':
        response = 'Seaweed are producer that are large algae';
        break;
      case 'coral':
        response = 'Coral is home to the small producer algae';
        break;
      case 'conus-geographus':
      case 'conus-marmoreous':
        response = 'This venomous cone snail is a secondary predator';
        break;
      case 'lobster':
        response = 'Lobsters are tertiary consumers who eat cone snails';
        break;
      case 'orange-croaker':
        response = 'Orange croakers are tertiary consumers who eat cone snails';
        break;
      case 'sea-turtle':
        response = 'Sea turtles are tertiary consumers who eat jellyfish and cone snails';
        break;
      case 'clownfish':
      case 'dusky-frillgoby':
      case 'angelfish':
        response = 'These fish are primary consumers who eat seaweed and other producers';
        break;
      case 'shark':
        response = 'Sharks are primary consumers who eat other producers';
        break;
      case 'periwinkle':
        response = 'Periwinkles are consumers who eat algae!';
        break;
    }
    response += ', try again.';
    $('.hint-prompt').html('<p>' + response + '</p>');
    $('.hint-prompt').show();
    setTimeout(() => {
      $('.hint-prompt').hide();
    }, 3000);
  }
};

showEndScreen = () => {
  $('.vr-instructions').show();
  setTimeout(() => {
    $('.next-button').show();
    $('.next-button').on('click', () => {
      window.location.href = `back-from-field.php`;
    });
  }, 5000);
};
