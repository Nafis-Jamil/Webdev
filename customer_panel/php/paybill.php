<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Pay Bill</title>
</head>

<body>
   <div class="container my-5 text-center">
    <h3>Pay, Stay Connected</h3>
   </div>

    <div class="container my-5">

        <div class="row row justify-content-center">
            
            <div class="col-md-3">
                <div class="pay-method-top">
                    <img src="https://selfcare.link3.net/themes/default/payonline/resources//images/pay-online.png"
                        alt="" style="width: 250px;">
                </div>
            </div>

            <div class="col-md-3 bg-light">
                <form method="post" action="http://localhost/PiperNet/customer_panel/php/checkout.php">
                    <div class="enter-customer-id">
                        <h4>Pay through online </h4>
                        <h5>Enter customer ID:</h5>
                        <div><input type="text" name="customer_id" value="<?php echo $_SESSION['login'];?>"></div>
                    </div>
                    <div class="button-group my-2">
                        <input type="submit" class="btn btn-sm btn-info" value="Next">
                    </div>
                </form>
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>

</body>

</html>