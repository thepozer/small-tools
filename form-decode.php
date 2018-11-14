<?php
	$sDecodedPostData = '';
	
	if ($_POST['txtPostData'] && $_POST['txtBtn']) {
		switch($_POST['txtBtn']) {
			case 'Decodage PHP' :
				parse_str($_POST['txtPostData'], $arRawPostData);
				$sDecodedPostData = print_r($arRawPostData, true);
				break;
			case 'Decoupe Simple' :
				$sPostData = urldecode($_POST['txtPostData']);
				$arItems = explode('&', $sPostData);
				//ksort($arItems, SORT_STRING);
				$sDecodedPostData = strtr(implode(PHP_EOL, $arItems), array('=' => ' : '));
				break;
		}
	}
	
	$sPageTitle = 'Décodage POST Form data';
?>
<?php require 'header.php'; ?>
		<form method='post'>
			<div class="form-group">
				<label for="txtPostData">Post Data to decode</label>
				<textarea class="form-control" id="txtPostData" name="txtPostData" placeholder="Post Data" rows="5"><?= $_POST['txtPostData'] ?></textarea>
			</div>
			<div class="form-group">
				<input class="btn btn-default" type="submit" name="txtBtn" value="Decoupe Simple" />
				<input class="btn btn-default" type="submit" name="txtBtn" value="Decodage PHP" />
			</div>
			<div class="form-group">
				<label for="txtPostDataDecoded">Post Data decoded</label>
				<textarea class="form-control" id="txtPostDataDecoded" rows="25"><?= $sDecodedPostData ?></textarea>
			</div>
		</form>
<?php require 'footer.php'; ?>
