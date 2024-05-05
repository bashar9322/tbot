<?php
// Check if the ID parameter is set in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "test";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // SQL to delete a record
    $sql = "DELETE FROM `product` WHERE `id` = $id";

    if ($connection->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $connection->error;
    }

    $connection->close();
} else {
    echo "ID parameter is missing in the URL";
}
?>
