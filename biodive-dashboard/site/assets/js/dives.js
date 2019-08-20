// Refresh
var refreshTime = -1;
var refreshInterval;

// Sorting
var userdToggled = false;
var sortDirection = 0;
var lastField = "";

// Dive Data
var divesCount = 0;
var dive = [];
var lastDiveCheck = "0";
var lastTaggedItemCheck = "0";

$(function() {
	getDivesData();
	$("#refresh").click(function() { getDivesData(); });

	$('.dropdown-toggle').dropdown();
	$('.dropdown-menu a').on('click', function(){
		var dropdown = $(this).parents('.dropdown').find('.dropdown-toggle');
		dropdown.text( $(this).text() );

		if(dropdown.attr('id')=="dropdownRefreshRate") {
			refreshTime = $(this).data('value');
			if(refreshTime>0) {
				$("#dropdownRefreshRate").removeClass("btn-secondary");
				$("#dropdownRefreshRate").addClass("btn-warning");
			} else {
				$("#dropdownRefreshRate").removeClass("btn-warning");
				$("#dropdownRefreshRate").addClass("btn-secondary");
			}
			changeRefreshRate();
		}
	});
});

/* ---- Menus ---- */
function showMenu() {
	$("#loginBox").hide();
	$("#titleText").show();
	$("#titleText").text("Welcome, " + userName);
	$("#backButton").hide();
	$("#classResults").hide();
	$("#allDivesResult").hide();
	$("#lessonsDisplay").hide();
	$("#optionsDisplay").show();
}

function showClass() {
	$("#optionsDisplay").hide();
	$("#titleText").show();
	$("#titleText").text("Overview");
	$("#classResults").show();
	$("#allDivesResult").hide();
	$("#backButton").show();
}

function showShowStudent() {
	$("#optionsDisplay").hide();
	$("#titleText").show();
	$("#titleText").text("Results");
	$("#classResults").hide();
	$("#allDivesResult").show();
	$("#backButton").show();
}

function showLessons() {
	$("#optionsDisplay").hide();
	$("#titleText").show();
	$("#titleText").text("Username");
	getUsername();
	$("#lessonsDisplay").show();
	$("#backButton").show();
}

/* ---- Data ---- */
function checkDives() {
	$.ajax({
		url: apiSource + "dataCheck",
		dataType: "json"
	}).done(function(data){
		if(data["diveCheck"]!=lastDiveCheck || data["taggedItemCheck"]!=lastTaggedItemCheck) {
			getDivesData();
		}
		updateRefreshTime();
	});
}

function getDivesData() {
	$.ajax({
		url: apiSource + "diveData",
		dataType: "json"
	}).done(function(data){
		if(data.length==0) { return; }
		lastTaggedItemCheck = data["taggedItemCheck"];
		lastDiveCheck = data["diveCheck"];
		diveCount = data["diveCount"];
		dive = data["dives"];
		renderClassGrid();
		renderIndividualGrid();
	});
}

