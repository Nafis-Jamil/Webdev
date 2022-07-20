<?php
include('db-connection.php');
include('nav.php');
?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['name'])) {
        
        $date = date("Y/m/d");
        $name= $_POST["name"];
        $contact= $_POST["phone"];
        $email = $_POST["email"];
        $address= $_POST["address"];
        $pid= $_POST["package"];
        $insert_sql = "INSERT INTO `requests` (`rid`, `date`, `status`, `name`, `contact`, `email`, `address`, `pack_id`) VALUES ('NULL', '$date', '0', '$name', '$contact', '$email', '$address', '$pid');";
        $res = mysqli_query($conn, $insert_sql);
        if ($res) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Successful!!</strong> Your Request Has Been Sent. Please Check Your Email For Further Update.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
    
    }
  
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
    <link rel="stylesheet" href="../css/style.css">
    <title>Home</title>
</head>

<body>


    <!-- Modal -->
    <div class="modal fade" id="buyModal" tabindex="-1" aria-labelledby="buyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="buyModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="reqForm" action="http://localhost/PiperNet/customer_panel/php/index.php" method="post">
                        <input type="hidden" id="sid">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Contact No.</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Area,Sub-district,District" required>
                        </div>

                        <div class="mb-3">
                            <label for="package" class="form-label">Address</label>
                            <select class="form-select form-select-sm" id="package" name="package" required>
                                <?php
                                $show_sql = 'SELECT `id` , `name` FROM `packages` ORDER BY `packages`.`price` ASC;';
                                $result = mysqli_query($conn, $show_sql);
                                $check = mysqli_num_rows($result);
                                if ($check > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option id='o$row[id]' value='$row[id]'>$row[name]</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>



                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="reqForm" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#myCarousel" data-bs-slide-to="1"></li>
            <li data-bs-target="#myCarousel" data-bs-slide-to="2"></li>

        </ol>
        <div class="carousel-inner">

            <div class="carousel-item active">
                <div class="overlay-image" style="background-image:url(../images/bg-3.jpg)"></div>

                <div class="container item-container">
                    <h1>Piper Net</h1>
                    <p>Don't Suffer The Buffer</p>
                    <a href="http://localhost/piperNet/customer_panel/php/about.php" class="btn btn-secondary">
                        Know More About Us
                    </a>
                </div>

            </div>

            <div class="carousel-item">
                <div class="overlay-image" style="background-image:url(../images/connection.jpg)"></div>
                <div class="container item-container">
                    <h1>Need New Connection?</h1>
                    <p>Piper Net provides a bufferless internet experience at reasonable price</p>
                    <a href="http://localhost/piperNet/customer_panel/php/packages.php" class="btn btn-success">
                        Check Out Our Packages
                    </a>
                </div>

            </div>

            <div class="carousel-item">
                <div class="overlay-image" style="background-image:url(../images/pay.png)"></div>
                <div class="container item-container">
                    <h1>Pay Your Bill & Stay Connected</h1>
                    <p>Pay your bill with Bkash or Nagad</p>
                    <a href="http://localhost/piperNet/customer_panel/php/paybill.php" class="btn btn-lg btn-warning">
                        Payment
                    </a>
                </div>

            </div>
        </div>
        <a href="#myCarousel" class="carousel-control-prev" role="button" data-bs-slide="prev">
            <span class="sr-only"> </span>
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>

        <a href="#myCarousel" class="carousel-control-next" role="button" data-bs-slide="next">
            <span class="sr-only"> </span>
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </a>
    </div>

    <section id="package-home" class="bg-light mt-5 py-3">
        <div class="container-lg">
            <div class="text-center">
                <h2>Popular Packages</h2>
                <p class="lead text-muted">Choose a package plan suited for you</p>
            </div>

            <div class='row my-5 align-items-center justify-content-center g-3'>

                <?php
                $show_sql = 'SELECT * FROM `packages` ORDER BY `packages`.`popularity` DESC';
                $result = mysqli_query($conn, $show_sql);
                $check = mysqli_num_rows($result);
                if ($check > 0) {

                    for ($i = 0; $i < 4; $i++) {
                        $row = mysqli_fetch_assoc($result);
                        echo "<div class='col-12 col-md-6 col-xl-3'>
                        <div class='card border-0'>
                            <div class='card-body text-center py-4'>
                                <h4 class='card-title'>
                                   $row[name]
                                </h4>
                                <p class='display-5 my-4 text-info fw-bold'>
                                    $row[speed] Mbps
                                 </p>
                                <p class='display-5 my-4 text-warning fw-bold'>
                                   $row[price]&#2547 
                                </p>
                                <p class='card-text mx-5 text-muted d-none d-lg-block'>$row[description]</p>
                                <button class='btn btn-lg btn-outline-primary mt-3 buy' id='$row[id]'>Buy Package</button>
                            </div>
                        </div>
                    </div>";
                    }
                }
                ?>
            </div>

        </div>
        </div>
        <div class="text-center my-3">
            <a href="http://localhost/piperNet/customer_panel/php/packages.php" class="btn btn-lg btn-outline-primary">
                See All Packages
            </a>
        </div>
    </section>

    <section id="form-home" class="bg-light mt-5 py-4">

        <div class="container">
            <div class="row my-5 align-items-center justify-content-center g-3">
                <div class="col-md-12 col-lg-6">
                    <div class="container" id="cs-id">
                        <div class="cs-img" style="background-image:url(../images/customer_service.png);"></div>
                        <div class="cs-btn">
                        <?php
                          if(isset($_SESSION['login'])){
                           echo " <a href='http://localhost/piperNet/customer_panel/php/customer-service.php' class='btn btn-lg btn-success'>24 Hour Customer Service</a>";
                          }
                          else{
                            echo "<button class='btn btn-lg btn-success' id='cslogin'>24 Hour Customer Service</button>";
                          }
                        ?>
                        
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script>
            buys = document.getElementsByClassName("buy");
    Array.from(buys).forEach((element) => {
      element.addEventListener("click", (e) => {
        bttn = e.target;
        id= 'o'+ bttn.id;
        console.log(id);
        document.getElementById(id).setAttribute('selected', 'selected');
        const myModal = new bootstrap.Modal(document.getElementById('buyModal'), {});
        myModal.show();
        
      })
    })
    </script>

<script>
       document.getElementById("cslogin").addEventListener("click", openLoginFormCs);
       function openLoginFormCs() {
        const myModal = new bootstrap.Modal(document.getElementById('loginModal'), {});
        myModal.show();
       }
     </script>

</body>

</html>

<?php
include('footer.php');
?>