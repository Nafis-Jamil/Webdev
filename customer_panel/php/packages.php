<?php
include('db-connection.php');
include('nav.php');
?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
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

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../css/packages.css">
    <title>Packages</title>
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
                    <form id="reqForm"  action="http://localhost/piperNet/customer_panel/php/packages.php" method="post">
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


    <div class="container my-5 bg-light">

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center">
                    <span class="sub-title">Our Packages</span>
                    <h2 class="title" id="title_header">Pick The Best Plan For You</h2>
                    <div class="section-heading-line"></div>
                    <p>Super Speed Optical Fiber Internet Connectivity with Real IP Right to Your Door Steps</p>
                </div>
            </div>
        </div>

    </div>

       
    <div class='row my-5 align-items-center justify-content-center g-3 bg-light'>

        <?php
        $show_sql = 'SELECT * FROM `packages` ORDER BY `packages`.`price` ASC';
        $result = mysqli_query($conn, $show_sql);
        $check = mysqli_num_rows($result);
        if ($check > 0) {

            for ($i = 0; $i < $check; $i++) {
                $row = mysqli_fetch_assoc($result);
                echo "<div class='col-12 col-md-6 col-xl-3'>
                            <div class='card border-0'>
                                <div class='card-body text-center py-4'>
                                <div class='hd'>
                                <h4 class='card-title'>
                                    $row[name]
                                </h4>
                                </div>
                                    <p class='display-5 my-4 text-info fw-bold'>
                                        $row[speed] Mbps
                                     </p>
                                    <p class='display-5 my-4 text-warning fw-bold'>
                                       $row[price]  
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
</body>

</html>