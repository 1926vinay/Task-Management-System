<?php
if(isset($_GET["id"])){
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "task_management_system";

    //Create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM tasks WHERE id=$id";
    $connection->query($sql);
}

header("location: /Task_Management_System/index.php");
exit;
?>