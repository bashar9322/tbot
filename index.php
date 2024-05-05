<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>my shop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="margin: 50px;">
    <h1>list of product</h1>
    <a class="btn btn-primary" href="create.php" role="button">New product</a>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>name of product</th>
                <th>price</th>
                <th>number of product</th>
                <th>created_at</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "test";


            //create connection
            $connection = new mysqli($servername, $username, $password, $database);

            //check connection
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }
            //read all row from database table
            $sql = "SELECT * FROM `product`";
            $result = $connection->query($sql);

            if (!$result){
                die("Invalid query: " . $connection->error);
            }

            //read data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["name_sql"] . "</td>
                <td>" . $row["price_sql"] . "</td>
                <td>" . $row["count_sql"] . "</td>
                <td>" . $row["created_at"] . "</td>
                <td>
                    <a class='btn btn-primary btm-sm' href='edit.php'>Edit</a>
                    <a class='btn btn-danger btm-sm' href='delete.php?id=<?php echo $row["id"]; ?>'>Delete</a>
                </td>
            </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>