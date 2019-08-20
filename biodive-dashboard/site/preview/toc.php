<?php
include_once 'php/helpers.php';
standardHeader(true); ?>
		<meta name="viewport" content="user-scalable=no, width=1280">
		<link rel="stylesheet" type="text/css" media="screen" href="css/global2.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/toc.css">
	</head>
	<body>
		<div class="fixed-container yellow-folder closed-folder">
			<div class="folder-label">TABLE OF CONTENTS</div>
			<div class="listing">
				<dl class="contents">
<?php
	$count = 1;
	foreach($pages as $page) {
		echo "\t\t\t\t\t" . "<dt><a href='" . $page["link"] . "'>" . $page["title"] . "</a></dt><dd><a href='" . $page["link"] . "'>" . $count++ . "</a></dd>" . "\n";
	}
?>
				</dl>
			</div>
		</div>
		<script type="text/javascript" src="js/scale.js"></script>
	</body>
</html>
