<?php
require_once 'assets/php/google_auth.php';

$isTesting = false;
if($_SERVER['REMOTE_ADDR']=="127.0.0.1" || $_SERVER['REMOTE_ADDR']=="::1") {
	$isTesting = true;
	$apiSource = "http://localhost:8888/digital-journal/api/";
} else {
	$apiSource = "https://dj.killersnails.com/api/";
}

$hasAccess = false;
$accessMessage = "";

if($googleLoggedIn) {
	$isKillerSnails = ($google_User["hd"]=="killersnails.com") ? true : false;
	$approvedEmails = array(
		"christopher_pollati@bloomfield.edu",
		"amandasolarsh@gmail.com",
		"hlappi23@gmail.com",
		"kschrier@gmail.com",
		"mitchell.rabinowitz@gmail.com",
		"mimi1880@aol.com",
		"lportnoy@gmail.com",
		"jessica.o.hendrix@gmail.com",
		"mande.holford@gmail.com",
		"amigaabattoir@gmail.com"
	);
	if(in_array(strtolower($google_User["email"]), $approvedEmails)) {
		$isKillerSnails = true;
	}

	if($isKillerSnails) {
		$hasAccess = true;
	} else {
		$accessMessage = "Sorry, you account under " + $googleUserEmail + " is not setup for access.";
	}
}
?>
<!doctype html>
<html lang="en">
<head>
	<title>BioDive: Digital Journal</title>
	<meta charset="utf-8">
	<meta name="description" content="BioDive Dashboard - Killer Snails">
	<link href="https://fonts.googleapis.com/css?family=Bevan|Raleway:400,400i,700,700i" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- JQuery -->
	<script type="text/javascript" src="//code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<!-- Bootstrap 4 -->
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<!-- Custom -->
	<link rel="stylesheet" href="assets/css/styles.css">
<?php if($hasAccess) { ?>
	<script type="text/javascript">
	var apiSource = "<?php echo $apiSource; ?>";
	var userName = "<?php echo $google_User["given_name"]; ?>";
	</script>
	<script type="text/javascript" src="assets/js/dives.js"></script>
<?php } ?>
</head>
<body>
	<div class="full-container titleBar">
		<img src="assets/images/BioDive_Logo.png" width="525" height="150" alt="BioDive Logo" class="logo"/>
		<p id="titleText" class="titleText"><?php if($hasAccess) { echo "Welcome, " . $google_User["given_name"]; } ?></p>
		<img id="backButton" src="assets/images/BD_Button_Back.png" width="125" height="125" alt="Back" class="backButton" style="display: none;" onclick="javascript:showMenu();"/>
		<br clear="all"/>
	</div>
