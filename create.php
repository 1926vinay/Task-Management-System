<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "task_management_system";

//create connection
$connection = new mysqli($servername, $username, $password, $database);

$title = "";
$description= "";
$due_date = "";

$errorMessage = "";
$successMessage = "";

if( $_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = $_POST["title"];
    $description= $_POST["description"];
    $due_date = $_POST["due_date"];

    do{
        if(empty($title) || empty($description) || empty($due_date)){
            $errorMessage = "All fields are required";
            break;
        }

        //add new client to the datebase
        $sql = "INSERT INTO tasks (title, description, due_date) " . 
               "VALUES ('$title', '$description', '$due_date')";
        $result = $connection->query($sql);
        if(!$result){
            $errorMessage = "Invalid query. " . $connection->error;
            break;
        }
        
        $title = "";
        $description= "";
        $due_date = "";

        $successMessage = "Task added successfully";

        header("location: /Task_Management_System/index.php");
        exit;

    } while(false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Add Tasks</h2>

        <?php 
        if(!empty($errorMessage)){
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }

        ?>

        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-from-label">Title</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-from-label">Description</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="description" value="<?php echo $description; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-from-label">Due Date</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="due_date" value="<?php echo $due_date; ?>">
                </div>
            </div>

            <?php
              if(!empty($successMessage)){
                echo "
                <div class='row mb-3'>
                <div class='offset-sm-3 col-sm-6'>
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>$successMessage</strong>
                <button type='button' class=btm-close' data-bs-dismiss='alert' aria-label='Close'></button>
                ";
              }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/Task_Management_System/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>