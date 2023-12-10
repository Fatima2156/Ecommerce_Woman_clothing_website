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
                            <h1 class="page-header">YOUR CART</h1>
                            <div class="box box-solid">
                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <th></th>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th width="20%">Quantity</th>
                                            <th>Subtotal</th>
                                        </thead>
                                        <tbody id="tbody">
                                            <!-- Cart items will be displayed here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php
                            if (isset($_SESSION['user'])) {
                                echo "<button id='checkout-button' class='btn btn-primary'>Checkout</button>";
                            } else {
                                echo "<h4>You need to <a href='login.php'>Login</a> to checkout.</h4>";
                            }
                            ?>
                        </div>
                        <div class="col-sm-3">
                            <?php include 'includes/sidebar.php'; ?>
                        </div>
                    </div>
                </section>

                <!-- Checkout Modal -->
                <div id="checkoutModal" class="modal">
                    <div class="modal-content checkout-content"
                        style="width: 387px; height: 525px; margin: auto; position: absolute; top: 0; left: 0; bottom: 0; right: 0;">
                        <span class="close"
                            style="margin-top: 20px; margin-right: 19px; font-size: 37px; cursor: pointer; color: #555;">&times;</span>
                        <h2 class="text-center">Checkout</h2>
                        <div id="checkoutDetails" class="text-left">
                            <!-- Product information will be displayed here -->
                        </div>
                        <form id="checkoutForm"
                            style="display: flex; align-items: center; justify-content: center; flex-direction: column; padding: 20px;">
                            <div class="form-group">
                                <label for="name" style="color: #555;">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="form-group">
                                <label for="phone" style="color: #555;">Phone Number:</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                            </div>

                            <div class="form-group">
                                <label for="address" style="color: #555;">Address:</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>

                            <div class="form-group">
                                <label for="city" style="color: #555;">City:</label>
                                <input type="text" class="form-control" id="city" name="city" required>
                            </div>

                            <div class="form-group">
                                <label for="postalCode" style="color: #555;">Postal Code:</label>
                                <input type="text" class="form-control" id="postalCode" name="postalCode" required>
                            </div>

                            <button type="button" id="submitBtn"
                                class="btn btn-primary"
                                style="background-color: #4CAF50; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer;">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'includes/footer.php'; ?>
    </div>

    <?php include 'includes/scripts.php'; ?>
    <script>
        var total = 0;

        $(function () {
            // Show the Checkout Modal
            $('#checkout-button').on('click', function () {
                $('#checkoutModal').css('display', 'block');
                displayCheckoutDetails();
            });

            // Close the Checkout Modal
            $('.close').on('click', function () {
                $('#checkoutModal').css('display', 'none');
            });

            // Submit Form and Redirect to a New Page
            $('#submitBtn').on('click', function () {
                // Gather form data
                var name = $('#name').val();
                var phone = $('#phone').val();
                var address = $('#address').val();
                var city = $('#city').val();
                var postalCode = $('#postalCode').val();

                // Redirect to a new page with the information and cart details
                window.location.href = 'new_page.php?' +
                    'name=' + encodeURIComponent(name) +
                    '&phone=' + encodeURIComponent(phone) +
                    '&address=' + encodeURIComponent(address) +
                    '&city=' + encodeURIComponent(city) +
                    '&postalCode=' + encodeURIComponent(postalCode) +
                    '&cart=' + encodeURIComponent(JSON.stringify(getCartDetails()));

                // Close the Checkout Modal
                $('#checkoutModal').css('display', 'none');
            });

            getDetails();
            getTotal();
        });

        function getDetails() {
            $.ajax({
                type: 'POST',
                url: 'cart_details.php',
                dataType: 'json',
                success: function (response) {
                    $('#tbody').html(response);
                    getCart();
                }
            });
        }

        function getTotal() {
            $.ajax({
                type: 'POST',
                url: 'cart_total.php',
                dataType: 'json',
                success: function (response) {
                    total = response;
                }
            });
        }

        function getCartDetails() {
            var cartDetails = [];

            // Fetch and push product information from the cart
            $.ajax({
                type: 'POST',
                url: 'get_cart_details.php',
                dataType: 'json',
                async: false, // Make the request synchronous
                success: function (response) {
                    for (var i = 0; i < response.length; i++) {
                        cartDetails.push({
                            name: response[i].name,
                            price: response[i].price,
                            // Add any other relevant details you want to pass
                        });
                    }
                }
            });

            return cartDetails;
        }

        function displayCheckoutDetails() {
            // Fetch and display product information from the cart
            $.ajax({
                type: 'POST',
                url: 'get_cart_details.php', // Change this to the actual file name handling cart details
                dataType: 'json',
                success: function (response) {
                    var checkoutDetails = $('#checkoutDetails');
                    checkoutDetails.empty();
                    for (var i = 0; i < response.length; i++) {
                        checkoutDetails.append('<p><strong>' + response[i].name + '</strong> - $' + response[i].price + '</p>');
                    }
                }
            });
        }
    </script>
</body>

</html>
