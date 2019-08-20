$(document).ready(() => {

  let stickerCount = 0;

  $('.vocabulary').hide();
  $('.next-button').hide();
  $('.save-button').hide();

  $('#drawing-board').jqScribble({ backgroundColor: '#FF00FF00' });

  $(`.draggable`).draggable({
    revert: 'invalid',
  });
  $('.droppable').droppable({
    drop: function (event, ui) {
      var target = $(event.target);
      var basePosition = target.offset();
      var droppedDivPosition = $(ui.draggable).offset();

      $(ui.draggable).appendTo(target);
      if ($(target).attr('id') == 'answer') {
        $(ui.draggable).css('position', 'absolute');
        $(ui.draggable).css('top', (droppedDivPosition.top - basePosition.top) + 'px');
        $(ui.draggable).css('left', (droppedDivPosition.left - basePosition.left) + 'px');
        stickerCount++;
        if (stickerCount >= 7) {
          $('.save-button').show();
          $('.save-button').attr('onclick', 'saveImage()');
        }

      } else {
        $(ui.draggable).css('position', 'relative');
        $(ui.draggable).css('top', '');
        $(ui.draggable).css('left', '');
      }
    },
  });

  $('.save-button').on('click', () => {
    $('.button-area').hide();
  });

  $('#producer-question').keyup(() => {
    updateQuestion('producer', false);
    checkForSomethingToMarkAnswered($('#producer-question'), 'producer-question-marker');
  }).keydown((event) => {
    enterToTab(event);
  });

  $('#primary-consumer-question').keyup(() => {
    updateQuestion('primary-consumer', false);
    checkForSomethingToMarkAnswered($('#primary-consumer-question'), 'primary-consumer-question-marker');
  }).keydown((event) => {
    enterToTab(event);
  });

  $('#secondary-consumer-question').keyup(() => {
    updateQuestion('secondary-consumer', false);
    checkForSomethingToMarkAnswered($('#secondary-consumer-question'), 'secondary-consumer-question-marker');
  }).keydown((event) => {
    enterToTab(event);
  });

  $('#tertiary-consumer-question').keyup(() => {
    updateQuestion('tertiary-consumer', false);
    checkForSomethingToMarkAnswered($('#tertiary-consumer-question'), 'tertiary-consumer-question-marker');
  }).keydown((event) => {
    enterToTab(event);
  });
});

toggleDraw = () => {
  $('#drawing-board').data('jqScribble').brush.brushSize = 2;
  $('#drawing-board').data('jqScribble').brush.brushColor = '#000000';
  console.log('drwing tool');
  $('#pencil-button').addClass('highlighted');
  $('#eraser-button').removeClass('highlighted');
};

toggleErase = () => {
  $('#drawing-board').data('jqScribble').brush.brushSize = 16;
  $('#drawing-board').data('jqScribble').brush.brushColor = '#FFFFFF';
  console.log('CHANGE TO ERASER');
  $('#pencil-button').removeClass('highlighted');
  $('#eraser-button').addClass('highlighted');
};

clearDrawingBoard = () => {
  $('#drawing-board').data('jqScribble').clear();
};

checkForSomethingToMarkAnswered = (item, marker) => {
  if (item.val().length > 2) {
    questionMarkerComplete(marker);
  } else {
    questionMarkerIncomplete(marker);
  }

  checkAllAnswered();
};

checkAllAnswered = () => {
  if ($('#producer-question').val().length > 2 &&
  $('#primary-consumer-question').val().length > 2 &&
  $('#secondary-consumer-question').val().length > 2 &&
  $('#tertiary-consumer-question').val().length > 2) {
    if ($('.save-button').hasClass('clicked')) {
      $('.next-button').show();
    }
  }
};

checkDoneHandler = () => {
  if ($('.save-button').hasClass('clicked')) {
    if ($('#producer-question').val().length > 2 &&
    $('#primary-consumer-question').val().length > 2 &&
    $('#secondary-consumer-question').val().length > 2 &&
    $('#tertiary-consumer-question').val().length > 2) {
      $('.next-button').show();
    }
  }
};