<?php if($hasAccess==false) { ?>
<?php 		if($googleLoggedIn) {
			/* If Google Authorized, but not killersnails.com */?>
	<div class="full-container">
		<div id="loginBox" class="container clearfix">
			<div class="loginForm">
				<div class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none;">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<h2 class="form-signin-heading">SORRY</h2>
				<p>&nbsp;</p>
				<p>Sorry, you account under:</p>
				<p><?php echo $googleUserEmail ?></p>
				<p>is not setup for access.</p>
				<p>&nbsp;</p>
				<button type="button" class="form-logout"><a href="index.php?logout">Logout</a></button>
			</div>
		</div>
	</div>
<?php 		} else {
			/* If no access */ ?>
	<div class="full-container">
		<div id="loginBox" class="container clearfix">
			<div class="loginForm">
				<div class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none;">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<h2 class="form-signin-heading">LOGIN</h2>
				<p>&nbsp;</p>
				<h4>Welcome to the BioDive Dashboard.</h4>
				<p>&nbsp;</p>
				<p>Please log in with your Google account. Currently, this is only available for Killer Snails Team members.</p>
				<p>&nbsp;</p>
				<a href="<?php echo $authUrl; ?>"><img src="assets/images/google/btn_google_signin_dark_normal_web@2x.png" width="191" height="46"></a>
				<p>&nbsp;</p>
				<div id="loginMessage"></div>
			</div>
		</div>
	</div>
<?php 		} ?>
<?php } else { ?>
<?php /** ---- Options ---- */ ?>
	<div class="full-container">
<?php
/*
$service = new Google_Service_Classroom($client);
try {
	$results = $service->courses->listCourses(array('pageSize'=>10));
	if(count($results->getCourses())==0) {
?>
		<div id="classSelection">
			<button class="greenClassButton" onclick="javascript:showClass();">Demo Class</button>
		</div>
<?php
		echo "No courses...";
	} else {
		$buttonClasses = array( "greenClassButton", "blueClassButton", "yellowClassButton" );
		$buttonElement = 0;

		$courses = array();
		$courses = array_merge($courses, $results->courses);

		foreach ($courses as $course) {
?>
			<button class="<?php echo $buttonClasses[($buttonElement++%count($courses))]; ?>" onclick="javascript:showClass();"><?php echo $course->getName(); ?></button>
<?php
			echo "Class ID: [" . $course->getId() . "]";
			$studentResult = $service->courses_students->listCoursesStudents($course->getId());

			$students = array();
			$students = array_merge($students,$studentResult->students);

			foreach($students as $student) {
				echo $student->profile->name->fullName . "<br/>";
/ *				echo "<pre>";
				echo print_r($student);
				echo "</pre>";
* /
			}
		}
	}
} catch (Google_Service_Exception $e) {
	echo " NO ACCESS TO CLASSROOM! " . $e->getMessage();
?>
		<div id="classSelection">
			<button class="greenClassButton" onclick="javascript:showClass();">Demo Class</button>
		</div>
<?php
}
*/
?>
	</div>
	<div class="full-container">
		<div id="optionsDisplay" class="full-container">
			<div id="optionHolder">
				<button class="greenMenuButton" onclick="javascript:showClass();">Class Overview</button>
				<button class="blueMenuButton" onclick="javascript:showShowStudent();">Class Details</button>
				<button type="button" class="btn btn-danger mr-4"><a href="index.php?logout">Logout</a></button>
			</div>
		</div>
<?php /** ---- Class - Overall Results ---- */ ?>
		<div id="classResults" class="full-container" style="display: none;"></div>
<?php /** ---- Class - Student Results ---- */ ?>
		<div id="allDivesResult" style="display: none;">
			<div id="allStudentsResults" class="full-container data-dump"></div>
			<div id="dataGridDisplay" class="container">
				<div id="controls" class="row mb-2">
					<div class="col-md-12">
						<button id="refresh" type="button" class="btn btn-warning btn-sm float-left mr-4">Reload Data</button>
						<div class="dropdown float-left mr-4">
							<button id="dropdownRefreshRate" class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Manual Refresh</button>
							<div class="dropdown-menu" aria-labelledby="dropdownRefreshRate">
								<a class="dropdown-item" href="#" data-value="-1">Manual Refresh</a>
								<div id="ansoufnalf" class="dropdown-divider"></div>
								<a class="dropdown-item" href="#" data-value="60000">Every minute</a>
								<a class="dropdown-item" href="#" data-value="30000">Every 30 seconds</a>
								<a class="dropdown-item" href="#" data-value="10000">Every 10 seconds</a>
								<a class="dropdown-item" href="#" data-value="5000">Every 5 seconds</a>
								<a class="dropdown-item" href="#" data-value="1500">Every second</a>
							</div>
						</div>
						<span id="updateTime" class="mt-4 mt-sm-0 mb-2 mt-sm-0"></span>
						<button type="button" class="btn btn-danger mr-4 float-right"><a href="index.php?logout">Logout</a></button>
					</div>
				</div>
			</div>
		</div>
<?php /** ---- Student - Individual Result ---- */ ?>
		<div id="studentSelection" class="full-container" style="display: none;"></div>
<?php /** ---- Lessons ---- */ ?>
<?php /** ---- DEMO ONLY: For Username ---- */ ?>
		<div id="lessonsDisplay" class="container" style="display: none;">
			<div class="row mb-2"><div class="col sm-3 usernameHeading">Device Name</div><div class="col sm-9 usernameHeading">Username</div></div>
			<div id="usernames"></div>
		</div>
	</div>
<?php } ?>
</body>
</html>
