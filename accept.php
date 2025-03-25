<?php
session_start();

include("includes/conn.php");
$id = $_GET['id'];
echo $id;
if(isset($id) && !empty($id)){
    // Include config file
    $status = "Verified";
    // Prepare a delete statement
    $sql = "UPDATE `team_tbl` SET `status`= '$status' WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    // Close connection
    mysqli_close($conn);
    header("location: dashboard.php");

} else{
    // Check existence of id parameter
    if(empty(trim($_GET["id"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
