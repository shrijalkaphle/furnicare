<?php

session_start();

include ('include/connect.php');

if(isset($_SESSION['user'])){
    $currentUser = $_SESSION['user'];
    $sql = " select * from product JOIN  checkout ON product.id = checkout.p_id WHERE uname = '$currentUser'";
    $details = mysqli_query($conn, $sql);

    if (mysqli_num_rows($details) == 0){
        $nohistory = " You have not purchased anything Yet. Start Shopping";
    }

}

?>

<!doctype html>
<html lang="en">
<head>
</head>
<body>
<?php
include ('header.php');
?>
<!---- content box--->
<div class="ui main container">
    <?php if (!mysqli_num_rows($details) == 0){ ?>
    <h1> Dear <?php echo $currentUser ?>,
        You have purchased following products from Us</h1>
    <?php } else {?> <h2> <?php echo $nohistory ?> </h2><?php }?>
    <div class="ui fluid message">
        <table border="1" class="ui table">
            <thead>
            <th>Product</th>
            <th>Category</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            </thead>
            <tbody>
            <?php
            $sum = 0;
            while ($row = mysqli_fetch_assoc($details))
            {
                ?>
                <tr>
                    <td><?php echo $row["name"]; ?></td>
                    <td>
                        <?php 
                            $id = $row["category_id"];
                            $query = "SELECT * FROM category WHERE id = '$id'";
                            $result = mysqli_query($conn,$query);
                            $r = mysqli_fetch_assoc($result);
                            echo $r['name'];
                        ?>
                            
                    </td>
                    <td><?php echo $row["description"]; ?></td>
                    <td><?php echo $row["price"] ?></td>
                    <td><?php echo $row["qty"] ?></td>

                    <td><?php echo $row['qty']*($row['price']);
                        $sum = $sum + $row['qty']*($row['price']);
                        ?></td>
                </tr>

            <?php }?>   
            <h3>Total sum : Rs <?php echo $sum ?> </h3>
            </tbody>

        </table>
</div>
</div>
<!----- footer------>
<?php include ('footer.php')?>
</body>
</html>
