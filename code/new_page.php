
<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert alert-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
                        unset($_SESSION['cart']);
	        		?>
                    <center>
	        		 <h1> Your ORDER has been placed successfully.</h1>
                     <h2>Thank you for your shopping!</h2>
                    </center>
                    <br><br>

    <?php

        // Retrieve submitted information from URL parameters
        
        $name = $_GET['name'] ?? '';
        $phone = $_GET['phone'] ?? '';
        $address = $_GET['address'] ?? '';
        $city = $_GET['city'] ?? '';
        $postalCode = $_GET['postalCode'] ?? '';


        // Retrieve cart details from URL parameters
        $cart = json_decode($_GET['cart'] ?? '[]', true);

        // Display the submitted information
        echo "<h4><b>Name:</b> $name</h4>";
        echo "<h4><b>Phone Number:</b> $phone</h4>";
        echo "<h4><b>Address:</b> $address</h4>";
        echo "<h4><b>City:</b> $city</h4>";
        echo "<h4><b>Postal Code:</b> $postalCode</h4>";

        // Display the cart details
        if (!empty($cart)) {
            echo "<h2>Ordered Items:</h2>";
            echo "<ul>";
            foreach ($cart as $item) {
                echo "<li><strong>{$item['name']}</strong> - ${$item['price']}</li>";
                // Display any other relevant details
            }
            echo "</ul>";
        } 
        unset($_SESSION['cart']);
    ?>

    <!-- Add a link to another page -->
    <h4><b>Continue shopping:</b> <a href="index.php">Go back to the store</a></h4>
    <h4><b>Continue shopping:</b> <a href="cart_view.php">View your order</a></h4><br><br>
	        	</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>