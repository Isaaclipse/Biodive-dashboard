let SLIDER_LESS_PRODUCERS = -4;
let SLIDER_LESS_PRIMARY_CONSUMERS = -3;
let SLIDER_LESS_SECONDARY_CONSUMERS = -2;
let SLIDER_LESS_TERTIARY_CONSUMERS = -1;
let SLIDER_HOMEOSTASIS = 0;
let SLIDER_MORE_PRODUCERS = 1;
let SLIDER_MORE_PRIMARY_CONSUMERS = 2;
let SLIDER_MORE_SECONDARY_CONSUMERS = 3;
let SLIDER_MORE_TERTIARY_CONSUMERS = 4;
let sliderState = SLIDER_HOMEOSTASIS;
let numOfClicks = 0;
let textSource = '';

$(document).ready(() => {

  $(`.next-button`).hide();
  $('#image-info').hide();
  $('.info-post-it').hide();
  $('.darkness').hide();
  $('.content').html('');

  $('.biodiverity-info').on('click', () => {
    hideAllHandler();
  });

  $(`.click-to-continue-button`).on('click', () => {
    hideAllHandler();
  });

  // PRIMARY PRODUCER
  $('#slider-primary-producer .less').on('click', () => {
    checkForClicksHandler();
    removeAllDotsHandler();
    $('#slider-primary-producer .less').addClass('active');
    sliderState = SLIDER_LESS_PRODUCERS;
    changeSlidersHandler();
  });

  $('#slider-primary-producer .homeostasis').on('click', () => {
    checkForClicksHandler();
    removeAllDotsHandler();
    setHomeostatisHandler();
    sliderState = SLIDER_HOMEOSTASIS;
    changeSlidersHandler();
  });

  $('#slider-primary-producer .more').on('click', () => {
    checkForClicksHandler();
    removeAllDotsHandler();
    $('#slider-primary-producer .more').addClass('active');
    sliderState = SLIDER_MORE_PRODUCERS;
    changeSlidersHandler();
  });

  // PRIMARY CONSUMER
  $('#slider-primary-consumer .less').on('click', () => {
    checkForClicksHandler();
    removeAllDotsHandler();
    $('#slider-primary-consumer .less').addClass('active');
    sliderState = SLIDER_LESS_PRIMARY_CONSUMERS;
    changeSlidersHandler();

  });

  $('#slider-primary-consumer .homeostasis').on('click', () => {
    checkForClicksHandler();
    removeAllDotsHandler();
    setHomeostatisHandler();
    sliderState = SLIDER_HOMEOSTASIS;
    changeSlidersHandler();
  });

  $('#slider-primary-consumer .more').on('click', () => {
    checkForClicksHandler();
    removeAllDotsHandler();
    $('#slider-primary-consumer .more').addClass('active');
    sliderState = SLIDER_MORE_PRIMARY_CONSUMERS;
    changeSlidersHandler();
  });

  // SECONDARY CONSUMER
  $('#slider-secondary-consumer .less').on('click', () => {
    checkForClicksHandler();
    removeAllDotsHandler();
    $('#slider-secondary-consumer .less').addClass('active');
    sliderState = SLIDER_LESS_SECONDARY_CONSUMERS;
    changeSlidersHandler();
  });

  $('#slider-secondary-consumer .homeostasis').on('click', () => {
    checkForClicksHandler();
    removeAllDotsHandler();
    setHomeostatisHandler();
    sliderState = SLIDER_HOMEOSTASIS;
    changeSlidersHandler();
  });

  $('#slider-secondary-consumer .more').on('click', () => {
    checkForClicksHandler();
    removeAllDotsHandler();
    $('#slider-secondary-consumer .more').addClass('active');
    sliderState = SLIDER_MORE_SECONDARY_CONSUMERS;
    changeSlidersHandler();
  });

  // TERTIARY CONSUMER
  $('#slider-tertiary-consumer .less').on('click', () => {
    checkForClicksHandler();
    removeAllDotsHandler();
    $('#slider-tertiary-consumer .less').addClass('active');
    sliderState = SLIDER_LESS_TERTIARY_CONSUMERS;
    changeSlidersHandler();
  });

  $('#slider-tertiary-consumer .homeostasis').on('click', () => {
    checkForClicksHandler();
    removeAllDotsHandler();
    setHomeostatisHandler();
    sliderState = SLIDER_HOMEOSTASIS;
    changeSlidersHandler();
  });

  $('#slider-tertiary-consumer .more').on('click', () => {
    checkForClicksHandler();
    removeAllDotsHandler();
    $('#slider-tertiary-consumer .more').addClass('active');
    sliderState = SLIDER_MORE_TERTIARY_CONSUMERS;
    changeSlidersHandler();
  });
});

