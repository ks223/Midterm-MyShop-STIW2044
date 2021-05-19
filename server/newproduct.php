<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "myshopdb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$prname = $_POST['prname'];
$prtype = $_POST['prtype'];
$prprice = $_POST['prprice'];
$prqty = $_POST['prqty'];
$encoded_string = $_POST["encoded_string"];

$sqlinsert = "INSERT INTO tbl_products(prname,prtype,prprice,prqty) VALUES('$prname','$prtype','$prprice','$prqty')";
if($conn->query($sqlinsert) === TRUE) {
    $decoded_string = base64_decode($encoded_string);
    $filename = mysqli_insert_id($conn);
    $path = '../images/products/'.$filename.'.png';
    $is_written = file_put_contents($path,$decoded_string);
    echo "success";
}
else {
    echo "failed";
}
?>