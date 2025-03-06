<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $sql = "DELETE FROM tour_packages WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "Package deleted successfully!";
    } else {
        echo "Error deleting package: " . mysqli_error($conn);
    }
}
?>

?>




