$(document).ready(() => {

  let id;
  let evt;
  let stickersCount = 0;

  $('.next-button').hide();
  $(`.click-to-continue-button img`).on(`click`, () => {
    $(`.next-button`).hide();
  });

  $('.sticker').draggable({
    start: startFix,
    drag: dragFix,
    revert: revertFix
  });
  $('#primary-consumer').droppable({
    accept: '.primary-consumer',
    drop: function (event, ui) {
      stickersCount++;
      $(this).find('.primary-consumer');
      draggedItem = ui.draggable;
      promptingQuestionHandler(draggedItem);
      allQuestionsAnswerHandler(stickersCount);
      gravityEffectsOnStickersHandler($(event.target), draggedItem);
    },
  });

  $('#secondary-consumer').droppable({
    accept: '.secondary-consumer',
    drop: function (event, ui) {
      stickersCount++;
      $(this).find('.secondary-consumer');
      draggedItem = ui.draggable;
      promptingQuestionHandler(draggedItem);
      allQuestionsAnswerHandler(stickersCount);
      gravityEffectsOnStickersHandler($(event.target), draggedItem);
    },
  });

  $('#primary-producer').droppable({
    accept: '.primary-producer',
    drop: function (event, ui) {
      stickersCount++;
      $(this).find('.primary-producer');
      draggedItem = ui.draggable;
      promptingQuestionHandler(draggedItem);
      allQuestionsAnswerHandler(stickersCount);
      gravityEffectsOnStickersHandler($(event.target), draggedItem);
    },
  });

  $('#tertiary-consumer').droppable({
    accept: '.tertiary-consumer',
    drop: function (event, ui) {
      stickersCount++;
      $(this).find('.tertiary-consumer');
      draggedItem = ui.draggable;
      promptingQuestionHandler(draggedItem);
      gravityEffectsOnStickersHandler($(event.target), draggedItem);
    },
  });
});

promptingQuestionHandler = (draggedItem) => {
  if ($(draggedItem).data('response')) {
    $('.answer-prompt').html('<p class="message">' + $(draggedItem).data('response') + '</p>');
    $('.answer-prompt').stop(true, false).show().animate({
      opacity: 1,
    }, 1).animate({
      opacity: 1,
    }, 1000).animate({
      opacity: 0,
    }, 200).anim;
  }
};

gravityEffectsOnStickersHandler = (event, draggedItem) => {
  let stickersNum = 0;
  let target = event;
  let basePosition = target.offset();
  let droppedDivPosition = draggedItem.offset();

  draggedItem.appendTo(target);
  if (event.attr('id') == 'answer') {
    draggedItem.css('position', 'absolute');
    draggedItem.css('top', (droppedDivPosition.top - basePosition.top) + 'px');
    draggedItem.css('left', (droppedDivPosition.left - basePosition.left) + 'px');
  } else {
    draggedItem.css('position', 'relative');
    draggedItem.css('top', '');
    draggedItem.css('left', '');
  }
};

allQuestionsAnswerHandler = (stickerNum) => {
  if (stickerNum == 13) {
    questionMarkerComplete('food-chain');
    setTimeout(() => {
      showVideo();
    }, 2000);
    setTimeout(() => {
      $('.next-button').show();
    }, 9000);
  }
};
