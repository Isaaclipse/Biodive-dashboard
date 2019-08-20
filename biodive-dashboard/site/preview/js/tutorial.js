let viewTutorials = 1;
let currentTutorialPage = viewTutorials;

$(document).ready(() => {

  // ************************************
  // PAGE NUMBER 1
  // ************************************
  $(`.incorrect-1 img`).hide();
  $(`.correct-1 img`).hide();
  $(`.incorrect-2 img`).hide();
  $(`.correct-2 img`).hide();

  $(`.wrongAnswer-1`).on(`click`, () => {
    $(`.incorrect-1 img`).show();
  });

  $(`.wrongAnswer-2`).on(`click`, () => {
    $(`.incorrect-2 img`).show();
  });

  // IF THE FIRST QUESTIONS IS ANSWERED FIRST
  $(`.rightAnswer-1`).on(`click`, () => {
    $(`.correct-1 img`).show();
    $(`.rightAnswer-2`).on(`click`, () => {
      $(`.correct-2 img`).show();
      setTimeout(() => {
        $(`#page-1`).hide();
        $(`#page-2`).show();
      }, 1000);
    });
  });

  // IF THE SECOND QUESTIONS IS ANSWERED FIRST
  $(`.rightAnswer-2`).on(`click`, () => {
    $(`.correct-2 img`).show();
    $(`.rightAnswer-1`).on(`click`, () => {
      $(`.correct-1 img`).show();
      setTimeout(() => {
        $(`#page-1`).hide();
        $(`#page-2`).show();
      }, 1000);
    });
  });

  // ************************************
  // PAGE NUMBER 2
  // ************************************
  $(`#page-2 .next`).on(`click`, () => {
    setTimeout(() => {
      $(`#page-2`).hide();
      $(`#page-3`).show();
      $(`.incorrect`).hide();
      $(`.correct`).hide();
    }, 1000);
  });

  // ************************************
  // PAGE NUMBER 3
  // ************************************
  $(`.wrongAnswer-3`).on(`click`, () => {
    $(`.incorrect`).show();
  });

  $(`.rightAnswer-3`).on(`click`, () => {
    $(`.correct`).show();
    setTimeout(() => {
      $(`#page-3`).hide();
      $(`#page-4`).show();
      $(`.correct`).hide();
      $(`.incorrect-4-1`).hide();
      $(`.incorrect-4-2`).hide();
    }, 1000);
  });

  // ************************************
  // PAGE NUMBER 4
  // ************************************
  $(`.wrongAnswer-4-1`).on(`click`, () => {
    $(`.incorrect-4-1`).show();
  });

  $(`.wrongAnswer-4-2`).on(`click`, () => {
    $(`.incorrect-4-2`).show();
  });

  $(`.rightAnswer-4`).on(`click`, () => {
    $(`.correct`).show();
    setTimeout(() => {
      $(`#page-4`).hide();
      $(`#page-5`).show();
      $(`.correct`).hide();
      $(`.incorrect`).hide();
    }, 1000);
  });

  // ************************************
  // PAGE NUMBER 5
  // ************************************
  $(`.wrongAnswer-5`).on(`click`, () => {
    $(`.incorrect`).show();
  });

  $(`.rightAnswer-5`).on(`click`, () => {
    $(`.correct`).show();
    setTimeout(() => {
      $(`#page-5`).hide();
      $(`#page-6`).show();
      $(`.incorrect`).hide();
      $(`.correct`).hide();
    }, 1000);
  });

  // ************************************
  // PAGE NUMBER 6
  // ************************************
  $(`.wrongAnswer-6`).on(`click`, () => {
    $(`.incorrect`).show();
  });;

  $(`.rightAnswer-6`).on(`click`, () => {
    $(`.correct`).show();
    setTimeout(() => {
      $(`#page-6`).hide();
      $(`#page-7`).show();
      $(`.correct`).hide();
    }, 1000);
  });

  // ************************************
  // PAGE NUMBER 7;
  // ************************************
  $(`.answer-7`).on(`click`, () => {
    $(`.correct`).show();
    setTimeout(() => {
      $(`#page-7`).hide();
      $(`#page-8`).show();
      $(`.incorrect`).hide();
      $(`.correct`).hide();
    }, 1000);
  });

  // ************************************
  // PAGE NUMBER 8
  // ************************************
  $(`.wrongAnswer-8`).on(`click`, () => {
    $(`.incorrect`).show();
  });

  $(`.rightAnswer-8`).on(`click`, () => {
    $(`.correct`).show();
    setTimeout(() => {
      $(`#page-8`).hide();
      $(`#page-9`).show();
      $(`.incorrect`).hide();
      $(`.correct`).hide();
    }, 1000);
  });

  // ************************************
  // PAGE NUMBER 9
  // ************************************
  $(`.wrongAnswer-9`).on(`click`, () => {
    $(`.incorrect`).show();
  });

  $(`.rightAnswer-9`).on(`click`, () => {
    $(`.correct`).show();
    setTimeout(() => {
      $(`#page-9`).hide();
      $(`#page-10`).show();
      $(`.incorrect`).hide();
      $(`.correct`).hide();
    }, 1000);
  });

  // ************************************
  // PAGE NUMBER 10
  // ************************************
  $(`.wrongAnswer-10`).on(`click`, () => {
    $(`.incorrect`).show();
  });

  $(`.rightAnswer-10`).on(`click`, () => {
    $(`.correct`).show();
    setTimeout(() => {
      $(`#page-10`).hide();
      $(`#page-11`).show();
      $(`.incorrect`).hide();
      $(`.correct`).hide();
    }, 1000);
  });

  // ************************************
  // PAGE NUMBER 11
  // ************************************
  $(`.wrongAnswer-11`).on(`click`, () => {
    $(`.incorrect`).show();
  });

  $(`.rightAnswer-11`).on(`click`, () => {
    $(`.correct`).show();
    setTimeout(() => {
      $(`#page-11`).hide();
      $(`#page-12`).show();
      $(`.incorrect`).hide();
      $(`.correct`).hide();
    }, 1000);
  });

  // ************************************
  // PAGE NUMBER 12
  // ************************************
  $(`.wrongAnswer-12`).on(`click`, () => {
    $(`.incorrect`).show();
  });

  $(`.rightAnswer-12`).on(`click`, () => {
    $(`.correct`).show();
    setTimeout(() => {
      $(`#page-12`).hide();
      $(`#page-13`).show();
      $(`.incorrect`).hide();
      $(`.correct`).hide();
      $(`.next-button`).show();
    }, 1000);
  });

  // ************************************
  // SWITCH STATEMENT THAT HIDES
  // ************************************
  switch (currentTutorialPage) {
    case viewTutorials:
      {
        showTutorialInstructionPages();
        break;
      }
  }

  $('[data-toggle="popover"]').popover({
    trigger: 'hover',
    delay: {
      show: 10,
      hide: 1,
    },
    html: true,
  }).off('click');
});

// ********************************************************************
// A DURATION FUNCTION FOR THE NEXT BUTTON TO APPEAR IN ANY GIVING PAGE
// ********************************************************************
arrowDuration = () => {
  // HIDDING THE NEXT BUTTON FOR 10 SECONDS
  $(`.next-button`).hide();
  setTimeout(() => {
    $(`.next-button`).show();
  }, 10000);
};

// **************************************************************************
// FUNCTION THAT INDICATES WHICH ONE IS THE STARTING DIV FOR THE TUTORIAL.PHP
// **************************************************************************
showTutorialInstructionPages = () => {
  currentTutorialPage = viewTutorials;
  changeVRInstructions(1);
};

// *********************************************************************************
// A FUNCTION THAT GOES TO EVERY DIV THAT STARTS WITH `#page-` AND HIDES ALL OF THEM
// *********************************************************************************
changeVRInstructions = (page) => {
  for (var i = 1; i <= 13; i++) {
    if (page == i) {
      $(`#page-` + i).show();
      $(`#page-` + i).addClass(`active-marker`);
    } else {
      $(`#page-` + i).hide();
      $(`#page-` + i).removeClass(`active-marker`);
    }
  }
};
