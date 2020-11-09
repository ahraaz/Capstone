<?php
// database login information
define('DB_SERVER', '');
define('DB_USERNAME', '');
define('DB_PASSWORD', '');
define('DB_NAME', '');
 
// generate random password based on length
function generatePassword($length = 8) 
{
	$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	$count = mb_strlen($chars);

	for ($i = 0, $result = ''; $i < $length; $i++) 
	{
		$index = rand(0, $count - 1);
		$result .= mb_substr($chars, $index, 1);
	}

	return $result;
}

// sanitize inputs
function sanitizeMySQL($connection, $var)
{
	$var = mysqli_real_escape_string($connection, $var);
	$var = stripslashes($var);
	$var = strip_tags($var);
	$var = htmlentities($var);
	
	return $var;
}
	
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>