<?php

session_start();

$config = include('config.php');

if( $_SESSION["user"] != $config['user'] ) {
	header("Location: index.php");

	exit;
}

$data = json_decode(file_get_contents('php://input'), true);

switch($data["operation"]) {

	case "search":

		$search = $data["search"];

		$pdo = new PDO("mysql:host=".$config['dbhost'].";dbname=".$config['dbname'], $config['dbuser'], $config['dbpassword']);

		$statement = $pdo->prepare("SELECT DISTINCT * FROM `components` WHERE (Description LIKE :search) OR (Storage LIKE :search) OR (Category LIKE :search) OR (Type LIKE :search) OR (package LIKE :search)");
		$statement->execute(array('search' => "%$search%"));
		
		while($row = $statement->fetch()) {
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

