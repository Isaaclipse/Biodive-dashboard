<?php
use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$app->get('/getTaggedItems', function($request, $repsonse, $args) {
	return getAllFromTable($this,"taggedItems");
});

$app->get('/getDives', function($request, $repsonse, $args) {
	return getAllFromTable($this,"dives");
});

function getAllFromTable($app, $table) {
	$statement = $app->db->prepare("SELECT * FROM " . $table . " ORDER BY id");
	$statement->execute();
	$todos = $statement->fetchAll();
	return $app->response->withJson($todos);
}

$app->get('/diveData[/{classId}]', function($request, $response, $args) {
	$EPOCH = 621355968000000000;
	$TIMEOUT = (5 * 60 * 10000000);
	$TIMELIMIT = (2 * 60 * 10000000);

	// Find all the dives
	if(!empty($args["classId"])) {
		$statement = $this->db->prepare("SELECT DISTINCT id,diveId,startTime,endTime,diverName FROM dives WHERE diveId IS NOT NULL AND classId=:classId ORDER BY id DESC");
		$statement->bindParam("classId", $args["classId"]);
	} else {
		$statement = $this->db->prepare("SELECT DISTINCT id,diveId,startTime,endTime,diverName FROM dives WHERE diveId IS NOT NULL ORDER BY id DESC");
	}
	$statement->execute();
	$diveIdsResult = $statement->fetchAll();
	$md5 = md5(json_encode($diveIdsResult));

	// Assume game timed out if no
	$currentTime = ((int)strtotime("0 minute",microtime(true)) * 10000000) + $EPOCH;

	// Calculate if any have a missing endTime
	$totalDives = count($diveIdsResult);
	for ($i = 0; $i < $totalDives; $i++) {
		$id = $diveIdsResult[$i];
		if(empty($diveIdsResult[$i]["endTime"]) || $diveIdsResult[$i]["endTime"]=="") {
			if(intval($diveIdsResult[$i]["startTime"])+$TIMEOUT<$currentTime) {
				$diveIdsResult[$i]["endTime"] = intval($diveIdsResult[$i]["startTime"]) + $TIMELIMIT;
				$diveIdsResult[$i]["missingEndTime"] = true;
			}
		}
	}

	$dives = array();
	// Store dives (which have tagged items and has a real end time
	foreach($diveIdsResult as $id) {
		$statement = $this->db->prepare("SELECT userId, eventTime, creatureName, pyramidLocation FROM taggedItems WHERE diveId=:diveId AND creatureName!='start' ORDER BY eventTime");
		$statement->bindParam("diveId", $id["diveId"]);
		$statement->execute();
		$gameplayerResult = $statement->fetchAll();
		$diveId = $id["diveId"];
		$storeDive = true;

		// If nothing but start, and missing end time, don't store dive.
		if(count($gameplayerResult)==0) {
			if(array_key_exists("missingEndTime",$id) && $id["missingEndTime"]) {
				$storeDive = false;
			}
		} else {
			if(array_key_exists("missingEndTime",$id) && $id["missingEndTime"]) {
				$firstEventTime = $id["startTime"];
				$lastEventTime = $gameplayerResult[count($gameplayerResult)-1]["eventTime"];
				if($lastEventTime-$firstEventTime<$TIMEOUT) {
					$id["endTime"] = $lastEventTime;
				} else {
					$id["endTime"] = $firstEventTime + $TIMEOUT;
				}
			}
		}

		if($storeDive) {
			$userId = $gameplayerResult[0]["userId"];
			$diveData = array();
			foreach($gameplayerResult as $player) {
				$diveData[] = array( "creatureName" => $player["creatureName"], "pyramidLocation" => $player["pyramidLocation"]);
			}
			$dives[]= array(
				"tagged" => $diveData,
				"diveId" => $id["diveId"],
				"userId" => $userId,
				"diverName" =>  $diveIdsResult[array_search($id["diveId"],array_column($diveIdsResult,"diveId"))]["diverName"],
				"startTime" => $id["startTime"],
				"endTime" => $id["endTime"],

				"stuff" => $gameplayerResult
			);
		}
  	}

  	return $this->response->withJson(array( "diveCount" => count($dives), "dives" => $dives, "diveCheck" => $md5, "taggedItemCheck" => md5(json_encode(taggedCheck($this))) ));
});

