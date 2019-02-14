<?php
include ('../include/connect.php');

    $id = $_GET['id'];

    $query = "SELECT * from category where id = '$id'";
    $result = mysqli_query($conn,$query) or die("db error");
    $row = mysqli_fetch_assoc($result);


if (isset($_POST['submit'])){

    $name = $_POST['name'];
    $description = $_POST['description'];
    
    $query1 = "UPDATE category SET name = '$name', description = '$description' WHERE id = '$id'";
    $result1 = mysqli_query($conn,$query) or die("cannot get connected");

    if($result1){
        $message = "Description Edited";
        header("Location:../admindashboard.php");
    }
    else{
        $message = "There is an error";
    }


}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../css/semantic.min.css">
    <link rel="stylesheet" href="../css/custom.css">
</head>
<body>
<div class="ui one column center aligned grid">
    <div class="column three wide form-holder">
        <h1>Add category</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="ui form">
                <div class="field">
                    <input type="text" value="<?php echo($row['name']) ?>" name="name">
                </div>
                <div class="field">
                    <input type="text" value="<?php echo($row['description']) ?>" name="description" required>
                </div>
                <div class="field">
                    <input type="submit" name="submit" value="Submit" class="ui button large fluid green">
                </div>
        </form>
    </div>
</div>
<script src="../js/semantic.min.js"></script>
</body>
</html>