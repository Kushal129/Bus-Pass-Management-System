<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/Payment.css">
    <link rel="stylesheet" href="js/Payment.js">

</head>

<body>

    <div class="site-blocks-cover" style="height: 950px; width: 98.9vw"
        data-aos="fade" data-stellar-background-ratio="0.5">

        <div class="container" style="height: 770px; margin-top: 50px;">
            <div class="row justify-align-center align-items-center">
                <div class="col">
                    <div class="header">
                        <h2 style="text-shadow: 1px 1px 2px;">PAYMENT</h2>
                    </div>
                    <form class="form" id="form">
                        <div class="form-control">
                            <!-- <label for="email">Card</label>
                            <a href=""><img src="img/visa.png" style="width: 70px; margin-bottom: 5px;" alt=""></a>
                            <a href=""><img src="img/mastercard.png" style="width: 80px; margin-bottom: 5px;"
                                    alt=""></a>
                            <small></small> -->
                        </div>

                        <div class="form-control">
                            <label for="payment">Payment</label>
                            <div id="payment"
                                style="display: block; height: 43px; width: 100%; padding: 10px; border-radius: 5px; outline: none; border: 2px solid #f0f0f0;">
                            </div>
                            <small></small>
                        </div>

                        <div class="form-control">
                            <label for="name">Name on Card</label>
                            <input type="text" id="name" placeholder="Enter Your Name">
                            <i class="fa fa-check-circle"></i>
                            <i class="fa fa-exclamation-circle"></i>
                            <small></small>
                        </div>

                        <div class="form-control">
                            <label for="num">Card Number</label>
                            <input type="text" id="num" placeholder="Enter Card Number">
                            <i class="fa fa-check-circle"></i>
                            <i class="fa fa-exclamation-circle"></i>
                            <small>Error msg</small>
                        </div>

                        <div class="form-control">
                            <label for="expdate">Expire Month</label>
                            <input type="text" id="expdate" placeholder="mm/yyyy">
                            <i class="fa fa-check-circle"></i>
                            <i class="fa fa-exclamation-circle"></i>
                            <small>Error msg</small>
                        </div>

                        <div class="form-control">
                            <label for="cvv">CVV</label>
                            <input type="password" id="cvv" name="cvv" placeholder="Enter CVV">
                            <i class="fa fa-check-circle"></i>
                            <i class="fa fa-exclamation-circle"></i>
                            <small>Error msg</small>
                        </div>
                        <div class="button">
                            <button onclick="location.href='php/index.php'"
                                style="color: white; text-decoration: none;">Previous</button>
                            <button type="submit" style="color: white; text-decoration: none;">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="js/Payment.js"></script>

</body>

</html>