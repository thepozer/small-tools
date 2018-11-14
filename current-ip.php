<?php
// Récupération de l'adresse IP de la personne affichant la page
	$arOptions = array(
		'flags'   => array(FILTER_FLAG_NO_PRIV_RANGE, FILTER_FLAG_NO_RES_RANGE), 
		'options' => array('default' => null),
	);

	$sEnvHttpClientIp      = strtolower(filter_input(INPUT_ENV,    'HTTP_CLIENT_IP',       FILTER_VALIDATE_IP, $arOptions));
	$sEnvHttpXForwardedFor = strtolower(filter_input(INPUT_ENV,    'HTTP_X_FORWARDED_FOR', FILTER_VALIDATE_IP, $arOptions));
	$sEnvRemoteAddr        = strtolower(filter_input(INPUT_ENV,    'REMOTE_ADDR',          FILTER_VALIDATE_IP, $arOptions));
	$sServerRemoteAddr     = strtolower(filter_input(INPUT_SERVER, 'REMOTE_ADDR',          FILTER_VALIDATE_IP, $arOptions));
	
	if ($sEnvHttpClientIp && $sEnvHttpClientIp !== 'unknown') {
		$sRemoteIP = $sEnvHttpClientIp;
	} else if ($sEnvHttpXForwardedFor && $sEnvHttpXForwardedFor !== 'unknown') {
		$sRemoteIP = $sEnvHttpXForwardedFor;
	} else if ($sEnvRemoteAddr && $sEnvRemoteAddr !== 'unknown') {
		$sRemoteIP = $sEnvRemoteAddr;
	} else if ($sServerRemoteAddr && $sServerRemoteAddr !== 'unknown') {
		$sRemoteIP = $sServerRemoteAddr;
	} else {
		$sRemoteIP = 'unknown';
	}
	
	$sPageTitle = 'Votre adresse IP';
?>
<?php require 'header.php'; ?>
		<div class="row">
		    <p class="bg-success text-ip">Votre adresse IP : <?= $sRemoteIP; ?></p>
		</div>
<?php require 'footer.php'; ?>
