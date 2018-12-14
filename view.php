<?php
session_start();

$config = include('config.php');

if( $_SESSION["user"] != $config['user'] ) {
        header("Location: index.php");

        exit;
}
?>

<style>
	body {
		font-family:Calibri;
	}
	tr:nth-of-type(even) {
		background:#efefef;
	}
	tr td {
		padding: 10px;
		box-sizing: border-box;
     		-webkit-box-sizing:border-box;
     		-moz-box-sizing: border-box;
	}
	tr:first-of-type {
		font-weight:bold;
	}
	a, input[type="submit"] {
		display:inline-block;
		margin:5px;
		padding:5px 10px;
		background:darkgrey;
		color:#fff;
		text-decoration:none;
		border:none;
	}
	input, select {
		padding: 5px 10px;
		margin:5px;
		border:none;
		border-bottom:1px solid lightgrey;
		outline:none;
		box-sizing: border-box;
     		-webkit-box-sizing:border-box;
     		-moz-box-sizing: border-box;
	}
</style>

<?php
$view = htmlspecialchars($_GET["view"]);
$param1 = htmlspecialchars($_GET["param1"]);

$search = htmlspecialchars($_GET["search"]);

$storage = htmlspecialchars($_GET["storage"]);
$description = htmlspecialchars($_GET["description"]);
$category = htmlspecialchars($_GET["category"]);
$stock = htmlspecialchars($_GET["stock"]);
$package = htmlspecialchars($_GET["package"]);

$add = htmlspecialchars($_GET["add"]);
$remove = htmlspecialchars($_GET["remove"]);

if($view == NULL)
{
echo "View: Choosen no view!<br/>";
}
else
{
echo "View: ".$view."<br/>";
}

$pdo = new PDO("mysql:host=".$config['dbhost'].";dbname=".$config['dbname'], $config['dbuser'], $config['dbpassword']);

echo "<form action=\"view.php\" method=\"GET\">Suche: <input type=\"text\" name=\"search\" value=\"$search\" /><input type=\"submit\" /><br/>";


echo "<a href=\"view.php?view=addcomponent\">Add</a> ";
echo "<a href=\"view.php?view=components\">Components</a> ";
echo "<a href=\"view.php?view=storage\">Storage</a>";

if($add != null)
{
	$sql = "UPDATE components SET stock = stock + 1 WHERE ID = \"$add\"";
	$pdo->query($sql);
}

if($remove != null)
{
	$sql = "UPDATE components SET stock = stock - 1 WHERE ID = \"$remove\"";
	$pdo->query($sql);
}

if($storage != null && $description != null && $category != null && $stock != null)
{
	echo "Tried to add yozr component!";

	$sql = "INSERT INTO components (storage, Description, Category, Stock, package) VALUES (\"$storage\", \"$description\", \"$category\", \"$stock\", \"$package\")";
	$pdo->query($sql);
}

if($search != null)
{
	echo "<table><tr><td>ID</td><td>Storage</td><td>Description</td><td>Category</td><td>Stock</td>";

	$sql = "SELECT DISTINCT * FROM `components` WHERE Description LIKE \"%$search%\" OR Storage LIKE \"%$search%\" OR Category LIKE \"%$search%\" OR Type LIKE \"%$search%\" OR package LIKE \"%$search%\"";

	foreach ($pdo->query($sql) as $row) {
	echo "<tr>";
	echo "<td>".$row["ID"]."</td>";
	echo "<td>".$row["storage"]."</td>";
	echo "<td>".$row["Description"]."</td>";
	echo "<td>".$row["Category"]."</td>";
	echo "<td>".$row["Stock"]."</td>";
	echo "<td><a href=\"view.php?search=".$search."&add=".$row["ID"]."\">+</a></td>";
	echo "<td><a href=\"view.php?search=".$search."&remove=".$row["ID"]."\">-</a></td>";
	echo "</tr>";
	}

	echo "</table>";
}

switch($view)
{
	case "addcomponent":

		echo "<br/>";

		echo "<table><tr><td>Storage</td><td>Description</td><td>Category</td><td>package</td><td>Stock</td></table>";
		echo "<form action=\"view.php\" method=\"GET\">";
		
		echo "<select name=\"storage\">";

		$sql = "SELECT Name FROM storage";

		foreach ($pdo->query($sql) as $row) {
			echo "<option value=".$row["Name"].">".$row["Name"]."</option>";

		}
		echo "</select>";

		echo "<input type=\"text\" name=\"description\" />";

		echo "<select name=\"category\">";

		$sql = "SELECT DISTINCT Category FROM components";

		foreach ($pdo->query($sql) as $row) {
			echo "<option value=".$row["Category"].">".$row["Category"]."</option>";
		}
		echo "</select>";

		echo "<select name=\"package\">";
		echo "<option value=none>none</option>";
		$sql = "SELECT DISTINCT package FROM components";

		foreach ($pdo->query($sql) as $row) {
			echo "<option value=".$row["package"].">".$row["package"]."</option>";
		}

		echo "<input type=\"text\" name=\"stock\" />";				


		echo "<input type=\"submit\" /><br/>";

		break;


	case "components":
		echo "<table><tr><td>ID</td><td>Storage</td><td>Description</td><td>Category</td><td>Stock</td>";

		$sql = "SELECT * FROM components";

		foreach ($pdo->query($sql) as $row) {
		echo "<tr>";
		echo "<td>".$row["ID"]."</td>";
		echo "<td>".$row["storage"]."</td>";
		echo "<td>".$row["Description"]."</td>";
		echo "<td>".$row["Category"]."</td>";
		echo "<td>".$row["Stock"]."</td>";
		echo "<td><a href=\"view.php?view=components&add=".$row["ID"]."\">+</a></td>";
		echo "<td><a href=\"view.php?view=components&remove=".$row["ID"]."\">-</a></td>";

		echo "</tr>";
		}

		echo "</table>";
		break;
	case "storage":
		if($param1 == NULL)
		{
			echo "<table><tr><td>ID</td><td>Name</td><td>Date</td>";

			$sql = "SELECT * FROM storage";

			foreach ($pdo->query($sql) as $row) {
			echo "<tr>";
			echo "<td>".$row["ID"]."</td>";
			echo "<td>".$row["Name"]."</td>";
			echo "<td>".$row["Date"]."</td>";
			echo "<td><a href=\"view.php?view=storage&param1=".$row["Name"]."\">View</a></td>";
			echo "</tr>";
			}

			echo "</table>";
		}
		else
		{
			echo "<table><tr><td>ID</td><td>Storage</td><td>Description</td><td>Category</td><td>Stock</td>";

			$sql = "SELECT * FROM components WHERE storage = \"$param1\"";

			foreach ($pdo->query($sql) as $row) {
			echo "<tr>";
			echo "<td>".$row["ID"]."</td>";
			echo "<td>".$row["storage"]."</td>";
			echo "<td>".$row["Description"]."</td>";
			echo "<td>".$row["Category"]."</td>";
			echo "<td>".$row["Stock"]."</td>";
			echo "</tr>";
			}

			echo "</table>";
		}
		break;
}


?>
