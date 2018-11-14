<?php
	$arListScripts = array(
		'/current-ip.php' => array('name' => 'Mon IP', 'active' => false),
#		'/server.php' => array('name' => 'PHP _SERVER', 'active' => false),
		'/form-decode.php' => array('name' => 'Form Decode', 'active' => false),
		'/form-encode.php' => array('name' => 'Form Encode', 'active' => false),
		'/url-en-decode.php' => array('name' => 'URL En/Decode', 'active' => false),
		'/dns-dig.php' => array('name' => 'DNS dig', 'active' => false),
	);
	
	if ($_SERVER['PHP_SELF'] !== '/index.php') {
		$arListScripts[$_SERVER['PHP_SELF']]['active'] = true;
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $sPageTitle; ?></title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
		.text-ip {
			text-align: center;
			font-size: 2.2em;
		}
	</style>
  </head>
  <body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/">Small tools</a>
			</div>
			<div class="collapse navbar-collapse" id="main-navbar">
				<ul class="nav navbar-nav">
					<?php foreach($arListScripts as $sScript => $arInfo): ?>
					<li <?= ($arInfo['active']) ? 'class="active"' : '' ?>><a href="<?= $sScript; ?>"><?= $arInfo['name']; ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
