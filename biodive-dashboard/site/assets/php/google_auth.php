<?php
require_once 'assets/php/google-api-php-client/vendor/autoload.php';

// Logins redirect to same page.
$REDIRECT_URI = "http" . (($_SERVER['SERVER_NAME']!="localhost") ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

// Just want users information (for now)
$scopes = array(
	'https://www.googleapis.com/auth/userinfo.email',
	'https://www.googleapis.com/auth/userinfo.profile',
	Google_Service_Classroom::CLASSROOM_COURSES_READONLY,
	Google_Service_Classroom::CLASSROOM_ROSTERS_READONLY,
	Google_Service_Drive::DRIVE
);

session_start();
$googleLoggedIn = false;

// ---- Create client ----
$client = new Google_Client();
$client->setAuthConfig('assets/php/client_id.json');
$client->setRedirectUri( $REDIRECT_URI );
$client->setScopes($scopes);
$client->setAccessType("offline");

$oauth2 = new Google_Service_Oauth2($client);

// If logout requested, close session and dump token.
if (isset($_REQUEST['logout'])) {
	$client->revokeToken();
	unset($_SESSION['token']);
	unset($_SESSION['access_token']);
	unset($_SESSION['refresh_token']);
}

// If receiving the code from Google
if (isset($_GET['code'])) {
	$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

	$_SESSION['token'] = $token;
	header('Location: ' . filter_var($REDIRECT_URI, FILTER_SANITIZE_URL));
}

// If the token is expired, try refreshing it
if($client->isAccessTokenExpired() && isset($_SESSION['refresh_token'])) {
	$client->refreshToken($_SESSION['refresh_token']);
}

// If there is an open session
if(isset($_SESSION['token']) && $_SESSION['token']) {
	$client->setAccessToken($_SESSION['token']);
}

// If we have the access token, they're logged in!
if ($client->getAccessToken() && $client->isAccessTokenExpired()==false) {
	$googleLoggedIn = true;

	$google_User = $oauth2->userinfo->get();

	// These fields are currently filtered through the PHP sanitize filters.
	// See http://www.php.net/manual/en/filter.filters.sanitize.php
	$googleUserEmail = filter_var($google_User['email'], FILTER_SANITIZE_EMAIL);
	$googleUserImage = filter_var($google_User['picture'], FILTER_VALIDATE_URL);
	$googleUserName = filter_var($google_User['name']);

	// For Google Drive picker
	$token = $client->getAccessToken();
	$refresh_token = $client->getRefreshToken();
	$decoded = json_decode($token);
	$googleOAuthAccessToken = $decoded->access_token;

	// The access token may have been updated lazily.
	$_SESSION['token'] = $token;
	$_SESSION['access_token'] = $token;
	$_SESSION['refresh_token'] = $refresh_token;
} else {
	$authUrl = $client->createAuthUrl();
}
?>
