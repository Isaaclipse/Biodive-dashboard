$(document).ready(() => {

    let toolsCount = 0;
  
    //local variable for number of dive-tools correctly placed// 

    $('.sticker').draggable({ revert: 'invalid' });
    $('.question').droppable({
      accept: '.refractometer',
      drop: function (event, ui) {
        toolsCount++;
        var $this = $(this);
        $(this).find('.refractometer');
        draggedItem = ui.draggable;
        allQuestionsAnswerHandler(toolsCount);
        gravityEffectsOnStickersHandler($(event.target), draggedItem);
        console.log(toolsCount + " tool correct");
        $( '.refractometer' ).draggable({
          disabled: true
        })
      },
      });
    // All elements with class '.sticker' are draggable. //
    //The element with class '.question' is droppable and takes element id '.refractometer'.//
    //When refractometer is dropped, it is no longer draggable and stays fixed.//

    $('.question2').droppable({
      accept: '.ph-meter',
      drop: function (event, ui) {
        toolsCount++;
        $(this).find('.ph-meter');
        draggedItem = ui.draggable;
        allQuestionsAnswerHandler(toolsCount);
        gravityEffectsOnStickersHandler($(event.target), draggedItem);
        console.log(toolsCount + " tools correct");
        $( '.ph-meter' ).draggable({
          disabled: true
        })
        },
      });
      
  
    $('.question3').droppable({
      accept: '.temperature-probe',
      drop: function (event, ui) {
        toolsCount++;
        $(this).find('.temperature-probe');
        draggedItem = ui.draggable;
        allQuestionsAnswerHandler(toolsCount);
        gravityEffectsOnStickersHandler($(event.target), draggedItem);
        console.log(toolsCount + " tools correct");
        $( '.temperature-probe' ).draggable({
          disabled: true
        })
      },
      });
  
    $('.question4').droppable({
      accept: '.turbidity-tube',
      drop: function (event, ui) {
        toolsCount++;
        $(this).find('.turbidity-tube');
        draggedItem = ui.draggable;
        allQuestionsAnswerHandler(toolsCount);
        gravityEffectsOnStickersHandler($(event.target), draggedItem);
        console.log(toolsCount + " tools correct");
        $( '.turbidity-tube' ).draggable({
          disabled: true
        })
      },
      });

    $('.question5').droppable({
        accept: '.oxygen-probe',
        drop: function (event, ui) {
          toolsCount++;
          $(this).find('.oxygen-probe');
          draggedItem = ui.draggable;
          allQuestionsAnswerHandler(toolsCount);
          gravityEffectsOnStickersHandler($(event.target), draggedItem);
          console.log(toolsCount + " tools correct");
          $( '.oxygen-probe' ).draggable({
            disabled: true
          })
        },
      });
  
      $(".next-button").hide(); 
      $(".next-page-box").hide();
      
    });
  
  gravityEffectsOnStickersHandler = (event, draggedItem) => {
    let stickersNum = 0;
    let target = event;
    let basePosition = target.offset();
    let droppedDivPosition = draggedItem.offset();
  
    draggedItem.appendTo(target);
      draggedItem.css('position', 'absolute');
      draggedItem.css('top', '25%');
      draggedItem.css('left', '20%');
    };

  
  allQuestionsAnswerHandler = (stickersNum) => {
    if (stickersNum == 5) {
      $(".next-page-box").show();
      $(".next-button").show();
    }
  };
  
  //If the number of stickers is equal to 5, show a div for moving on to the next page//