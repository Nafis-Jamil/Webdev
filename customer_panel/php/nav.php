<?php
session_start();
include('db-connection.php');
?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['customer_id'])) {
        $id = $_POST['customer_id'];
        $fetch_sql= "SELECT * FROM `users` WHERE `users`.`id` = '$id';";
        $fetch_res = mysqli_query($conn, $fetch_sql);
        $chk= mysqli_num_rows($fetch_res);
        if($chk>0){
            $_SESSION["login"] = $id;
        }
    }
}

if(isset($_GET['logout'])){
    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();
}
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
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>

<body>

    <!-- Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">Log-in</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

        <form method="post" action="http://localhost/PiperNet/customer_panel/php/index.php">
                    <div class="container my-2 px-2 py-2">
                        <h5>Enter customer ID:</h5>
                        <div><input type="text" name="customer_id" placeholder="L23jd12k" value="" required></div>
                    </div>
                    <div class="container my-2">
                        <input type="submit" class="btn btn-sm btn-info" value="Login">
                    </div>
                </form>
        </div>

      </div>
    </div>
  </div>
     

    <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
        <div class="container-md">
            <a class="navbar-brand mb-0 h1" href="http://localhost/piperNet/customer_panel/php/index.php">
                <i class="fa-brands fa-pied-piper"></i>
                Piper Net
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="#navbarNav" aria-expanded="false" aria-label="Toggle Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item active">
                        <a href="http://localhost/piperNet/customer_panel/php/index.php" class="nav-link mx-3">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="http://localhost/piperNet/customer_panel/php/packages.php" class="nav-link mx-2">
                            Packages
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="http://localhost/piperNet/customer_panel/php/paybill.php" class="nav-link mx-2" target="blank">
                            Pay Bill
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link mx-2">
                            About Us
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <?php
                        if(!isset($_SESSION['login'])){
                            echo "<button class='btn btn-xs btn-outline-secondary' id='login'>
                            <i class='fa-solid fa-user mx-2'></i>
                            Log In
                            </button>";
                        }
                        else{
                          echo "  <a href='http://localhost/piperNet/customer_panel/php/profile.php' class='nav-link mx-2'>
                          <i class='fa-solid fa-user mx-2'></i>
                          Profile
                      </a>";
                        }

                        ?>
                        
                    </li>
                    <li class="nav-item">
                        <?php
                        if(isset($_SESSION['login'])){
                            echo "<a href='http://localhost/piperNet/customer_panel/php/index.php?logout=true' class='nav-link mx-2'>
                            Logout
                        </a>";
                        }
                        ?>
                        
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>

     <script>
       document.getElementById("login").addEventListener("click", openLoginForm);
       function openLoginForm() {
        const myModal = new bootstrap.Modal(document.getElementById('loginModal'), {});
        myModal.show();
       }
     </script>   
</body>

</html>