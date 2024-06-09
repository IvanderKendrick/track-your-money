<?php 

session_start();

if (!isset($_SESSION["login"])){
    header("Location: index.html");
    exit;
}

require "functions.php";

$id = $_GET["id"];
$type = $_GET["type"];

if ( delete($id, $type) > 0 ) {
    echo "
        <script>
            alert('Data Deleted Successfully');
            document.location.href = 'main.php';
        </script>
        ";
} else {
    echo "
        <script>
            alert('Data Failed to be Deleted');
            document.location.href = 'main.php';
        </script>
        ";
}

?>
