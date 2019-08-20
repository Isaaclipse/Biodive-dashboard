$(document).ready(() => {
  let zonesCorrect = 0;

  $('.next-button img').hide();
  $(`.click-to-continue-button img`).on('click', () => {
    $(`.next-button img`).hide();
  });

  $(`.click-to-continue-button`).on('click', () => {
    $(`.next-button img`).hide();
  });

  $(`.draggable`).draggable({
    start: startFix,
    drag: dragFix,
    revert: revertFix
  });

  $(`.droppable`).droppable({
    classes: {
      'ui-droppable-hover': 'hover-zone',
    },
    drop: function (event, ui) {
      let dropZone = $(this).attr('id').substring(0, $(this).attr('id').indexOf('-'));
      let label = ui['draggable'].attr('id').substring(0, ui['draggable'].attr('id').indexOf('-'));

      if (dropZone == label) {
        ui['draggable'].remove();
        let clone = ui['draggable'].clone();
        clone.css("top","0").css("left","0");
        $(this).addClass('zone-correct');
        $(clone).appendTo($(this));
        zonesCorrect++;
        updateZoneDrop(`CORRECT! ` + label);
        if (zonesCorrect == 4) {
          enableQuestionAboutZone();
          questionMarkerComplete(`zone-drop-question-marker`);
        }
      } else {
        updateZoneDrop(`WRONG! ` + label + ` in ` + dropZone);
      }
    },
  });

  $(`#question`).keyup(() => {
    updateTextLength();
  }).keydown(() => {
      updateWriteIn(false);
    });
});

updateWriteIn = (done) => {
  let inputted = '';
  inputted += $('#question').val();
  let value = $('<div/>').text(inputted.trim()).html();
  updateZoneWriteIn(value, done);
};

updateTextLength = () => {
  console.log($(`#question`).val());
  if ($(`#question`).val().length > 2) {
    questionMarkerComplete('prey-drop-question-marker');
    $(`.next-button img`).show();
  } else {
    questionMarkerIncomplete(`prey-drop-question-marker`);
    $(`.next-button img`).hide();
  }
};

enableQuestionAboutZone = () => {
  setTimeout(() => {
    $('.zone-question-prompt').show();
    anime({
      targets: '.zone-question-prompt',
      scale: [0, 1],
      rotate: '2turn',
      duration: 1000,
      easing: 'easeOutSine',
    });
    $('.zone').on('click', function () {
        handleZoneResponse($(this));
      });
  }, 2000);
};

handleZoneResponse = (item) => {
  let zone = item.attr('id').substring(0, item.attr('id').indexOf('-'));
  if (zone == 'pelagic') {
    questionMarkerComplete(`zone-click-question-marker`);
    updateZoneChoice('CORRECT! ' + zone);
    $(`#` + zone + `-label`).append(
      `<img src='images/icons/correct.png' class='zone-answer-marker'>`
    );
    $(`.drag-instructions`).html(`<p></p>`);
    $('.end-screen').show();
  } else {
    updateZoneChoice(`WRONG! ` + zone);
    $(`#` + zone + `-label`).append(
      `<img src='images/icons/incorrect.png' class='zone-answer-marker'>`
    );
  }
};
