<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>


   <nav class="navbar navbar-light bg-light sticky-top">
        <div class="container-fluid">
                 
          <!-- side navbar toggler button -->
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <i class="fas fa-align-left"></i>
            </button>
                <!-- brand icon and name -->

                <a class="navbar-brand h1 mx-auto" href="#">
                    <i class="fa-brands fa-pied-piper"></i>
                    Piper Net
                </a>

        </div>
    </nav>





    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">


        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                <i class="fa-brands fa-pied-piper"></i>
                Piper-Net Admin
            </h5>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <i class="fas fa-align-left"></i>
            </button>

        </div>

        <div class="offcanvas-body">
            <ul class="menu-list">
                <li class="menu-item">
                   <a class="btn btn-outline-dark" href="#">Dashboard</a> 
                </li>
                <li class="menu-item">
                    <a class="btn btn-outline-dark" href="#">Connection Requests</a>
                </li>
                <li class="menu-item">
                    <a class="btn btn-outline-dark" href="#">User Information</a>
                </li>
                <li class="menu-item">
                   <a class="btn btn-outline-dark" href="#">Connection Management</a>
                </li>
                <li class="menu-item">
                    <a class="btn btn-outline-dark" href="http://localhost/piperNet/admin_dashboard/includes/package-manager.php">Package Manager</a>
                </li>
            </ul>
        </div>


    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>