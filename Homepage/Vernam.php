<!DOCTYPE html >
<html >
<head>
<title>Vernam Cipher</title>
<body>

<style>
body {

  background-image: url('binary1.jpg');
}

.container {
  height: 700px;
  position: relative;

}

.center {
  margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}

</style>
<div class="container">
<div class= "center">
<h2>VERNAM CIPHER</h2>
<form align = "left" method = "get" action = " " >
<strong><label for="Text">Text:</label></strong>
<input type="text" name="cipher" >
<input type ="submit" value="Encrpyt" name= "Encipher" />
<input type ="submit" value="Decrpyt" name= "Decipher" />
<input type ="submit" value="Clear" name= "clear" />
 <input type="button" value="Go Back" onclick="history.back(-1)"></br> </br>
</form> </br>

<strong> The result of your encrpyt/decrpyt is shown below:<br /></strong>

<?php

$text= isset($_GET['text']) ? $_GET['text'] : '';
$key = "aes-256-cbc";  //key for encrypt and decrypt
$encryption_key = openssl_random_pseudo_bytes (32);
$encryption_key_Hex = bin2hex ($encryption_key);
$iv_size = openssl_cipher_iv_length($key);
$iv=openssl_random_pseudo_bytes ($iv_size);

function Cipher($ch, $key)
{
	if (!ctype_alpha($ch))
		return $ch;

	$offset = ord(ctype_upper($ch) ? 'A' : 'a');
	return chr(fmod(((ord($ch) + $key) - $offset), 26) + $offset);
}

function Encipher($input, $key)
{
	$output = "";

	$inputArr = str_split($input);
	foreach ($inputArr as $ch)
	$output .= Cipher($ch, $key);

	return $output;	
}
function Decipher($input, $key)
{
	return Encipher($input, 26 - $key);
}

function strToBin($input)  // convert string to binary
 {
        if (!is_string($input))
            return false;
        $value = unpack('H*', $input);
        return base_convert($value[1], 16, 2);
}
	
if (isset($_GET['Encipher'])){ // get the text from the form
   $text = $_GET['cipher']; // get text
   $cipherText = Encipher($text, 3);
   $plainText = Decipher($cipherText, 3);
   $encrypted_data = openssl_encrypt ($text,$key,$encryption_key,0,$iv); // encrpyt the data and the key
	echo " Input Text: <b>".$text."</b></br>";
	echo "Cipher Text: <b>".$cipherText."</b></br>";
    echo "Binary: <b>".(strToBin($plainText))."</b></br>";
	echo " Encryption Key: <b>".$encryption_key."</b></br>";
	echo " Encrypted Text: <b>".$encrypted_data."</b></br>";

 } elseif(isset($_GET['Decipher'])){ //get the text from the form
	 $text = $_GET['cipher']; // get text
	 $cipherText1= Decipher($text, 3);
	 $plainText1 = Encipher($cipherText1, 3);
	$encrypted_data = openssl_encrypt ($cipherText1,$key,$encryption_key,0,$iv);
	$decrypted_data = openssl_decrypt ($encrypted_data,$key,$encryption_key,0,$iv);
	echo "Input Text: <b>".$text."</b></br>" ;  
	echo "Cipher text: <b>".$plainText1."</b></br>"; 
    echo "Binary: <b>".(strToBin($plainText1))."</b></br>";
	echo " Encryption Key: <b>".$encryption_key."</b></br>";
	echo " Encrypted Text: <b>".$encrypted_data."</b></br>";
	echo " Decrypted Text: <b>".$decrypted_data."</b></br>";
}
?>
</head>
</body>
</html>






