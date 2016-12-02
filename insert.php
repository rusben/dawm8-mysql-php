<?php
$servername = "localhost";
$username = "root";
$password = "password";
$database = "dawm8-mysql-php";

# Example (PDO)
# Insert Data With PDO (+ Prepared Statements)
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

    $id = 1;
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "----- ----- ----- ----- ----- ----- ----- ----- -----";
    echo "<br/>";

    echo "----- User (before insert) -----";
    echo "<br/>";
    // Select all users (before insert) 
    $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
    $stmt->bindParam("id", $id);
    // Execute the SELECT
    $stmt->execute();
    $users = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo "<pre>";
    print_r($users);
    echo "</pre>";
    echo "----- ----- ----- ----- ----- ----- ----- ----- -----";
    echo "<br/>";

    $userEmail = rand()."@proven.cat";
    $userName = rand();
    $userSurname = rand();
    $userRegistered = gmdate('Y-m-d h:i:s');
    $userLastLogin = gmdate('Y-m-d h:i:s');
    $userPassword = "1234";

    echo "----- Insert (each attribute a variable) -----";
    echo "<pre>";
    echo $userEmail;
    echo "<br/>";
    echo $userName;
    echo "<br/>";
    echo $userSurname;
    echo "<br/>";
    echo $userRegistered;
    echo "<br/>";
    echo $userLastLogin;
    echo "<br/>";
    echo $userPassword;
    echo "</pre>";

    $stmt = $conn->prepare("INSERT INTO users (email, name, surname, registered, lastLogin, password) VALUES (:email, :name, :surname, :registered, :lastLogin, :password)");
    
    $stmt->bindParam("email", $userEmail);
    $stmt->bindParam("name", $userName);
    $stmt->bindParam("surname", $userSurname);
    $stmt->bindParam("registered", $userRegistered);
    $stmt->bindParam("lastLogin", $userLastLogin);
    $stmt->bindParam("password", $userPassword);

    // Execute the INSERT
    $stmt->execute();
    echo "----- ----- ----- ----- ----- ----- ----- ----- -----";
    echo "<br/>";


    echo "----- Insert (array key => value) -----";
    echo "<br/>";
    $params = array("email" => rand()."@proven.cat",
                    "name" => rand(),
                    "surname" => rand(),
                    "registered" => gmdate('Y-m-d h:i:s'),
                    "lastLogin" => gmdate('Y-m-d h:i:s'),
                    "password" => "1234"
                    );
    echo "<pre>";
    print_r($params);
    echo "</pre>";

    $stmt = $conn->prepare("INSERT INTO users (id, email, name, surname, registered, lastLogin, password) VALUES (NULL, :email, :name, :surname, :registered, :lastLogin, :password)");
    
    $stmt->bindParam("email", $params['email']);
    $stmt->bindParam("name", $params['name']);
    $stmt->bindParam("surname", $params['surname']);
    $stmt->bindParam("registered", $params['registered']);
    $stmt->bindParam("lastLogin", $params['lastLogin']);
    $stmt->bindParam("password", $params['password']);

    // Execute the INSERT
    $stmt->execute();
    echo "----- ----- ----- ----- ----- ----- ----- ----- -----";
    echo "<br/>";

    echo "----- User (after inserts) -----";
    echo "<br/>";
    // Select all users (after inserts) 
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

