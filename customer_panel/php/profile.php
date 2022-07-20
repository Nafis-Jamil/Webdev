<?php
include('db-connection.php');
include('nav.php');
?>

<?php
if(isset($_SESSION['login'])){
     $id= $_SESSION['login'];
     $sql= "SELECT `date` , `name` , `pack_id`, `validity` FROM `users` WHERE `users`.`id`='$id';";
     $res= mysqli_query($conn,$sql);
     $fetch_sql = mysqli_fetch_assoc($res);
     $name= $fetch_sql['name'];
     $date= $fetch_sql['date'];
     $pid= $fetch_sql['pack_id'];
     $validity= $fetch_sql['validity'];
     $sql = "SELECT `name`, `speed`, `price` FROM `packages` WHERE `packages`.`id` = '$pid';";
     $res= mysqli_query($conn,$sql);
     $fetch_sql = mysqli_fetch_assoc($res);
     $pname = $fetch_sql['name'];
     $pspeed = $fetch_sql['speed'];
     $pprice = $fetch_sql['price'];
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
    <title>Profile</title>
</head>

<body>
    <div class="container text-center my-5 px-5 py-4 bg-light">
        <h2>Account Details</h2>
    </div>

<div class="container mt-5 py-5">
    <div class="row g-5">
        <div class="col-md-4">
             <div class="card">
                <div class="card-header bg-primary text-white py-4">
                    <div class="row align-items-center">
                        <div class="col px-5">
                            <i class="fa-solid fa-check-double fa-4x"></i>
                        </div>
                        <div class="col">
                            <h4><?php echo $date ?></h4>
                            <h6>Connection Date</h6>
                            </div>
                    </div>
                </div>
             </div>
        </div>
        <div class="col-md-4">
            <div class="card">
               <div class="card-header bg-success text-white py-4">
                   <div class="row align-items-center">
                       <div class="text-center">
                           <h4><?php echo $name ?></h4>
                           <h6>Name</h6>
                           </div>
                   </div>
               </div>
            </div>         
       </div>
       <div class="col-md-4">
        <div class="card">
           <div class="card-header bg-warning text-white py-4">
               <div class="row align-items-center">
                   <div class="col px-5">
                       <i class="fa-solid fa-check-double fa-4x"></i>
                   </div>
                   <div class="col">
                       <h4><?php echo $pname ?></h4>
                       <h6>Package</h6>
                       </div>
               </div>
           </div>
        </div>         
   </div>
   <div class="col-md-4">
    <div class="card">
       <div class="card-header bg-dark text-white py-4">
           <div class="row align-items-center">
               <div class="col px-5">
                   <i class="fa-solid fa-check-double fa-4x"></i>
               </div>
               <div class="col">
                   <h4><?php echo $pspeed ?> Mbps</h4>
                   <h6>Bandwidth</h6>
                   </div>
           </div>
       </div>
    </div>         
</div>
<div class="col-md-4">
    <div class="card">
       <div class="card-header bg-danger text-white py-4">
           <div class="row align-items-center">
               <div class="col px-5">
                   <i class="fa-solid fa-check-double fa-4x"></i>
               </div>
               <div class="col">
                   <h4><?php echo $validity ?></h4>
                   <h6>Validity</h6>
                   </div>
           </div>
       </div>
    </div>         
</div>
<div class="col-md-4">
    <div class="card">
       <div class="card-header bg-secondary text-white py-4">
           <div class="row align-items-center">
               <div class="col px-5">
                   <i class="fa-solid fa-check-double fa-4x"></i>
               </div>
               <div class="col">
                   <h4><?php echo $pprice ?>&#2547</h4>
                   <h6>Bill Amount</h6>
                   </div>
           </div>
       </div>
    </div>         
</div>


    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>


</body>

</html>