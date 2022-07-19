<?php
include('db-connection.php');
include('nav.php');
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
    <title>Document</title>
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
                    <form id="reqForm">
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
                    <button type="button" form="reqForm" class="btn btn-primary">Save changes</button>
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
                    <a href="#" class="btn btn-secondary">
                        Know More About Us
                    </a>
                </div>

            </div>

            <div class="carousel-item">
                <div class="overlay-image" style="background-image:url(../images/connection.jpg)"></div>
                <div class="container item-container">
                    <h1>Need New Connection?</h1>
                    <p>Piper Net provides a bufferless internet experience at reasonable price</p>
                    <a href="#" class="btn btn-success">
                        Check Out Our Packages
                    </a>
                </div>

            </div>

            <div class="carousel-item">
                <div class="overlay-image" style="background-image:url(../images/pay.png)"></div>
                <div class="container item-container">
                    <h1>Pay Your Bill & Stay Connected</h1>
                    <p>Pay your bill with Bkash or Nagad</p>
                    <a href="#" class="btn btn-lg btn-warning">
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
                           echo " <a href='#' class='btn btn-lg btn-success'>24 Hour Customer Service</a>";
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


    <section id="footer" class="bg-light mt-5 py-4">

        <!-- Site footer -->
        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <h6>About</h6>
                        <p class="text-justify">Scanfcode.com <i>CODE WANTS TO BE SIMPLE </i> is an initiative to help the upcoming programmers with the code. Scanfcode focuses on providing the most efficient code or snippets as the code wants to be simple. We will help programmers build up concepts in different programming languages that include C, C++, Java, HTML, CSS, Bootstrap, JavaScript, PHP, Android, SQL and Algorithm.</p>
                    </div>

                    <div class="col-xs-6 col-md-3">
                        <h6>Categories</h6>
                        <ul class="footer-links">
                            <li><a href="http://scanfcode.com/category/c-language/">C</a></li>
                            <li><a href="http://scanfcode.com/category/front-end-development/">UI Design</a></li>
                            <li><a href="http://scanfcode.com/category/back-end-development/">PHP</a></li>
                            <li><a href="http://scanfcode.com/category/java-programming-language/">Java</a></li>
                            <li><a href="http://scanfcode.com/category/android/">Android</a></li>
                            <li><a href="http://scanfcode.com/category/templates/">Templates</a></li>
                        </ul>
                    </div>

                    <div class="col-xs-6 col-md-3">
                        <h6>Quick Links</h6>
                        <ul class="footer-links">
                            <li><a href="http://scanfcode.com/about/">About Us</a></li>
                            <li><a href="http://scanfcode.com/contact/">Contact Us</a></li>
                            <li><a href="http://scanfcode.com/contribute-at-scanfcode/">Contribute</a></li>
                            <li><a href="http://scanfcode.com/privacy-policy/">Privacy Policy</a></li>
                            <li><a href="http://scanfcode.com/sitemap/">Sitemap</a></li>
                        </ul>
                    </div>
                </div>
                <hr>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <p class="copyright-text">Copyright &copy; 2017 All Rights Reserved by
                            <a href="#">Scanfcode</a>.
                        </p>
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <ul class="social-icons">
                            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

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