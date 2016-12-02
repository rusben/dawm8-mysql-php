<?php
$servername = "localhost";
$username = "root";
$password = "password";
$database = "dawm8-mysql-php";

# Example (PDO)
# Select Data With PDO (+ Prepared Statements)
# The following example uses prepared statements.

# We use PDO beacuse its portability
# We use prepared statements, because its enhaced security
# we use FETCH_ASSOC, theoretically faster because are basic types

try {

    echo "----- Connection -----";
    echo "<br/>";
    $conn = new PDO("mysql:host=$servername;dbname=$database", 
                        $username,
                        $password,
                        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "----- ----- ----- ----- ----- ----- ----- ----- -----";
    echo "<br/>";

    echo "----- SELECT without prepared statement - YOU MUST NEVER USE IT! -----";
    // YOU MUST NEVER USE THE LINE BELOW
    $stmt = $conn->prepare("SELECT * FROM users WHERE email='rarroyo2@xtec.cat'");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<pre>";
    print_r($users);
    echo "</pre>";
    echo "----- ----- ----- ----- ----- ----- ----- ----- -----";
    echo "<br/>";

    echo "----- SELECT with prepared statement -----";
    $userEmail = "rarroyo2@xtec.cat";
    $stmt = $conn->prepare("SELECT * FROM users WHERE email= :email");
    $stmt->bindParam("email", $userEmail);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
    echo "<pre>";
    print_r($users);
    echo "</pre>";
    echo "----- ----- ----- ----- ----- ----- ----- ----- -----";
    echo "<br/>";

    echo "----- SELECT all users -----";
    $stmt = $conn->prepare("SELECT * FROM users");
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
