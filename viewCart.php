<?php

    include 'header.php';
    include("include/connect.php");
    if(isset($_SESSION['user'])) {

        $prod = 0;
        $user = $_SESSION['user'];

        $query = "SELECT * FROM cost where username = '$user'" or die('dberror');
        $result = mysqli_query($conn,$query);

        $items = mysqli_num_rows($result);
        if ($items == 0) {
                $_SESSION['nocart'] = "No items in Cart!!";
            }

    } else {
        echo "<script>alert('You Are Not Logged In !! Please Login to access this page');</script>";
        echo "<script>alert(window.location='login.php');</script>";
    }

?>

<!doctype html>
<html lang="en">
<head>
</head>
<body>
<?php

if(isset($_SESSION['emptycart'])){
    $emptycard = $_SESSION['emptycart'];
}
?>

<div class="ui main container">
    <div class="ui grid">
        <div class="three wide column">
            <div class="ui vertical menu">

                <a class="items">
                    <a class="item" href="purchaseHistory.php?user=<?php echo $_SESSION['user']?>">
                    <button class="ui pinterest button"><h3>Purchase History</h3></button>
                    </a>
                </a>
            </div>
        </div>
        <div class="thirteen wide column">
            <div class="ui fluid message">
                <div class="ui items">
                <div class="item">
                    <h4>Here is the cart details:  <div style="float:right;">Total Items: <strong> <?php echo $items ?> </strong> </div></h4>
                    
                </div>
                </div>

            <?php
                $sum = 0;
                while ($cart = mysqli_fetch_assoc($result)) :
                    $pid = $cart['product_id'];
                    $qty = $cart['qty'];
                    //echo $qty;
                    $query1 = "SELECT * FROM product where id = '$pid'";
                    $result1 = mysqli_query($conn,$query1);
                    while ($row = mysqli_fetch_assoc($result1)):
            ?>
                <div class="ui info message">
                    <div class="ui items">
                        <div class="item">
                            <div class="image">
                                <img src='product_images/<?php echo $row["prod_image"]?>'>
                            </div>
                            <div class="content">
                                <a class="header"><h1><?php echo $row["name"];?></h1></a>
                                <div class="description">
                                    Price : Rs <?php echo $row["price"];?> <br>
                                    <div class="ui inverted section divider"></div>
                                    <?php
                                        $sum = $qty * $row['price'];
                                    ?>
                                    <form method="post" action="updateCart.php?id=<?php echo($cart['id']) ?>">
                                        <strong>Quantity : <input name='updateCart' value="<?php echo $qty; ?>"></strong>
                                        <input type="submit" name="submit" value="Update" class="ui brown button">
                                    </form>

                                    <a href="removeItem.php?id=<?php echo $row["product_id"]?>">
                                        <button style="float: right;" class="ui animated fade youtube button">Remove</button>
                                    </a>
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                    endwhile;
                endwhile;
                if ($items != 0) {
            ?>
                    <h2>
                        Total Price : Rs. <?php echo $sum; ?>
                    </h2>
            <?php       
                }
            ?>
            </div>
            <a class="item" href="checkout.php?user=<?php echo $_SESSION['user']?>" style="float: right; color: black;">
                <button class="ui brown button">CheckOut</button>
            </a>
        </div>
    </div>
</div>

</body>
</html>

<?php
    include 'footer.php';
?>