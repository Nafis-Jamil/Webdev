<?php
include('db-connection.php');
include('nav.php');
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_SESSION['login'];
    $type = $_POST['type'];
    $desc = $_POST['description'];
    $sql= "INSERT INTO `complaints` (`comp_id`, `cus_id`, `type`, `description`) VALUES ('NULL', '$id', '$type', '$desc');";
    $res= mysqli_query($conn, $sql);
    echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
    <strong>Successful!!</strong> We will Email you as soon as possible.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>About</title>
</head>

<body>

<div class="container my-5 text-center">
    <h3 class="text-info">About PiperNet</h3>  
</div>

<div class="container bg-light">
Beginning our journey in the year 2000, Link3 Technologies Limited is a leading IT solution provider offering a range of solutions including IP telephony, cybersecurity, Office 365 and fixed fiber broadband connections across both the retail and corporate markets of Bangladesh. In October of 2021, Link3 crossed 100k retail broadband connections, becoming the largest ISP in the country in terms of active subscribers. Link3 is also a pioneer in offering integrated solutions in the corporate sector of Bangladesh and is the only ISP connected with every bank in the country.

At Link3, we place the customer at the center of our business and our highly trained team of professionals ensure a level of quality and service which remain unmatched by any other player in the industry. We believe in innovating to simplify and in taking ownership of our actions and services. Whether it be people or organizations, we see it as our duty to enrich the lives of all our customers and to become the preferred choice for a digital lifestyle in the market.
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>