// ---- Check for updates on tables ----
$app->get('/dataCheck[/{classId}]', function($request, $response, $args) {
	return $this->response->withJson( array( "diveCheck" => diveCheck($this, $args["classId"]), "taggedItemCheck" => md5(json_encode(taggedCheck($this)))) );
});

$app->get('/diveCheck[/{classId}]', function($request, $response, $args) {
	return $this->response->withJson(array( "diveCheck" => diveCheck($this,$args["classId"]) ));
});

function diveCheck($app, $classId) {
	if(!empty($classId)) {
		$statement = $app->db->prepare("SELECT DISTINCT id,diveId,startTime,endTime,diverName FROM dives WHERE diveId IS NOT NULL AND classId=:classId ORDER BY id DESC");
		$statement->bindParam("classId", $classId);
	} else {
		$statement = $app->db->prepare("SELECT DISTINCT id,diveId,startTime,endTime,diverName FROM dives WHERE diveId IS NOT NULL ORDER BY id DESC");
	}
	$statement->execute();
	$diveIdsResult = $statement->fetchAll();
	$md5 = md5(json_encode($diveIdsResult));

	return $md5;
}

$app->get('/taggedItemCheck', function($request, $response, $args) {
	return $this->response->withJson( taggedCheck($this) );
});

function taggedCheck($app) {
	$statement = $app->db->prepare("SELECT id,createdTime FROM taggedItems ORDER BY createdTime DESC LIMIT 1");
	$statement->execute();
	$lastTagged = $statement->fetchAll();

	return $lastTagged;
}

// ---- Username for demo ----
$app->put('/demoChangeUsername', function($request, $response, $args) {
	$input = $request->getParsedBody();
	$sql = "UPDATE users SET username=:username WHERE deviceId=:deviceId";
	$statement = $this->db->prepare($sql);
	$statement->bindParam("username", $input['username']);
	$statement->bindParam("deviceId", $input['deviceId']);
	$statement->execute();
	return $this->response->withJson($input);
});

$app->get('/demoGetUsername[/{deviceId}]', function($request, $repsonse, $args) {
	if(!empty($args["deviceId"])) {
		$statement = $this->db->prepare("SELECT username FROM users WHERE deviceId=:deviceId");
	} else {
		$statement = $this->db->prepare("SELECT username FROM users");
	}
	$statement->bindParam("deviceId", $args["deviceId"]);
	$statement->execute();
	$names = $statement->fetchAll();

	// If no names, let's store the device ID and assign a generic name to that user
	if(empty($names)) {
		// Insert new device ID into database
		$sql = "INSERT INTO users (deviceId) VALUES (:deviceId)";
		$statement = $this->db->prepare($sql);
		$statement->bindParam("deviceId", $args["deviceId"]);
		$statement->execute();
		$newDeviceId = $this->db->lastInsertId();

		// Create new username based on ID of new record
		$sql = "UPDATE users SET username=:username WHERE deviceId=:deviceId";
		$statement = $this->db->prepare($sql);
		$newUsername = "User #" . $newDeviceId;
		$statement->bindParam("username", $newUsername);
		$statement->bindParam("deviceId", $args["deviceId"]);
		$statement->execute();

		// Try it again, it should get a name now!!!
		$statement = $this->db->prepare("SELECT username FROM users WHERE deviceId=:deviceId");
		$statement->bindParam("deviceId", $args["deviceId"]);
		$statement->execute();
		$names = $statement->fetchAll();
	}

	return $this->response->withJson($names);
});

$app->get('/dashboardGetUsernames', function($request, $repsonse, $args) {
	$statement = $this->db->prepare("SELECT * FROM users");
	$statement->execute();
	$names = $statement->fetchAll();
	return $this->response->withJson($names);
});

