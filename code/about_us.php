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
	        		?>
	        		<h2>About Us</h2>
					<p>Welcome to <strong>FXLV</strong> – your ultimate source for the latest in women's fashion! Our journey began as a semester project, fueled by a shared love for fashion and a desire to create an inclusive space for women to express their unique style.</p>
					<h3>Get in Touch</h3>
					<p>Have questions or just want to say hello? We're here for you! Reach out to us at <a href="mailto:contact@fxlv.pk">contact@fxlv.pk</a>, and our team will respond promptly.</p>

					<p>Thank you for being a part of <strong>FXLV</strong>. Let's make every day a stylish one!</p>
				</div>
	        	<div class="col-sm-3">
					<br>
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