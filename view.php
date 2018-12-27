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

echo "<form action=\"view.php\" method=\"GET\">Suche: <input type=\"text\" name=\"search\" value=\"$search\" /><input type=\"submit\" /></form>";


echo "<a href=\"view.php?view=addcomponent\">Add</a> ";
echo "<a href=\"view.php?view=components\">Components</a> ";
echo "<a href=\"view.php?view=storage\">Storage</a>";

if($add != null)
{
	$statement = $pdo->prepare("UPDATE components SET stock = stock + 1 WHERE ID = ?");
	$statement->execute(array($add));
}

if($remove != null)
{
	$statement = $pdo->prepare("UPDATE components SET stock = stock - 1 WHERE ID = ?");
	$statement->execute(array($remove));
}

if($storage != null && $description != null && $category != null && $stock != null)
{
	echo "Tried to add your component!";

	$statement = $pdo->prepare("INSERT INTO components (storage, Description, Category, Stock, package) VALUES (?, ?, ?, ?, ?)");
	$statement->execute(array($storage, $description, $category, $stock, $package));
}

if($search != null)
{
	echo "<table><tr><td>ID</td><td>Storage</td><td>Description</td><td>Category</td><td>Stock</td>";

	$statement = $pdo->prepare("SELECT DISTINCT * FROM `components` WHERE (Description LIKE :search) OR (Storage LIKE :search) OR (Category LIKE :search) OR (Type LIKE :search) OR (package LIKE :search)");
	$statement->execute(array('search' => "%$search%"));

	while($row = $statement->fetch()) {
		echo "<tr>";
		echo "<td>".$row["ID"]."</td>";
		echo "<td>".$row["storage"]."</td>";
		echo "<td>".$row["Description"]."</td>";

		if(!empty($row["datasheet"])) {
			echo "<td><a href=".$row["datasheet"].">Link</a></td>";
		} else {
			echo "<td></td>";
		}

		echo "<td>".$row["Category"]."</td>";

		if($row["stock_flag"] == 1) {
			echo "<td>".$row["Stock"]."</td>";
			echo "<td><a href=\"view.php?view=components&add=".$row["ID"]."\">+</a></td>";
			echo "<td><a href=\"view.php?view=components&remove=".$row["ID"]."\">-</a></td>";
		} else {
			echo "<td></td>";
			echo "<td></td>";
			echo "<td></td>";
		}

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

	case "editcomponent":
		if(isset($_POST["param1"]) && 
			isset($_POST["storage"]) && 
			isset($_POST["description"]) && 
			isset($_POST["datasheet"]) && 
			isset($_POST["category"]) && 
			isset($_POST["package"]) && 
			isset($_POST["type"]) && 
			isset($_POST["stock"])) {

			if(isset($_POST["stock_flag"])) {
				$stock_flag = 1;
			} else {
				$stock_flag = 0;
			}

			if(empty($_POST["stock"])) {
				$_POST["stock"] = 0;
			}

			$statement = $pdo->prepare("UPDATE components SET storage = ?, Description = ?, datasheet = ?, Category = ?, package = ?, Type = ?, Stock = ?, stock_flag = ? WHERE ID = ?");
			$statement->execute(array($_POST["storage"], $_POST["description"], $_POST["datasheet"], $_POST["category"], $_POST["package"], $_POST["type"], $_POST["stock"], $stock_flag, $_POST["param1"]));

			$param1 = $_POST["param1"];
		}

		$statement = $pdo->prepare("SELECT * FROM components WHERE ID = ?");
		$statement->execute(array($param1));

		$row = $statement->fetch();

		echo "<form action=\"view.php?view=editcomponent\" method=\"POST\"><br>";

		echo "ID:<br>";
		echo "<input type=\"text\" name=\"param1\" value=\"".$row['ID']."\" /><br>";

		echo "Storage:<br>";
		echo "<input type=\"text\" name=\"storage\" value=\"".$row['storage']."\" /><br>";

		echo "Description:<br>";
		echo "<input type=\"text\" name=\"description\" value=\"".$row['Description']."\" /><br>";

		echo "Datasheet:<br>";
		echo "<input type=\"text\" name=\"datasheet\" value=\"".$row['datasheet']."\" /><br>";

		echo "Category:<br>";
		echo "<input type=\"text\" name=\"category\" value=\"".$row['Category']."\" /><br>";

		echo "Package:<br>";
		echo "<input type=\"text\" name=\"package\" value=\"".$row['package']."\" /><br>";

		echo "Type:<br>";
		echo "<input type=\"text\" name=\"type\" value=\"".$row['Type']."\" /><br>";

		echo "Stock:<br>";
		echo "<input type=\"text\" name=\"stock\" value=\"".$row['Stock']."\" /><br>";

		echo "Stock Flag:<br>";
		if($row['stock_flag']) {
			echo "<input type=\"checkbox\" name=\"stock_flag\" checked/><br>";
		} else {
			echo "<input type=\"checkbox\" name=\"stock_flag\" /><br>";
		}
		
		echo "<input type=\"submit\" /><br/>";

		echo "</form>";

		break;


	case "components":
		echo "<table><tr><td>ID</td><td>Storage</td><td>Description</td><td>Datasheet</td><td>Category</td><td>Package</td><td>Type</td><td>Stock</td>";

		$sql = "SELECT * FROM components";

		foreach ($pdo->query($sql) as $row) {
		echo "<tr>";
		echo "<td>".$row["ID"]."</td>";
		echo "<td>".$row["storage"]."</td>";
		echo "<td>".$row["Description"]."</td>";
		
		if(!empty($row["datasheet"])) {
			echo "<td><a href=".$row["datasheet"].">Link</a></td>";
		} else {
			echo "<td></td>";
		}

		echo "<td>".$row["Category"]."</td>";
		echo "<td>".$row["package"]."</td>";
		echo "<td>".$row["Type"]."</td>";

		if($row["stock_flag"] == 1) {
			echo "<td>".$row["Stock"]."</td>";
			echo "<td><a href=\"view.php?view=components&add=".$row["ID"]."\">+</a></td>";
			echo "<td><a href=\"view.php?view=components&remove=".$row["ID"]."\">-</a></td>";
		} else {
			echo "<td></td>";
			echo "<td></td>";
			echo "<td></td>";
		}

		echo "<td><a href=\"view.php?view=editcomponent&param1=".$row["ID"]."\">Edit</a></td>";

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

			$statement = $pdo->prepare("SELECT * FROM components WHERE storage = ?");
			$statement->execute(array($param1));

			while($row = $statement->fetch()) {
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
