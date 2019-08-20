function calculateRatio(){
	/*
	console.log("window.devicePixelRatio: " + window.devicePixelRatio + " CHROME");
	console.log("window.devicePixelRatio: " + (window.outerWidth/window.innerWidth) + " SAFARI");
	console.log("window.innerWidth: " + window.innerWidth);
	console.log("window.innerHeight: " + window.innerHeight);
	console.log("window.screen.width: " + window.screen.width);
	console.log("window.screen.height: " + window.screen.height);
	*/
	var scrollbarPadding = 16; // Arbitraty size for scrollbar elements just so we can avoid having scrollbars
	var pixelRatio; // = window.devicePixelRatio;
//	if ( /^((?!chrome|android).)*safari/i.test(navigator.userAgent)) { // Since Safari is a pain, we can't use just window.devicePixelRatio;
		pixelRatio = (window.outerWidth/window.innerWidth);
//	}
	if(navigator.userAgent.indexOf("Firefox") != -1) {
		pixelRatio = window.devicePixelRatio; //window.screen.width/window.screen.height;
	}
	var width = (window.innerWidth - scrollbarPadding) * pixelRatio;
	var height = (window.innerHeight - scrollbarPadding) * pixelRatio;
	var widthRatio = width / 1280;
	var heightRatio = height / 720;
	/*
	console.log("widthRatio: " + widthRatio);
	console.log("heightRatio: " + heightRatio);
	*/
	var scaleValue = 1.0;
	if(widthRatio<heightRatio) {
		scaleValue = widthRatio;
	} else {
		scaleValue = heightRatio;
	}
	/*
	console.log("Going to scale to: " + (Math.floor(scaleValue*100)/100).toFixed(2));
	if(navigator.userAgent.indexOf("Firefox") == -1) {
		console.log("What about... ")
	}
	*/
	if(navigator.userAgent.indexOf("Firefox") == -1) {
		return (Math.floor(scaleValue*100)/100).toFixed(2);
	} else {
		// @todo Figure out what Firefox is doing...
		return 1;
	}
}

//$(".fixed-container").css("border", "1px solid yellow");

function changeScale(value) {
	var adjuster = $(".fixed-container");
	if(navigator.userAgent.indexOf("Firefox") == -1) {
//		adjuster.css("zoom", value);
		adjuster.css("transform", "scale(" + value + ")");
		adjuster.css("transform-origin", "top center");
	} else {
// Disable for Firefox, since it doesn't get the actual resolution when the display is not at 100%.
		console.log("Skipping Firefox! " + value);
//		adjuster.css("transform", "scale(" + value + ")");
//		adjuster.css("transform-origin", "top center");
	}
}
// Run at least once!
changeScale(calculateRatio());

// On Resize of the window, adjust the scale
$(window).resize(function(){
	changeScale(calculateRatio());
});

/* Thank God for https://stackoverflow.com/questions/28821880/dragging-elements-on-a-scaled-div */
if($.ui.ddmanager) {
	$.ui.ddmanager.prepareOffsets = function(t, event) {
		var i, j, m = $.ui.ddmanager.droppables[t.options.scope] || [], type = event ? event.type
				: null, list = (t.currentItem || t.element).find(
				":data(ui-droppable)").addBack();
		droppablesLoop: for (i = 0; i < m.length; i++) {
			var percent = calculateRatio();
			if (m[i].options.disabled
					|| (t && !m[i].accept.call(m[i].element[0],
							(t.currentItem || t.element)))) {
				continue;
			}
			for (j = 0; j < list.length; j++) {
				if (list[j] === m[i].element[0]) {
					m[i].proportions().height = 0;
					continue droppablesLoop;
				}
			}
			m[i].visible = m[i].element.css("display") !== "none";
			if (!m[i].visible) {
				continue;
			}
			if (type === "mousedown") {
				m[i]._activate.call(m[i], event);
			}
			m[i].offset = m[i].element.offset();
			m[i].proportions({
				width : m[i].element[0].offsetWidth * percent,
				height : m[i].element[0].offsetHeight * percent
			});
		}
	};
}

function dragFix(event, ui) { var percent = calculateRatio(); var changeLeft = ui.position.left - ui.originalPosition.left, newLeft = ui.originalPosition.left + changeLeft / percent, changeTop = ui.position.top - ui.originalPosition.top, newTop = ui.originalPosition.top + changeTop / percent; ui.position.left = newLeft; ui.position.top = newTop; }

function startFix(event, ui) {
	$( this ).attr( 'revertLeft', $(this).css('left'));
	$( this ).attr( 'revertTop',  $(this).css('top'));
	ui.position.left = 0;
	ui.position.top = 0;
	var element = $(this);
}

function resizeFix(event, ui) { var percent = calculateRatio(); var changeWidth = ui.size.width - ui.originalSize.width, newWidth = ui.originalSize.width + changeWidth / percent, changeHeight = ui.size.height - ui.originalSize.height, newHeight = ui.originalSize.height + changeHeight / percent;  ui.size.width = newWidth; ui.size.height = newHeight; }

function revertFix(validZone) {
	$( this ).animate( {
		left: $( this ).attr( 'revertLeft' ),
		top: $( this ).attr( 'revertTop' )
	}, 300 )
}

function revertFixOnlyIfInvalid(validZone) {
	if(validZone==false) {
		$( this ).animate( {
			left: $( this ).attr( 'revertLeft' ),
			top: $( this ).attr( 'revertTop' )
		}, 300 )
	}
}