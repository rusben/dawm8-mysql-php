<?php
$servername = "localhost";
$username = "root";
$password = "password";
$database = "dawm8-mysql-php";

# Example (PDO)
# Delete Data With PDO (+ Prepared Statements)
# The following example uses prepared statements.

# We use PDO beacuse its portability
# We use prepared statements, because its enhaced security
# we use FETCH_ASSOC, theoretically faster because are basic types

try {

    // The id we do not delete
    $id=1;

    echo "----- Connection -----";
    echo "<br/>";
    $conn = new PDO("mysql:host=$servername;dbname=$database", 
                        $username,
                        $password,
                        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "----- ----- ----- ----- ----- ----- ----- ----- -----";
    echo "<br/>";

    echo "----- User (before deletes) -----";
    echo "<br/>";
    // Select all users (before deletes) 
    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->bindParam("id", $id);
    // Execute the SELECT
    $stmt->execute();
	$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
	echo "<pre>";
    print_r($users);
    echo "</pre>";
    echo "----- ----- ----- ----- ----- ----- ----- ----- -----";
    echo "<br/>";

    echo "----- Delete -----";
    echo "<br/>";
    $stmt = $conn->prepare("DELETE FROM users WHERE id<>:id");
    $stmt->bindParam("id", $id);

    // Execute the DELETE
    $stmt->execute();
    echo "----- ----- ----- ----- ----- ----- ----- ----- -----";
    echo "<br/>";

    echo "----- Users (after deletes) -----";
    echo "<br/>";
    // Select all users (after deletes) 
    $stmt = $conn->prepare("SELECT * FROM users");
    // Execute the SELECT
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<pre>";
    print_r($users);
    echo "</pre>";
    echo "----- ----- ----- ----- ----- ----- ----- ----- -----";
    echo "<br/>";

    // Close connection
    $db = null;
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

?>

