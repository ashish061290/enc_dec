<!DOCTYPE html>
<html lang="en">
 <head>
 <title>Encrption|Decryption</title>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 </head>
 <body>
 <style>
  .heading{
	  text-align:center;
  }
  .pad{
	  padding:20px;
  }
 </style>
    <div class="container">
	 <div class="row pad">
	 <div class="heading">
	 <h2>Encryption Or Decryption</h2></div>
	   <form method="post" class="form form-vertical">
	  <div class="form-group">
      <label for="email">Enter String:</label>
      <input type="text" class="form-control" id="text" placeholder="Enter String" name="string">
       </div>
        <input type="submit" name="e" value="Encrypte" class="btn btn-default"> &nbsp;&nbsp;&nbsp;<input type="submit" name="d" value="Decrypte" class="btn btn-default"> 
	   </form>
	<?php $output="";   
	if(isset($_POST['e'])){
	$action = 'e';
	$string = $_POST['string'];
    $output = gowelnext_crypt($string, $action);
    }
    if(isset($_POST['d'])){
	$action = 'd';
	$string = $_POST['string'];
	$output = gowelnext_crypt($string, $action);
    } if($output !=""){
		echo "<h5><strong>".$output."</strong></h5>";
	} ?>
	  </div>
	  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 </body>
</html>
<?php
	function gowelnext_crypt($string, $action = 'e' ){
       // you may change these values to your own
		$secret_key = 'my_simple_secret_key';
		$secret_iv = 'my_simple_secret_iv';
	 
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$key = hash( 'sha256', $secret_key );
		$iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

		if( $action == 'e' ) {
			$output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
		}
		else if( $action == 'd' ){
			$output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
		}
	 
		return $output;
	}
 ?>