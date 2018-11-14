<?php
    $arActionList = [
        'ALL' => DNS_ALL, 'ANY' => DNS_ANY, 'A' => DNS_A, 'AAAA' => DNS_AAAA, 'CNAME' => DNS_CNAME, 'MX' => DNS_MX, 'TXT' => DNS_TXT, 
        'NS' => DNS_NS, 'SOA' => DNS_SOA, 'PTR' => DNS_PTR, 'SRV' => DNS_SRV, 'NAPTR' => DNS_NAPTR, 'A6' => DNS_A6, 'HINFO' => DNS_HINFO
    ];
	$arOptions = [
		'options' => ['default' => null],
	];
	
    $bDebug  = boolval(filter_input(INPUT_GET, 'debug', FILTER_VALIDATE_BOOLEAN));
    
	$sDomain = strtolower(filter_input(INPUT_POST, 'txtDomain', FILTER_VALIDATE_DOMAIN, $arOptions));
    $sAction = strtoupper(filter_input(INPUT_POST, 'txtBtn', FILTER_SANITIZE_STRING));
    
	if ($sDomain != '' && $sAction != '') {
        $sRet = ($bDebug) ? "Info :\n* sDomain : {$sDomain}\n* sAction : {$sAction}\n" : '';
	    
	    if (isset($arActionList[$sAction])) {
	        $arRet = dns_get_record($sDomain, $arActionList[$sAction]);
	        $sRet .= "\nResult : \n";
	        foreach($arRet as $arRecord) {
	            if ($arRecord['type'] == 'A') {
    	            $sRet .= "{$arRecord['host']} {$arRecord['ttl']} {$arRecord['class']} {$arRecord['type']} {$arRecord['ip']}\n";
	            } elseif ($arRecord['type'] == 'AAAA') {
    	            $sRet .= "{$arRecord['host']} {$arRecord['ttl']} {$arRecord['class']} {$arRecord['type']} {$arRecord['ipv6']}\n";
	            } elseif ($arRecord['type'] == 'TXT') {
	                foreach($arRecord['entries'] as $sEntry) {
        	            $sRet .= "{$arRecord['host']} {$arRecord['ttl']} {$arRecord['class']} {$arRecord['type']} {$sEntry}\n";
    	            }
	            } elseif ($arRecord['type'] == 'SOA') {
    	            $sRet .= "{$arRecord['host']} {$arRecord['ttl']} {$arRecord['class']} {$arRecord['type']} {$arRecord['mname']} {$arRecord['rname']} {$arRecord['serial']} {$arRecord['refresh']} {$arRecord['retry']} {$arRecord['expire']} {$arRecord['minimum-ttl']}\n";
	            } elseif ($arRecord['type'] == 'MX') {
    	            $sRet .= "{$arRecord['host']} {$arRecord['ttl']} {$arRecord['class']} {$arRecord['type']} {$arRecord['pri']} {$arRecord['target']}\n";
	            } else {
    	            $sRet .= "{$arRecord['host']} {$arRecord['ttl']} {$arRecord['class']} {$arRecord['type']} {$arRecord['target']}\n";
	            }
	        }
	        
	        $sRet .= ($bDebug) ? ("\nDebug:\n" . print_r($arRet, true)) : '';
	    } else {
	        $sRet .= 'Bad Action : ' . $sAction;
	    }
	}
	
	$sPageTitle = 'Dig in DNS records';
?>
<?php require 'header.php'; ?>
		<form class="form-horizontal" method="post" <?= ($bDebug) ? 'action="?debug=1"' : '' ?> >
			<div class="form-group">
				<label class="col-sm-2 control-label" for="txtDomain">Domain to dig : </label>
			    <div class="col-sm-8">
    				<input class="form-control" id="txtDomain" name="txtDomain" placeholder="URL" value="<?= $_POST['txtDomain']; ?>"/>
    			</div>
    			<div class="col-sm-2">
			        <?php if ($bDebug) : ?>
        			    <a class="btn btn-info" href="?debug=0">Disable Debug</a>
        			<?php else : ?>
        			    <a class="btn btn-info" href="?debug=1">Enable Debug</a>
        			<?php endif; ?>
        		</div>
			</div>
			<div class="form-group">
			    <div class="text-center">
			    <?php foreach (array_keys($arActionList) as $sAction) : ?>
    				<input class="btn btn-default" type="submit" name="txtBtn" value="<?= $sAction ?>" />
				<?php endforeach; ?>
				</div>
			</div>
		</form>
		<?php if ($sRet) : ?>
		<hr />
        <pre><?= $sRet ?></pre>
        <?php endif; ?>
<?php require 'footer.php'; ?>
