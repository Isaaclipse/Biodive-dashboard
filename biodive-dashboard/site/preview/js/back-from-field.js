$(document).ready(() => {

  $(`.back-c`).hide();
  $(`.second-info-message`).hide();

  // CONTROLING EVERYTHING THROUGHT THE CLICK OF THE ARROW
  $(`.next-button`).on(`click`, () => {
    handleNextButtonClick();
    $(`.next-button`).off(`click`);
    $(`.next-button`).on(`click`, () => {
      secondInfoMessageHandler();
      $(`.next-button`).off(`click`);
      $(`.next-button`).on(`click`, () => {
        window.location.href = `seas-under-siege.php`;
      });
    });
  });
});

handleNextButtonClick = () => {
  $('.next-button').hide();
  setTimeout(() => {
    $('.next-button').show();
  }, 5000);
  $('.newspaper-section').show();
  anime({
    targets: '.newspaper',
    scale: [0, 1],
    rotate: '5turn',
    duration: 2000,
    easing: 'easeOutSine',
  });
};

secondInfoMessageHandler = () => {
  $(`.second-info-message`).show();
  $(`.back-c`).show();
  setTimeout(() => {
    $('.next-button').show();
  }, 5000);
};
