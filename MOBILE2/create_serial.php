<?
	include_once "../config.php";

	for ($i=0; $i < 300000;$i++)
	{
		$serial = PHPRandom::getHexString("10");
		$query 	= "INSERT INTO serial_info(serial_code) values('".$serial."')";
		$result 	= mysqli_query($my_db, $query);
	}

?>