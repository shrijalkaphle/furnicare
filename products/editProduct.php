<?php
    
    $id = $_GET['id'];
    
    include('../include/connect.php');
    $query = "SELECT * from product where id = '$id'";
    $result = mysqli_query($conn,$query) or die("db error");
    
    $row = mysqli_fetch_assoc($result);
    
    
    if (isset($_POST['submit'])) {

    $target = "../product_images/".basename($_FILES['prod_image']['name']);

    $name = $_POST['productname'];
    $category_id = $_POST['selectcat'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $prod_image = $_FILES['prod_image']['name'];


    if ($prod_image == "") {
        $query2 = "UPDATE product SET category_id = '$category_id', name = '$name', description = '$description',price = '$price' WHERE id = '$id'";
        mysqli_query($conn, $query2) or die("db error");
         header("Location:../admindashboard.php");       
    } else {

    $query2 = "UPDATE product SET category_id = '$category_id', name = '$name', description = '$description',price = '$price', prod_image = '$prod_image' WHERE id = '$id'";
    mysqli_query($conn, $query2) or die("db error");

    if (move_uploaded_file($_FILES['prod_image']['tmp_name'], $target)) {
        $message = "Description Submitted";
        header("Location:../admindashboard.php");
    } else {
        $message = "There is an error";
    }
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
        <h1>Edit Product</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="ui form">
                <div class="field">
                    <input type="text" placeholder="name" name="name" value="<?php echo $row["name"]; ?>">
                </div>
                <div class="field">
                    <select name="selectcat">
                        <?php
                        $query1 = "select * from category";
                        $result = mysqli_query($conn, $query1);
                        while($row1 = mysqli_fetch_assoc($result))
                        {
                        ?>
                        <option <?php if ($row['category_id'] == $row1['id']) {?> selected <?php } ?> value="<?php echo $row1['id']?>"><?php echo $row1['name']?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="field">
                    <input type="text" placeholder="description" value="<?php echo $row["description"]; ?>" name="description" required>
                </div>
                <div class="field">
                    <input type="number" placeholder="price" name="price" value="<?php echo $row["price"]; ?>" required>
                </div>
                <div class="field">
                    Upload Image: <input type="file" placeholder="Upload Image" name="cat_image" id="cat_image">
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