/* ---- Render Displays ---- */
function renderClassGrid() {
	var classResult = { "time": "# mins", "percent": "###%",
						"observed": [ [], [], [], [] ],
						"tagged": [ [], [], [], [] ]
	};
	var students = diveCount;
	var totalTime = 0;
	var totalDiveWithTime = 0;

	// Go through all dives, figure out what was observed and averages.
	dive.forEach(function (item) {
		var diveTime = "0";
		if(item.endTime!=null) {
			diveTime = ((item.endTime - item.startTime) / 10000000 ) ;
		}
		if(diveTime>0) {
			totalTime += diveTime;
			totalDiveWithTime ++;
		}
		item.tagged.forEach(function (tag) {
			if(tag.pyramidLocation>0) {
				if(classResult.tagged[tag.pyramidLocation-1].indexOf(tag.creatureName)==-1) {
					classResult.tagged[tag.pyramidLocation-1].push(tag.creatureName);
				}
			}
		});
	})

	classResult.time = formatSecondsToMinutes(totalTime/totalDiveWithTime);

	// Display class results
	var content = $("<div/>");
	//content.append('<div><div class="nameGroup"></div><div class="timeGroup">Time</div><div class="tropicGroup">Trophic Levels</div><div class="formativeAssessmentGroup">Formative Assessment</div></div>');
	content.append('<div/>');

	var header = $('<div class="headerRow"/>');
	header.append('<div id="overviewNameHeader" class="blue-cell resultHeader nameCell"><p class="headerText"><img src="assets/images/students.png" width="98" height="38"/></p></div>');
	header.append('<div id="overviewTimeHeader" class="green-cell resultHeader timeCell"><p class="headerText"><img src="assets/images/time.png" width="55" height="55"/></p></div>');
	// Tagged
	header.append('<div id="overviewLevel1Header" class="brown-cell resultHeader levelCell"><p class="headerText"><img src="assets/images/FoodPyramidLevel1.png" width="60" height="53"/><p></div>');
	header.append('<div id="overviewLevel2Header" class="brown-cell-alt resultHeader levelCell"><p class="headerText"><img src="assets/images/FoodPyramidLevel2.png" width="60" height="53"/><p></div>');
	header.append('<div id="overviewLevel3Header" class="brown-cell resultHeader levelCell"><p class="headerText"><img src="assets/images/FoodPyramidLevel3.png" width="60" height="53"/><p></div>');
	header.append('<div id="overviewLevel4Header" class="brown-cell-alt resultHeader levelCell"><p class="headerText"><img src="assets/images/FoodPyramidLevel4.png" width="60" height="53"/><p></div>');
	// Formative Assessment
	header.append('<div id="overviewFaHeader" class="blue-cell resultHeader faCell"><p class="headerText"><img src="assets/images/questions.png" width="88" height="56"/><p></div>');

	var results = $('<div class="resultRow"/></div>');
	results.append('<div class="blue-cell nameCell"><a href="javascript:showShowStudent();">' + students + '</a></div>');
	results.append('<div class="green-cell timeCell">' + classResult.time + '</div>');
	// Tagged
	results.append('<div class="brown-cell-alt levelCell">' + joinWithCount(classResult.tagged[0]) + '</div>');
	results.append('<div class="brown-cell levelCell">' + joinWithCount(classResult.tagged[1]) + '</div>');
	results.append('<div class="brown-cell-alt levelCell">' + joinWithCount(classResult.tagged[2]) + '</div>');
	results.append('<div class="brown-cell levelCell">' + joinWithCount(classResult.tagged[3]) + '</div>');

	// Follow up questions (should be based on what they saw...
	var followUp = $('<div class="followUpQuestions blue-cell"></div>');
	if(classResult.tagged[0].length>0) {
		followUp.append('<p>What is one organism that you think is a producer? Why?</p>');
	}
	if(classResult.tagged[1].length>0) {
		followUp.append('<p>What is one organism that you think is a primary consumer? Why?</p>');
	}
	if(classResult.tagged[2].length>0) {
		followUp.append('<p>What is one organism that you think is a secondary consumer? Why?</p>');
	}
	if(classResult.tagged[3].length>0) {
		followUp.append('<p>What is one organism that you think is a tertiary consumer? Why?</p>');
	}
	if(classResult.tagged[2].filter(function(value) { return /Conus/.test(value)}).length>0) {
		followUp.append('<p>What role do you think venomous marine snails play in this ecosystem? Why?</p>');
	}
	if(classResult.tagged[3].length>0) {
		followUp.append('<p>What organisms do you think eat venomous marine snails?</p>');
	}
	results.append(followUp);

	// Mash it together...
	content.append(header);
	content.append(results);
	$("#classResults").html(content);
}

