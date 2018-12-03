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

$config = include('config.php');

$mysqli =  mysqli_connect($config['dbhost'], $config['dbuser'], $config['dbpassword'], $config['dbname']);

// Check connection
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Database: Connected successfully<br/>";

echo "<form action=\"view.php\" method=\"GET\">Suche: <input type=\"text\" name=\"search\" value=\"$search\" /><input type=\"submit\" /><br/>";


echo "<a href=\"http://172.16.100.9/erp/view.php?view=addcomponent\">Add</a> ";
echo "<a href=\"http://172.16.100.9/erp/view.php?view=components\">Components</a> ";
echo "<a href=\"http://172.16.100.9/erp/view.php?view=storage\">Storage</a>";

if($search != null)
{
	echo "<table><tr><td>ID</td><td>Storage</td><td>Description</td><td>Category</td><td>Stock</td>";

	$string = "SELECT DISTINCT * FROM `components` WHERE Description LIKE \"%$search%\" OR Storage LIKE \"%$search%\" OR Category LIKE \"%$search%\" OR Type LIKE \"%$search%\" OR package LIKE \"%$search%\"";
	$res = mysqli_query($mysqli, $string);

	while ($row = mysqli_fetch_assoc($res)) {

	echo "<tr>";
	echo "<td>".$row["ID"]."</td>";
	echo "<td>".$row["storage"]."</td>";
	echo "<td>".$row["Description"]."</td>";
	echo "<td>".$row["Category"]."</td>";
	echo "<td>".$row["Stock"]."</td>";
	echo "<td><a href=\"http://172.16.100.9/erp/view.php?search=".$search."&add=".$row["ID"]."\">+</a></td>";
	echo "<td><a href=\"http://172.16.100.9/erp/view.php?search=".$search."&remove=".$row["ID"]."\">-</a></td>";
	echo "</tr>";

	}

	echo "</table>";
}

if($storage != null && $description != null && $category != null && $stock != null)
{
	echo "Tried to add yozr component!";

	$string = "INSERT INTO components (storage, Description, Category, Stock, package) VALUES (\"$storage\", \"$description\", \"$category\", \"$stock\", \"$package\")";
	$res = mysqli_query($mysqli, $string);
}

if($add != null)
{
	$string = "UPDATE components SET stock = stock + 1 WHERE ID = \"$add\"";
	$res = mysqli_query($mysqli, $string);
}

if($remove != null)
{
	$string = "UPDATE components SET stock = stock - 1 WHERE ID = \"$remove\"";
	$res = mysqli_query($mysqli, $string);
}

switch($view)
{
	case "addcomponent":

		echo "<br/>";

		echo "<table><tr><td>Storage</td><td>Description</td><td>Category</td><td>package</td><td>Stock</td></table>";
		echo "<form action=\"view.php\" method=\"GET\">";
		
		echo "<select name=\"storage\">";

		$string = "SELECT Name FROM storage";
		$res = mysqli_query($mysqli, $string);

		while ($row = mysqli_fetch_assoc($res)) {
			echo "<option value=".$row["Name"].">".$row["Name"]."</option>";

		}
		echo "</select>";

		echo "<input type=\"text\" name=\"description\" />";

		echo "<select name=\"category\">";

		$string = "SELECT DISTINCT Category FROM components";
		$res = mysqli_query($mysqli, $string);

		while ($row = mysqli_fetch_assoc($res)) {
			echo "<option value=".$row["Category"].">".$row["Category"]."</option>";

		}
		echo "</select>";

		echo "<select name=\"package\">";
		echo "<option value=none>none</option>";
		$string = "SELECT DISTINCT package FROM components";
		$res = mysqli_query($mysqli, $string);

		while ($row = mysqli_fetch_assoc($res)) {
			echo "<option value=".$row["package"].">".$row["package"]."</option>";

		}

		echo "<input type=\"text\" name=\"stock\" />";				


		echo "<input type=\"submit\" /><br/>";

		break;


	case "components":
		echo "<table><tr><td>ID</td><td>Storage</td><td>Description</td><td>Category</td><td>Stock</td>";

		$string = "SELECT * FROM components";
		$res = mysqli_query($mysqli, $string);

		while ($row = mysqli_fetch_assoc($res)) {

		echo "<tr>";
		echo "<td>".$row["ID"]."</td>";
		echo "<td>".$row["storage"]."</td>";
		echo "<td>".$row["Description"]."</td>";
		echo "<td>".$row["Category"]."</td>";
		echo "<td>".$row["Stock"]."</td>";
		echo "<td><a href=\"http://172.16.100.9/erp/view.php?view=components&add=".$row["ID"]."\">+</a></td>";
		echo "<td><a href=\"http://172.16.100.9/erp/view.php?view=components&remove=".$row["ID"]."\">-</a></td>";

		echo "</tr>";

		}

		echo "</table>";
		break;
	case "storage":
		if($param1 == NULL)
		{
			echo "<table><tr><td>ID</td><td>Name</td><td>Date</td>";

			$string = "SELECT * FROM storage";
			$res = mysqli_query($mysqli, $string);

			while ($row = mysqli_fetch_assoc($res)) {

			echo "<tr>";
			echo "<td>".$row["ID"]."</td>";
			echo "<td>".$row["Name"]."</td>";
			echo "<td>".$row["Date"]."</td>";
			echo "<td><a href=\"http://172.16.100.9/erp/view.php?view=storage&param1=".$row["Name"]."\">View</a></td>";
			echo "</tr>";

			}

			echo "</table>";
		}
		else
		{
			echo "<table><tr><td>ID</td><td>Storage</td><td>Description</td><td>Category</td><td>Stock</td>";

			$string = "SELECT * FROM components WHERE storage = \"$param1\"";
			$res = mysqli_query($mysqli, $string);

			while ($row = mysqli_fetch_assoc($res)) {

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
