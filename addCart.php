<?php
	include("include/connect.php");
	session_start();

	if (isset($_SESSION['user'])) {
		if ($_SESSION['role'] != "admin") {
			$user = $_SESSION['user'];
			$pid = $_GET['id'];
			$new_qty = $_POST['qty'];
			
			$checkProduct = "SELECT * FROM cost where username = '$user' && product_id = '$pid'";
			$result0 = mysqli_query($conn,$checkProduct);
			$row = mysqli_fetch_assoc($result0);
			if($row) {
				$id = $row['id'];
				$qty = $row['qty'];
				$qty = $qty + $new_qty;
				echo $qty;
				$query = "UPDATE cost SET qty='$qty' WHERE id = '$id'" or die("error");
				$result = mysqli_query($conn,$query);
			
				echo "<script>alert('Product Updated in Cart !!');</script>";
				echo "<script>window.location='products.php?id=$cid';</script>";
			
			} else {
				$query1 = "INSERT INTO cost(username, product_id, qty) VALUES ('$user','$pid','$new_qty')"  or die("error");
				$result1 = mysqli_query($conn,$query1);

				echo "<script>alert('Product Added in Cart !!');</script>";
				echo "<script>window.location='viewCart.php';</script>";
			}
		} else {
			echo "<script>alert('Login as a User !!');</script>";
			echo "<script>window.location='productDetails.php?id=$pid';</script>";
		}

	} else {
		echo "<script>alert('Login to add product to Cart !!');</script>";
		echo "<script>window.location='login.php';</script>";
	}

?>