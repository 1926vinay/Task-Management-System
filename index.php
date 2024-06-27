<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
    <h2>List of Tasks</h2>
    <a class="btn btn-primary" href="/Task_Management_System/create.php" role="button">Add Tasks</a>
    <br>
    <table class="table">
        <thread>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Due Date</th>
                <th>Action</th>
            </tr>
        </thread>
        <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "task_management_system";

            //Create connection
            $connection = new mysqli($servername, $username, $password, $database);
            
            // Check connection
            if($connection->connect_error){
                die("Connection failed: " . $connection->$connect_error);
            }

            //read all the row from the database table
            $sql = "SELECT * FROM tasks";
            $result = $connection->query($sql);

            if(!$result){
                die("Invalid query: " . $connection->error);
            }

            //read the data of each row
            while($row = $result->fetch_assoc()){
                echo "
                <tr>
                <td>$row[id]</td>
                <td>$row[title]</td>
                <td>$row[description]</td>
                <td>$row[due_date]</td>
                <td>
                    <a class='btn btn-primary btn-sm' href='/Task_Management_System/edit.php?id=$row[id]'>Edit</a>
                    <a class='btn btn-danger btn-sm' href='/Task_Management_System/delete.php?id=$row[id]'>Delete</a>
                </td>
            </tr>
                ";
            }
            ?>
            
        </tbody>
    </table>
    </div>
</body>
</html>