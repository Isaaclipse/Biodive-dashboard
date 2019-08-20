let VIEW_MAINPAGE = 0;
let VIEW_NEWSPAPER = 1;
let VIEW_SLIDER1 = 2;
let currentView = VIEW_MAINPAGE;

$(document).ready(() => {

  $(`.click-to-continue-button img`).on(`click`, () => {
    $(`.alert-arrow`).addClass(`anim-alert-arrow`);
  });

  // CONTROLING EVERYTHING THROUGHT THE CLICK OF THE ARROW
  $(`.next-button`).on(`click`, () => {
    handleNextButtonClick();
    $(`.next-button`).off(`click`);
    $(`.next-button`).on(`click`, () => {
      showVRInstructionsPage();
      $(`.next-button`).off(`click`);
      $(`.next-button`).on(`click`, () => {
        window.location.href = `more-about-snails.php`;
      });
    });
  });

  // FIVE QUESTIONS FOR THE STUDENT
  $(`#question_line1`).keyup(() => {
    checkAllAnswered();
  }).keydown((event) => {
      enterToTab(event);
    });
  $(`#question_line2`).keyup(() => {
    checkAllAnswered();
  }).keydown((event) => {
      enterToTab(event);
    });
  $(`#question_line3`).keyup(() => {
    checkAllAnswered();
  }).keydown((event) => {
    enterToTab(event);
  });
  $(`#question_line4`).keyup(() => {
    checkAllAnswered();
  }).keydown((event) => {
    enterToTab(event);
  });
  $(`#question_line5`).keyup(() => {
    checkAllAnswered();
  }).keydown((event) => {
    enterToTab(event);
  });
});

checkAllAnswered = () => {
  if ($(`#question_line1`).val().length > 2 &&
      $(`#question_line2`).val().length > 2 &&
      $(`#question_line3`).val().length > 2 &&
      $(`#question_line4`).val().length > 2 &&
      $(`#question_line5`).val().length > 2) {
    questionMarkerComplete(`question-marker`);
    $(`.next-button`).show();
  } else {
    questionMarkerIncomplete(`question-marker`);
    $(`.next-button`).hide();
  }
};

handleNextButtonClick = () => {
  currentView = VIEW_NEWSPAPER;
  $(`.next-button`).hide();
  setTimeout(() => {
    $(`.next-button`).show();
  }, 5000);

  $(`.newspaper-section`).show();
  anime({
    targets: '.newspaper',
    scale: [0, 1],
    rotate: '5turn',
    duration: 2000,
    easing: 'easeOutSine',
  });
};

showVRInstructionsPage = () => {
  currentView = VIEW_SLIDER1;
  $(`.newspaper-section`).css({ display: `none` });
  $(`.vr-instructions`).show();
  $(`.next-button`).hide();
  setTimeout(() => {
    $(`.next-button`).show();
  }, 5000);
};
