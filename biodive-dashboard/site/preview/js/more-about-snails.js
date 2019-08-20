let turbidityAnswered = false;
let clearOrTurbidAnswered = true;
let preyRightCount = 0;
let predatorRightCount = 0;

HandleCupClick = (cupIndex) => {

  let waterCup = $(`.water-cup:nth-child(` + (cupIndex + 1) + `) > img`);

  if (cupIndex == 0) {
    $(`.water-cup`).attr(`onclick`, null).css(`cursor`, `auto`);
    updateTurbidity(`correct`);
    questionMarkerComplete(`turbid-water-question-marker`);
    turbidityAnswered = true;
    checkIfAllAnswersAreDone();
  }else {
    waterCup.attr(`src`, `images/icons/incorrect.png`);
    waterCup.css(`cursor`, `auto`);
    waterCup.parent().attr(`onclick`, null);
    updateTurbidity(`wrong`);
  }

  waterCup.show();
};

HandleDoneNotesButtonClick = () => {
  $(`.index-card`).hide();
  $(`.vr-popup`).show();
};

preySelectHandler = (item) => {
  item.removeAttr('onclick');
  switch (item.data(`id`)) {
    case `dusky-frillgoby`:
    case `bearded-fireworm`:
    case `periwinkle`:
      preyRightCount++;
      updatePreyQuestion(`CORRECT! ` + item.data(`id`));
      item.addClass(`selectCheck`);
      item.parent().append(`<img src='images/icons/correct.png' class='answerMarker'>`);
      break;
    default:
      updatePreyQuestion(`WRONG! ` + item.data(`id`));
      item.addClass(`selectWrong`);
      item.parent().append(`<img src='images/icons/incorrect.png' class='answerMarker'>`);
      break;
  }

  if (preyRightCount === 3) {
    $(`.prey-drop span > img.selectSticker`).each((index, item) => {
      $(item).removeAttr('onclick');
      if (!$(item).hasClass(`selectCheck`)) {
        $(item).addClass(`notUsed`);
      }
    });

    questionMarkerComplete(`prey-drop-question-marker`);
    checkIfAllAnswersAreDone();
  }
};

predatorSelectHandler = (item) => {
  item.removeAttr('onclick');
  switch (item.data(`id`)) {
    case `sea-turtle`:
    case `lobster`:
      predatorRightCount++;
      updatePredatorQuestion(`CORRECT! ` + item.data(`id`));
      updatePreyQuestion(`CORRECT! ` + item.data(`id`));
      item.addClass(`selectCheck`);
      item.parent().append(`<img src='images/icons/correct.png' class='answerMarker'>`);
      break;
    default:
      updatePredatorQuestion(`WRONG! ` + item.data(`id`));
      item.addClass(`selectWrong`);
      item.parent().append(`<img src='images/icons/incorrect.png' class='answerMarker'>`);
      break;
  }

  if (predatorRightCount === 2) {
    $(`.predator-drop span > img.selectSticker`).each((index, item) => {
      $(item).removeAttr('onclick');
      if (!$(item).hasClass(`selectCheck`)) {
        $(item).addClass(`notUsed`);
      }
    });

    questionMarkerComplete(`predator-drop-question-marker`);
    checkIfAllAnswersAreDone();
  }
};

checkIfAllAnswersAreDone = () => {
  if (preyRightCount == 3 &&
      predatorRightCount == 2 &&
      turbidityAnswered &&
      clearOrTurbidAnswered) {
    $(`.next-button`).show();
    $(`img.next`).addClass('show');
  }
};
