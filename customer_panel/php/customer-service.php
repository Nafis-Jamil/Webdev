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
    <title>Document</title>
</head>

<body>

<div class="container my-5 text-center">
    <h3><span class="display-3 text-danger"><b>24/7</b></span> At Your Service</h3>  
</div>

<div class="container">
    <form action="http://localhost/PiperNet/customer_panel/php/customer-service.php" method="post">
    <div class="container my-3">
    <label for="type" class="form-label text-danger"><b>Service Type</b></label>
    <br>
    <select class="form-select form-select-sm bg-dark text-white"  style="width:auto" id="type" name="type" required>
        <option value="Connection Issue">Connection Issue</option>
        <option value="Payment Issue">Payment Issue</option>
        <option value="Complaint">Complaint</option>
        <option value="Feedback">Feedback</option>
    </select>
    </div>
    <div class="container my-3">
    <label for="desc" class="form-label text-danger"><b>Description</b></label>
    <br>
    <textarea class="my-2 bg-light" name="description" id="desc" cols="80" rows="10" maxlength="200" placeholder="Describe in 200 characters"></textarea>
    </div>
    <div class="container my-3">
        <input class="btn btn-md btn-danger" type="submit" value="Submit">
    </div>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>