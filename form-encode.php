<?php
	$sDecodedPostData = '';
	
	if ($_POST['txtPostData'] && $_POST['txtBtn']) {
		switch($_POST['txtBtn']) {
			case 'Encodage' :
				$sPostParams = strtr($_POST['txtPostData'], array("\r" => "\n", "\n\n" => "\n"));
				$arParams = explode(PHP_EOL, $sPostParams);
				
				$sEncodedPostData = '';
				$bFirst = true;
				foreach($arParams as $sParam) {
					if (trim($sParam) != '') {
						if ($bFirst) {
							$bFirst = false;
						} else {
							$sEncodedPostData .= '&';
						}
						
						list($sKey, $sValue) = explode('=', $sParam, 2);
						$sEncodedPostData .= urlencode(trim($sKey)) . '=' . urlencode($sValue);
					}
				}
				break;
		}
	}
	
	$sPageTitle = 'Encodage POST Form data';
?>
<?php require 'header.php'; ?>
		<form method='post'>
			<div class="form-group">
				<label for="txtPostData">Parameters to encode (One parameter per line)</label>
				<textarea class="form-control" id="txtPostData" name="txtPostData" placeholder="Post Data" rows="25"><?= $_POST['txtPostData'] ?></textarea>
			</div>
			<div class="form-group">
				<input class="btn btn-default" type="submit" name="txtBtn" value="Encodage" />
			</div>
			<div class="form-group">
				<label for="txtPostDataEncoded">Post Data decoded</label>
				<textarea class="form-control" id="txtPostDataEncoded" rows="5"><?= $sEncodedPostData ?></textarea>
			</div>
		</form>
<?php require 'footer.php'; ?>