removeAllDotsHandler = () => {
  $('.dot').each((index, item) => {
    $('.dot').removeClass('active');
  });
};

setHomeostatisHandler = (skipThisRow) => {
  $('.dot.homeostasis').each((index, item) => {
    if ($(item).parent().parent().attr('id') != skipThisRow) {
      $(item).addClass('active');
    }
  });
};

checkForClicksHandler = () => {
  numOfClicks++;
  if (numOfClicks === 6) {
    $('.next-button').show();
  }
};

showingInfoPostIt = () => {
  setTimeout(() => {
    $('.info-post-it').show();
    $('.darkness').show();

    $('.info-post-it').on('click', () => {
      $('.info-post-it').hide();
      $('.darkness').hide();
    });
  }, 1000);
};

hideAllHandler = () => {
  anime({
    targets: '.biodiverity-info',
    scale: [3, 0],
    rotate: '5turn',
    duration: 2000,
    easing: 'easeOutSine',
  });
  $(`.click-to-continue-button`).hide();
  setTimeout(() => {
    $('.biodiverity-info').hide();
    $(`#click-to-continue`).css({
      display: 'none',
    });
  }, 2000);
};

changeSlidersHandler = () => {
  $('#image-info').show();
  switch (sliderState) {
    case SLIDER_LESS_PRODUCERS : {
      showingInfoPostIt();
      imageSource = 'images/biodiversity/less-producers.png';
      textSource = 'Fewer producers means less food for primary, secondary, and tertiary consumers. This leads to a population crash where all trophic levels can die out.';
      $('.answerImg').hide();
      break;
    }

    case SLIDER_MORE_PRODUCERS : {
      showingInfoPostIt();
      imageSource = 'images/biodiversity/more-producers.png';
      textSource = 'More producers mean more food for primary, secondary, and tertiary consumers.';
      $('.answerImg').hide();
      break;
    }

    case SLIDER_LESS_PRIMARY_CONSUMERS : {
      showingInfoPostIt();
      imageSource = 'images/biodiversity/less-primary.png';
      textSource = 'Fewer primary consumers means less food for secondary consumers leaving more producers. Producers would grow out of control.';
      $('.answerImg').hide();
      break;
    }

    case SLIDER_MORE_PRIMARY_CONSUMERS : {
      showingInfoPostIt();
      imageSource = 'images/biodiversity/more-primary.png';
      textSource = 'More primary consumers means more food for secondary consumers to eat but fewer primary producers. Because producers such as phytoplankton are responsible for 70% of the earth’s oxygen we would be in big trouble.';
      $('.answerImg').hide();
      break;
    }

    case SLIDER_LESS_SECONDARY_CONSUMERS : {
      showingInfoPostIt();
      imageSource = 'images/biodiversity/less-secondary.png';
      textSource = 'Fewer secondary consumers means less food for tertiary consumers. It also means there will be more primary consumers who will eat more of the primary producers.';
      $('.answerImg').hide();
      break;
    }

    case SLIDER_MORE_SECONDARY_CONSUMERS : {
      showingInfoPostIt();
      imageSource = 'images/biodiversity/more-secondary.png';
      textSource = 'More secondary consumers means more food for tertiary consumers. This also means fewer primary consumers as they are eaten by secondary consumers and again we are out of homeostasis.';
      $('.answerImg').hide();
      break;
    }

    case SLIDER_LESS_TERTIARY_CONSUMERS : {
      showingInfoPostIt();
      imageSource = 'images/biodiversity/less-tertiary.png';
      textSource = 'With fewer tertiary consumers there will be more secondary producers. Those secondary producers will eat more of the primary consumers who will eat fewer of the primary producers.';
      $('.answerImg').hide();
      break;
    }

    case SLIDER_MORE_TERTIARY_CONSUMERS : {
      showingInfoPostIt();
      imageSource = 'images/biodiversity/more-tertiary.png';
      textSource = 'More tertiary consumers means there will be fewer secondary consumers. This means there will be more primary consumers who are not eaten by the secondary consumers and again we’re out of homeostasis.';
      $('.answerImg').hide();
      break;
    }

    case SLIDER_HOMEOSTASIS: {
      showingInfoPostIt();
      imageSource = 'images/biodiversity/homeostasis.png';
      textSource = 'At this stage there is ecological stability, or homeostasis.';
      $('.answerImg').hide();

      $('#image-info').hide();
      $(`[data-toggle='popover']`).popover({
        trigger: 'hover',
        delay: {
          show: 2000,
          hide: 100,
        },
        html: true,
      });
      break;
    }
  }

  $('#biodiversity-image').attr('src', imageSource);
  $('.content').html(textSource);
};
