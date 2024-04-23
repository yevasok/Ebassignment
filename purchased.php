<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['proceed_purchase'])) {
    
    echo "Purchase recorded successfully.";
    
    header("Location: home.php");
    exit;
}


$selected_items = isset($_POST['selected_items']) ? $_POST['selected_items'] : [];
$total_cost = 0;


$host = "localhost";
$user = "newroot";
$password = "2505167";
$dbname = "ebassignment";

$connection = new mysqli($host, $user, $password, $dbname);


if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$selected_items_table_rows = '';

$selected_item_names = [];

if (!empty($selected_items)) {
    $selected_items_str = implode(",", $selected_items);
    $sql = "SELECT ID, Name, Description, Price FROM Items WHERE ID IN ($selected_items_str)";
    $result = $connection->query($sql);

    while ($row = $result->fetch_assoc()) {
        $total_cost += $row["Price"];
        
        $selected_item_names[] = $row["Name"];
        
        $selected_items_table_rows .= "<tr>";
        $selected_items_table_rows .= "<td>" . $row["ID"] . "</td>";
        $selected_items_table_rows .= "<td>" . $row["Name"] . "</td>";
        $selected_items_table_rows .= "<td>" . $row["Description"] . "</td>";
        $selected_items_table_rows .= "<td>$" . $row["Price"] . "</td>";
        $selected_items_table_rows .= "</tr>";
    }

    $visitor_name = $_POST['custname'];
 
    $selected_items_str = implode(", ", $selected_item_names);
    $insert_query = "INSERT INTO purchases (visitor_name, datetime, item, totalcost) VALUES ('$visitor_name', CURRENT_TIMESTAMP, '$selected_items_str', $total_cost)";
    if ($connection->query($insert_query) !== TRUE) {
        echo "Error: " . $insert_query . "<br>" . $connection->error;
    }
}

// Calculate total price excluding VAT and total price including VAT
$total_price_excluding_vat = $total_cost;
$total_price_including_vat = $total_cost * 1.175;

// Round to the nearest penny
$total_price_excluding_vat = round($total_price_excluding_vat, 2);
$total_price_including_vat = round($total_price_including_vat, 2);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Purchased</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="purchased.css" />
    <script>
    function showThankYou() {
        alert("Thank you for your purchase!");
    }
    </script>
</head>
<body>
<h1>Purchased Items</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <?php echo $selected_items_table_rows; ?>
    </tbody>
</table>
<p>Total Cost (Excluding VAT): $<?php echo $total_price_excluding_vat; ?></p>
<p>Total Cost (Including VAT): $<?php echo $total_price_including_vat; ?></p>
<form action="purchased.php" method="post">
    <input type="submit" name="proceed_purchase" value="Proceed with Purchase" onclick="showThankYou()">
    <a href="items.php">Back to Items Page</a>
    <a href="home.php">Back to Home Page</a>
    <a href="http://validator.w3.org/check?uri=referer">
        <img src="valid-html5.gif" alt="Valid HTML 5" height="31" width="88">	
	</a>
    <a href="http://jigsaw.w3.org/css-validator/check/referer">
        <img src="vcss.gif" alt="Validate" width="88" height="31">
    </a>
</form>
</body>
</html>
