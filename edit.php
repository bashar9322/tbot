<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "test";


//create connection
$connection = new mysqli($servername, $username, $password, $database);

    $id ="";
    $name_sql = "";
    $price_sql = "";

    $errorMessage = "";
    $successMessage = "";

if ( $_SERVER["REQUEST_METHOD"] =='GET') {
    // GET method: Show the data of the client
    if (!isset($_GET["id"])) {
        header("location: index.php");
        exit;
    }
    $id = $_GET["id"];

    // read the row of the selected client from database table
    $sql = "SELECT * FROM product WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: index.php");
        exit;
    }
    $name_sql = $row["name"];
    $price_sql = $row["price"];
}
else{
    // POST method: Update the data of the product
    $id = $_POST['id'];
    $name_sql = $_POST['name'];
    $price_sql = $_POST['price'];

    do{
        if (empty($id) || empty($name_sql) || empty($price_sql)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE product " .
                "SET name='$name_sql', price='$price_sql' " .
                "WHERE id = $id";

        $result = $connection->query($sql);

        if (!$result){
            $errorMessage = "Invalid query : " . $connection->error;
            break;
        }

        $successMessage = "Product updated successfully";

        header("location: index.php");
        exit;
    }while (false);
}

?>
ype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>my shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<div class="container my-5">
    <h2>New Client</h2>

    <?php
    if ( !empty($errorMessage)) {
        echo  "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                  <strong>Warning!</strong> $errorMessage
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
    }
    ?>

    <form method="post">
        <input type="hidden" value="<?php echo $id; ?>">
        <div class="row-mb-3">
            <label class="col-sm-3 col-form-label">name of product</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="name_of_product" value="<?php echo $name_sql; ?>">
            </div>
        </div>
        <div class="row-mb-3">
            <label class="col-sm-3 col-form-label">price</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="price" value="<?php echo $price_sql; ?>">
            </div>
        </div>

        <?php
        if (!empty($successMessage)) {
            echo "
    <div class='row mb-3'>
        <div class='offset-sm-3 col-sm-6'>
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Success!</strong> $successMessage
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        </div>
    </div>";
        }
        ?>

        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-outline-primary" href="index.php" role="button">Cancel</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>