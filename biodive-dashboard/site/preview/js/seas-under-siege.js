$(document).ready(()=> {

  $('.next-button').hide();
  $(`.click-to-continue-button img`).on(`click`, () => {
    $(`.next-button`).hide();
  });

  $(`.click-to-continue-button`).on('click', () => {
    $(`.next-button img`).hide();
  });

  $(`#organism-changes-question`).keyup(() => {
      updateQuestion(`organism-changes`, false);
      checkForSomethingToMarkAnswered($(`#organism-changes-question`),
      `organism-changes-question-marker`);
    }).keydown((event) => {
      enterToTab(event);
    });

  $(`#turbity-changes-question`).keyup(() => {
        updateQuestion(`turbity-changes`, false);
        checkForSomethingToMarkAnswered(
          $(`#turbity-changes-question`),
        `turbity-changes-question-marker`);
      }).keydown((event) => {
        enterToTab(event);
      });

  $(`#features-of-ecosystem-question`).keyup(() => {
        updateQuestion(`features-of-ecosystem`, false);
        checkForSomethingToMarkAnswered(
        $(`#features-of-ecosystem-question`),
        `features-of-ecosystem-question-marker`);
      }).keydown((event) => {
        enterToTab(event);
      });
});

checkForSomethingToMarkAnswered = (item, marker) => {
    if (item.val().length > 2) {
      questionMarkerComplete(marker);
    } else {
      questionMarkerIncomplete(marker);
    }

    checkAllAnswered();
  };

checkAllAnswered = () => {
      if (
        $(`#organism-changes-question`).val().length > 2 &&
        $(`#turbity-changes-question`).val().length > 2 &&
        $(`#features-of-ecosystem-question`).val().length > 2) {
        $(`.next-button`).show();
      } else {
        $(`.next-button`).hide();
      }
    };
