<?php

$data = json_decode(file_get_contents('php://input'), true);

switch($data["operation"]) {

	case "search":

		$search = $data["search"];

                $config = include('config.php');

		$mysqli =  mysqli_connect($config['dbhost'], $config['dbuser'], $config['dbpassword'], $config['dbname']);

		// Check connection
		if (!$mysqli) {
		    die("Connection failed: " . mysqli_connect_error());
		}

		$string = "SELECT DISTINCT * FROM `components` WHERE Description LIKE \"%$search%\" OR Storage LIKE \"%$search%\" OR Category LIKE \"%$search%\" OR Type LIKE \"%$search%\" OR package LIKE \"%$search%\"";

		$res = mysqli_query($mysqli, $string);

		while ($row = mysqli_fetch_assoc($res)) {
			$myresult["id"] = $row["ID"];
			$myresult["storage"] = $row["storage"];
			$myresult["description"] = $row["Description"];
			$myresult["category"] = $row["Category"];
			$myresult["stock"] = $row["Stock"];

			$result[] = $myresult;
		}

		echo json_encode($result);

		break;
}

?>

