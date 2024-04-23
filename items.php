<?php
$host = "localhost";
$user = "newroot";
$password = "2505167";
$dbname = "ebassignment";

$connection = new mysqli($host, $user, $password, $dbname);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$sql = "SELECT ID, Name, Description, Price, Picture FROM Items";
$result = $connection->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Location: purchased.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Items</title>
    <link rel="stylesheet" type="text/css" href="itemsp.css">
    <script>
        function validateForm() {
            var custname = document.getElementById("custname").value;
            if (custname == "") {
                alert("Please enter your customer name.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <h1>Items</h1>
    <form action="purchased.php" method="post" onsubmit="return validateForm()">
        <label for="custname">Please enter your customer name:</label>
        <input type="text" id="custname" name="custname" size="15" value=""><br>
        
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Picture</th>
                    <th>Select</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["ID"] . "</td>";
                    echo "<td>" . $row["Name"] . "</td>";
                    echo "<td>" . $row["Description"] . "</td>";
                    echo "<td>" . $row["Price"] . "</td>";
                    echo "<td><img src='" . $row["Picture"] . "' alt='Item Picture' width='100'></td>";
                    echo "<td><input type='checkbox' name='selected_items[]' value='" . $row["ID"] . "'></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <br>
        <input type="submit" name="submit" value="Purchase"> 
        <a href="home.php">Back to Home Page</a>
<a href="http://validator.w3.org/check?uri=referer">
<img src="valid-html5.gif" alt="Valid HTML 5" height="31" width="88"></a>
<a href="http://jigsaw.w3.org/css-validator/check/referer">
<img src="vcss.gif" alt="Validate" width="88" height="31"></a>
    </form>
</body>
</html>