function renderIndividualGrid() {
	var content = $("<div/>");

	var header = $('<div class="headerRow"/>');
	header.append('<div id="nameHeader" class="blue-cell resultHeader nameCell" onclick="javascript:sortBy(\'name\');"><p class="headerText"><img src="assets/images/student.png" width="48" height="42"/></p></div>');
	header.append('<div id="timeHeader" class="green-cell resultHeader timeCell" onclick="javascript:sortBy(\'time\');"><p class="headerText"><img src="assets/images/time.png" width="55" height="55"/></p></div>');
	// Tagged
	header.append('<div id="level1Header" class="brown-cell resultHeader levelCell" onclick="javascript:sortBy(\'level1\');"><p class="headerText"><img src="assets/images/FoodPyramidLevel1.png" width="60" height="53"/><p></div>');
	header.append('<div id="level2Header" class="brown-cell resultHeader levelCell" onclick="javascript:sortBy(\'level2\');"><p class="headerText"><img src="assets/images/FoodPyramidLevel2.png" width="60" height="53"/><p></div>');
	header.append('<div id="level3Header" class="brown-cell resultHeader levelCell" onclick="javascript:sortBy(\'level3\');"><p class="headerText"><img src="assets/images/FoodPyramidLevel3.png" width="60" height="53"/><p></div>');
	header.append('<div id="level4Header" class="brown-cell resultHeader levelCell" onclick="javascript:sortBy(\'level4\');"><p class="headerText"><img src="assets/images/FoodPyramidLevel4.png" width="60" height="53"/><p></div>');
	// Formative Assessment
	header.append('<div id="faHeader" class="blue-cell resultHeader faCell"><p class="headerText"><img src="assets/images/questions.png" width="77" height="48"/><p></div>');
	content.append(header);

	var resultContainer = $('<div id="resultContainer"/>');
	var alternate = true;
	var diveCount = 0;
	dive.forEach(function (item) {
		var diveTime = "0";
		if(item.endTime!=null) {
			diveTime = ((item.endTime - item.startTime) / 10000000 ) ;
		}
		var diverName = (item.diverName!=null) ? item.diverName : item.diveId;

		var taggedLevel1 = writeOutTaggedCreatures(item.tagged, 1)
		var taggedCount1 = countTaggedCreatures(item.tagged, 1);
		var taggedLevel2 = writeOutTaggedCreatures(item.tagged, 2)
		var taggedCount2 = countTaggedCreatures(item.tagged, 2);
		var taggedLevel3 = writeOutTaggedCreatures(item.tagged, 3)
		var taggedCount3 = countTaggedCreatures(item.tagged, 3);
		var taggedLevel4 = writeOutTaggedCreatures(item.tagged, 4)
		var taggedCount4 = countTaggedCreatures(item.tagged, 4);

		var results = $('<div class="resultRow" id="userData' + diveCount + '" data-id="' + diveCount + '" data-name="' + $.trim(diverName).toUpperCase() + '" data-time="' + parseFloat(diveTime).toFixed(2) + '" data-level1="' + taggedCount1 + '" data-level2="' + taggedCount2 + '" data-level3="' + taggedCount3 + '" data-level4="' + taggedCount4 + '"/>');
		results.append('<div class="blue-cell nameCell"><a onclick="javascript:toggleUser(' + diveCount + ');">' + diverName + '</a></div>');
		results.append('<div class="green-cell timeCell">' + formatSecondsToMinutes(diveTime) + '</div>');
		// Tagged
		results.append('<div class="brown-cell-alt levelCell">' + taggedLevel1 + '</div>');
		results.append('<div class="brown-cell levelCell">' + taggedLevel2 + '</div>');
		results.append('<div class="brown-cell-alt levelCell">' + taggedLevel3 + '</div>');
		results.append('<div class="brown-cell levelCell">' + taggedLevel4 + '</div>');

		// Follow up questions (should be based on what they saw...
		var followUp = $('<div class="followUpQuestions blue-cell"></div>');
		if(taggedLevel1!="none") {
			followUp.append('<p>Name is a producer.</p>');
		}
		if(taggedLevel2!="none") {
			followUp.append('<p>Name a primary consumer.</p>');
		}
		if(taggedLevel3!="none") {
			followUp.append('<p>Name a secondary consumer.</p>');
		}
		if(taggedLevel4!="none") {
			followUp.append('<p>Name a tertiary consumer.</p>');
		}
		if(taggedLevel3.indexOf("Conus")!=-1) {
			followUp.append('<p>What role do you think venomous marine snails play in this ecosystem? Why?</p>');
		}
		if(taggedLevel4!="none") {
			followUp.append('<p>What organisms do you think eat venomous marine snails?</p>');
		}

		diveCount++;
		// Mash it together...
		results.append(followUp);

		resultContainer.append(results);
		alternate = (alternate) ? false : true;
	})
	content.append(resultContainer);
	$("#allStudentsResults").empty();
	$("#allStudentsResults").html(content);
}

