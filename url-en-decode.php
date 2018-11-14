<?php
	$sDecodedPostData = '';
	
	if ($_POST['txtPostData'] && $_POST['txtBtn']) {
		switch($_POST['txtBtn']) {
			case 'Encode / decode' :
				$txtPostDataEncoded = urlencode($_POST['txtPostData']);
				$txtPostDataDecoded = urldecode($_POST['txtPostData']);
				break;
		}
	}
	
	$sPageTitle = 'Encodage POST Form data';
?>
<?php require 'header.php'; ?>
		<form method='post'>
			<div class="form-group">
				<label for="txtPostData">URL to encode</label>
				<input class="form-control" id="txtPostData" name="txtPostData" placeholder="URL" value="<?= $_POST['txtPostData']; ?>"/>
			</div>
			<div class="form-group">
				<input class="btn btn-default" type="submit" name="txtBtn" value="Encode / decode" />
			</div>
			<div class="form-group">
				<label for="txtPostDataEncoded">URL Encoded</label>
				<input class="form-control" id="txtPostDataEncoded" value="<?= $txtPostDataEncoded; ?>"/>
			</div>
			<div class="form-group">
				<label for="txtPostDataEncoded">URL Decoded</label>
				<input class="form-control" id="txtPostDataEncoded" value="<?= $txtPostDataDecoded; ?>"/>
			</div>
		</form>
<?php require 'footer.php'; ?>
