<?php

$host = "localhost";
$user = "newroot";
$password = "2505167";
$dbname = "ebassignment";

$connection = new mysqli($host, $user, $password, $dbname);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$sql = "SELECT p.visitor_name AS customer_name, p.ID, p.datetime, p.item, p.totalcost 
        FROM purchases p";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Customers and Purchases</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: pink;
    color: black;
    margin: 0;
    padding: 0;
}

h2 {
    text-align: center;
    color: white;
    margin-top: 0;
    padding-top: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: white; /* Set table background to white */
}

th, td {
    border: 1px solid #dddddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

a {
    text-decoration: none;
    color: black;
    display: block;
    text-align: center;
    margin-top: 20px;
}

a:hover {
    color: white;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    background-color: rgba(0, 0, 0, 0.5);
    padding: 20px;
    border-radius: 10px;
}

    </style>
</head>
<body>
    <h2>List of Customers and Purchases</h2>
    <table>
        <thead>
            <tr>
                <th>Customer</th>
                <th>ID</th>
                <th>Date & Time</th>
                <th>Items</th>
                <th>Total Cost</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["customer_name"] . "</td>";
                    echo "<td>" . $row["ID"] . "</td>";
                    echo "<td>" . $row["datetime"] . "</td>";
                    echo "<td>" . $row["item"] . "</td>";
                    echo "<td>$" . $row["totalcost"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No customers found.</td></tr>";
            }
            ?>
			
        </tbody>
    </table>
	<a href="items.php">Back to Items Page</a>
    <a href="home.php">Back to Home Page</a>
<a href="http://validator.w3.org/check?uri=referer">
<img src="valid-html5.gif" alt="Valid HTML 5" height="31" width="88"></a>
<a href="http://jigsaw.w3.org/css-validator/check/referer">
<img src="vcss.gif" alt="Validate" width="88" height="31"></a>
</body>
</html>
 
