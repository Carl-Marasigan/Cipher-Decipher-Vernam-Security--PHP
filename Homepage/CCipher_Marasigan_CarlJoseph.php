<!DOCTYPE html >
<html >
<head>
<title>Encipher and Decipher</title>
<body>

<style>
body {

  background-image: url('abc.jpg');
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
<h2>CAESAR CIPHER</h2>
<form align = "center" method = "get" action = " " >
<strong><label for="Text">Text:</label></strong>
<input type="text" name="cipher" >
<input type ="submit" value="Encipher" name= "Encipher" />
<input type ="submit" value="Decipher" name= "Decipher" />
<input type ="submit" value="Clear" name= "clear" />
<form>
<input type="button" value="Go Back" onclick="history.back(-1)">
</form>
</form>

<strong> The result of your encipher/decipher is shown below:<br /></strong>

<?php

$text= isset($_GET['text']) ? $_GET['text'] : '';

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

if (isset($_GET['Encipher'])){ // get the text from the form
    $text = $_GET['cipher'];
	$cipherText = Encipher($text, 3);
	$plainText = Decipher($cipherText, 3);
	$strArray = count_chars($cipherText,1);//count characters of encipher
	echo " Input Text: <b>".$text."</b></br>";
	echo "Cipher Text: <b>".$cipherText."</b></br>";
	echo "Plain text: <b>".$plainText."</b></br>";
	foreach ($strArray as $key=>$value)
{
	echo "The character <b>'".chr($key)."'</b> was found in <b>Cipher text</b>  is <b> [$value]</b> time(s)<br>";
}
 } elseif(isset($_GET['Decipher'])){ //get the text from the form
	 $text = $_GET['cipher'];
	 $cipherText1= Decipher($text, 3);
	 $plainText1 = Encipher($cipherText1, 3);
	 $strArray = count_chars($cipherText1,1); //count characters of decipher
	echo "Input Text: <b>".$text."</b></br>" ; 
	echo "PlainText: <b>".$cipherText1."</b></br>";
	echo "Cipher text: <b>".$plainText1."</b></br>"; 
	foreach ($strArray as $key=>$value)
{
	echo "The character <b>'".chr($key)."'</b> was found in <b>Plaintext</b> is <b>[$value]</b>time(s)<br>";
}
}
?>
</head>
</body>
</html>