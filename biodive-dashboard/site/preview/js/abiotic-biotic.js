var bioticCorrect=0;
var abioticCorrect=0;
// Made global variables for the number of correctly placed biotic objects and
// abiotic objects//

$(document).ready(() => {
  $( function() {
    $( ".draggable-biotic"  ).draggable({
      start: startFix,
      drag: dragFix,
      revert: revertFix
    });
    $( ".draggable-abiotic" ).draggable({
      start: startFix,
      drag: dragFix,
      revert: revertFix
    });
    $( ".droppable-biotic-bucket" ).droppable({
      accept: ".draggable-biotic",
      drop: function(event, ui) {
        if(bioticCorrect<5) {
          bioticCorrect=bioticCorrect+1

          if(abioticCorrect==5 && bioticCorrect==5) {
            $(".next-button").show();
            $(".next-page-box").show();
          }
        }
        ui['draggable'].removeClass('.draggable-biotic');
        let clone = ui['draggable'].clone();
        $(clone).appendTo($(this).parent())
        ui['draggable'].remove();
      }
    });

    $( ".droppable-abiotic-bucket" ).droppable({
      accept: ".draggable-abiotic",
      drop: function( event, ui )
      {
        if(abioticCorrect<5) {
          abioticCorrect=abioticCorrect+1;

          if(abioticCorrect==5 && bioticCorrect==5) {
            $(".next-button").show();
            $(".next-page-box").show();
          }
        }
        ui['draggable'].removeClass('.draggable-abiotic');
        let clone = ui['draggable'].clone();
        $(clone).appendTo($(this).parent())
        ui['draggable'].remove();
      },
    });

    $(".next-button").hide();
    $(".next-page-box").hide();

    // Made all biotic objects and abiotic objects draggable and the biotic bucket
    // image droppable,
    // If number of correctly dropped biotic objects in biotic bucket is less than
    // 5, add 1. Vice versa for abiotic objects in abiotic bucket.
    // AND, if number of correct abiotic objects equals 5 AND biotic objects is
    // equal to 5, show a div for the next page.
    // Remove '.draggable' class from the draggable ui object after its dropped into
    // the correct bucket.

    // Hide orange popup when either its div is clicked or its arrow//
    $( ".click-to-continue-button img , .orange-text-box").click(function() {
      $( ".orange-text-box" ).hide();
    });
  });
});