// ---- Backlog ----
$app->post('/backlogPoster', function($request, $response, $args) {
	$input = $request->getParsedBody();
	$backlogItems = json_decode($input["data"]);
	$backlogCount = count($backlogItems->data);

	foreach ($backlogItems->data as $item) {
		$mode = "POST";
		$result = "";
		$data = array();
		$url = $item->url;

		foreach ($item->content as $content) {
			if(isset($content->putData)) {
				$mode = "PUT";
			} else {
				$data[$content->section] = $content->data;
			}
		}

		if($mode=="PUT") {
			parse_str($content->putData, $data);
			switch($url) {
				case "/startDive":
					$result = put_startDive($this, $data);
				break;
				case "/endDive":
					$result = put_endDive($this, $data);
				break;
				default:
					error_log("*** I DON'T KNOW WHAT TO DO WITH PUT " . $url . "!!! ***");
				break;
			}
		} else {
			switch ($url) {
				case "/startDive":
					$result = post_startDive($this, $data);
				break;
				case "/tagItem":
					$result = post_tagItem($this, $data);
				break;
				default:
					error_log("*** I DON'T KNOW WHAT TO DO WITH POST " . $url . "!!! ***");
				break;
			}
		}
	}
	return $this->response->withJson(array( "status" => "successful", "count" => $backlogCount ));
});

// ---- Dive ----
$app->post('/startDive', function($request, $response, $args) {
	$input = $request->getParsedBody();
	return post_startDive($this, $input);
});

function post_startDive($app, $input) {
	$sql = "INSERT INTO dives (userId, diveId, startTime, diverName) VALUES (:userId, :diveId, :startTime, :diverName)";
	$statement = $app->db->prepare($sql);
	$statement->bindParam("userId", $input['userId']);
	$statement->bindParam("diveId", $input['diveId']);
	$statement->bindParam("startTime", $input['startTime']);
	$statement->bindParam("diverName", $input['diverName']);
	$statement->execute();
	$input['id'] = $app->db->lastInsertId();
	return $app->response->withJson($input);
}

$app->put('/startDive', function($request, $response, $args) {
	$input = $request->getParsedBody();
	return put_startDrive($this, $input);
});

function put_startDive($app, $input) {
	$sql = "UPDATE dives SET startTime=:startTime WHERE diveId=:diveId";
	$statement = $app->db->prepare($sql);
	$statement->bindParam("startTime", $input['startTime']);
	$statement->bindParam("diveId", $input['diveId']);
	$statement->execute();
	return $app->response->withJson($input);
}

$app->put('/endDive', function($request, $response, $args) {
	$input = $request->getParsedBody();
	return put_endDrive($this, $input);
});

function put_endDive($app, $input) {
	$sql = "UPDATE dives SET endTime=:endTime WHERE diveId=:diveId";
	$statement = $app->db->prepare($sql);
	$statement->bindParam("endTime", $input['endTime']);
	$statement->bindParam("diveId", $input['diveId']);
	$statement->execute();
	return $app->response->withJson($input);
}

$app->post('/tagItem', function($request, $response, $args) {
	$input = $request->getParsedBody();
	return post_tagItem($this, $input);
});

function post_tagItem($app, $input) {
	$sql = "INSERT INTO taggedItems (userId, diveId, location, creatureName, pyramidLocation, eventTime) VALUES (:userId, :diveId, :location, :creatureName, :pyramidLocation, :eventTime)";
	$statement = $app->db->prepare($sql);
	$statement->bindParam("userId", $input['userId']);
	$statement->bindParam("diveId", $input['diveId']);
	$statement->bindParam("location", $input['location']);
	$statement->bindParam("creatureName", $input['creatureName']);
	$statement->bindParam("pyramidLocation", $input['pyramidLocation']);
	$statement->bindParam("eventTime", $input['eventTime']);
	$statement->execute();
	$input['id'] = $app->db->lastInsertId();
	return $app->response->withJson($input);
}

/** @todo Replace with a generic Killer Snails page. */
$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
	// Sample log message
	$this->logger->info("Slim-Skeleton '/' route");

	// Render index view
	return $this->renderer->render($response, 'index.phtml', $args);
});