function formatSecondsToMinutes(diveTime) {
	var minutes = parseInt(diveTime / 60);
	var seconds = parseInt(diveTime % 60);

	if(minutes<1) {
		if(seconds<1) {
			return "";
		} else {
			return seconds + " sec";
		}
	}
    return minutes + ":" + ((seconds<10) ? "0" + seconds : seconds) + " min";
}

function joinWithCount(array) {
	var result = "";
	for(var count = 0; count<array.length; count++) {
		result += (count+1) + "-" + array[count] + "<br/>";
	}
	if(array.length==0) {
		result = "none";
	}
	return result;
}

function writeOutTaggedCreatures(tagged, levelToDisplay) {
	var content = "";
	var count = 0;
	tagged.forEach(function (tag){
		if(tag.pyramidLocation==levelToDisplay) {
			if(tag.creatureName=="Orange Groper") { tag.creatureName = "Orange Croaker"; } // @TODO Remove when Unity build changed
			if(tag.creatureName.indexOf("Coral")!=-1 && content.indexOf("Coral")!=-1) {
				content += "";
			} else {
				content += ++count + "-" + tag.creatureName + "<br/>";
			}
		}
	})
	if(content=="") { content = "none"; }
	return content;
}

function countTaggedCreatures(tagged, levelToDisplay) {
	var count = 0;
	tagged.forEach(function (tag){
		if(tag.pyramidLocation==levelToDisplay) {
			count++;
		}
	})
	return count;
}

/* ----- User ---- */
function toggleUser(id) {
	if(userdToggled) {
		$("#resultContainer > .resultRow").show();
		$("#resultContainer > .resultRow").removeClass("singleStudent");
		userdToggled = false;
	} else {
		$("#resultContainer > .resultRow").hide();
		$("#userData" + id).show();
		$("#userData" + id).addClass("singleStudent");
		userdToggled = true;
	}
}

/* ---- Sorting for class ---- */
function removeSortIcons(field) {
	$("#" + field + "Header").removeClass("sortUp");
	$("#" + field + "Header").removeClass("sortDown");
}

function sortBy(field) {
	var $divs = $("#resultContainer > .resultRow");

	removeSortIcons(field);
	if(lastField!=field) {
		removeSortIcons(lastField);
		direction = 0;
	}

	var direction;
	switch(sortDirection) {
		case 0:
			direction = 1;
			sortDirection = direction;
			$("#" + field + "Header").addClass("sortDown");
			break;
		case 1:
			direction = -1;
			sortDirection = direction;
			$("#" + field + "Header").addClass("sortUp");
			break;
		case -1:
			direction = 1;
			sortDirection = 0;
			removeSortIcons(field);
			field="id";
			break;
	}

	lastField = field;

	// Sort the divs
	var sorted = $divs.sort(function(a,b) {
		if($(a).data(field) == $(b).data(field)) {
			return 0;
		}
		return $(a).data(field) > $(b).data(field) ? direction : -1 * direction;
	});

	// Redisplay the divs
	$("#resultContainer").html( $divs);
}

/* ---- Refresh ---- */
function changeRefreshRate() {
	clearInterval(refreshInterval);
	if(refreshTime!=-1) {
		refreshInterval = setInterval(function() { checkDives(); }, refreshTime);
	}
}

function updateRefreshTime() { $("#updateTime").html("<i>Updated: " + new Date() + "</i>"); }
