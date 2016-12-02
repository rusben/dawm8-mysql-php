
<?php
$servername = "localhost";
$username = "root";
$password = "password";
$database = "dawm8-mysql-php";

###############################################################################
# Example (MySQLi Object-Oriented)
###############################################################################
echo "Example (MySQLi Object-Oriented)";
echo "<br/>";
// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if (mysqli_connect_error()) {
     die("Database connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
echo "<br/>";
###############################################################################
# Close connection (MySQLi Object-Oriented)
###############################################################################
$conn->close();

###############################################################################
# Example (MySQLi Procedural)
###############################################################################
echo "Example (MySQLi Procedural)";
echo "<br/>";
// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
echo "<br/>";
###############################################################################
# Close connection (MySQLi Procedural)
###############################################################################
mysqli_close($conn);

###############################################################################
# Example (PDO)
###############################################################################
echo "<br/>";
echo "Example (PDO)";
echo "<br/>";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";

    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
echo "<br/>";
###############################################################################
# Close connection (PDO)
###############################################################################
$conn = null; 

# Select Data With PDO (+ Prepared Statements)
# The following example uses prepared statements.

try {
//     $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set utf8 
    echo "----- Connection -----";
    echo "<br/>";
    $conn = new PDO("mysql:host=$servername;dbname=$database", 
                      $username,
    	              $password,
                      array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "----- ----- ----- ----- ----- ----- ----- ----- -----";
    echo "<br/>";

    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();

    //Binding parameters to prepared statements
    //$id = 1;
    //$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
    //$stmt->bindParam("id", $id);
    //$stmt->execute();

    // set the resulting array to associative
	$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Resultset - FETCH_ASSOC";
	echo "<pre>";
    print_r($users);
    echo "</pre>";

    $stmt->execute();
    // set the resulting array to associative
    $users = $stmt->fetchAll(PDO::FETCH_OBJ);
    echo "Resultset - FETCH_OBJ";
    echo "<pre>";
    print_r($users);
    echo "</pre>";

    $stmt->execute();
    // set the resulting array to associative
    $users = $stmt->fetchAll(PDO::FETCH_BOTH);
    echo "Resultset - FETCH_BOTH";
    echo "<pre>";
    print_r($users);
    echo "</pre>";

    $db = null;
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;



?>
