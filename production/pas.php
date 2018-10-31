<html>
<body>

<HR/>

<?php
	function strToHex($string)
	{
		$hex='';
		for ($i=0; $i < strlen($string); $i++)
		{
		    $hex .= dechex(ord($string[$i]));
		}
		return $hex;
	}
	function hexToStr($hex)
	{
	    $string='';
	    for ($i=0; $i < strlen($hex)-1; $i+=2)
	    {
	    	if ( $hex[$i] == ' ') continue;
	        $string .= chr(hexdec($hex[$i].$hex[$i+1]));
	    }
	    return $string;
	}
	if(isset($_POST["inputString"])) {
		if ($_POST['datatype']=="Text") {
			$useHex = false;
		} else {
			$useHex = true;
		}
		if ( $useHex ) {
			$text = hexToStr($_POST['inputString']);
			$key = hexToStr($_POST['secretKey']);
		} else {							
		    $text = $_POST['inputString'];
		    $key  = $_POST['secretKey'];
		}
		
	    $algo = $_POST['algorithm'];
		if ( $algo == "MD5") {
				$digest = md5($text, false);
				$hmac_digest = hash_hmac("md5", $text, $key, false);				
		} 
		else if ( $algo == "SHA1") {
				$digest = sha1($text, false);
				$hmac_digest = hash_hmac("sha1", $text, $key, false);							
		}
		else if ( $algo == "SHA224") {
				$digest = openssl_digest($key, "sha224", false);
				$hmac_digest = hash_hmac("sha224", $text, $key, false);							
		}
		else if ( $algo == "SHA256") {
				$digest = openssl_digest($text, "sha256", false);
				$hmac_digest = hash_hmac("sha256", $text, $key, false);							
		}
    }	
?>

<H1> PHP HMAC Generator </H1>

	
<form action="" method="post" name="form1">

<select id="datatype" name="datatype">
	<option  value="Text">Text </option>
	<option  value="Hex">Hex</option>
</select>												

<div class="title first"><span class="option">message</span></div>
			<textarea rows="" cols="80" id="inputString" name="inputString"></textarea>
			<div class="title"><span class="option">Secret Key</span></div>
			<input type="text" name="secretKey" style="width:100%;" value=""/>
		<div class="title"><span class="option">Select a message digest algorithm</span></div>
						<select id="algorithm" name="algorithm">
							<option  value="SHA1">SHA1</option>
							<option  value="SHA224">SHA224</option>
							<option  value="SHA256">SHA256</option>
							<option  value="MD5">MD5</option>							
							<option  value="DES">DES</option>
						</select>												
						<div class="buttons">
							<input type="submit" value="Create Hash">
						</div>
</form>

<HR>
<p> Algorithm : <strong><?php echo $algo; ?></strong></p>
<p> Message : <strong><?php echo $text; ?></strong></p>
<?php
	    echo "Message strToHex: ".strToHex($text)."<br/>";	    
?>
<p> Key : <strong><?php echo $key; ?></strong></p> 
<?php
	    echo "key strToHex: ".strToHex($key)."<br/>";	    
?>
<p> no-hmac: <strong><?php echo $digest; ?></strong></p>
<p> HMAC: <strong><?php echo $hmac_digest; ?></strong></p>

</body>
</html>