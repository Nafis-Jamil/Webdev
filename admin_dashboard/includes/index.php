<?php
include('db-connection.php');
include('admin.php');
?>

<?php
  $sql= "SELECT COUNT(`id`) AS total_users FROM `users`;";
  $res = mysqli_query($conn,$sql);
  $fetch = mysqli_fetch_assoc($res);
  $total_users = $fetch['total_users'];
  
  $sql= "SELECT COUNT(`id`) AS active_users FROM `users` WHERE `users`.`validity` > '0';";
  $res = mysqli_query($conn,$sql);
  $fetch = mysqli_fetch_assoc($res);
  $active_users = $fetch['active_users'];
  $non_active_users = $total_users-$active_users;
  $bill_paid = ($active_users/$total_users)*100;
  
  $sql= "SELECT COUNT(`rid`) AS total_reqs FROM `requests` WHERE `requests`.`status` = '0';";
  $res = mysqli_query($conn,$sql);
  $fetch = mysqli_fetch_assoc($res);
  $total_reqs = $fetch['total_reqs'];
  
  $sql= "SELECT COUNT(`rid`) AS pending_conns FROM `requests` WHERE `requests`.`status` != '0';";
  $res = mysqli_query($conn,$sql);
  $fetch = mysqli_fetch_assoc($res);
  $pending_conns = $fetch['pending_conns'];
  
  $sql= "SELECT COUNT(`id`) AS total_packs FROM `packages`;";
  $res = mysqli_query($conn,$sql);
  $fetch = mysqli_fetch_assoc($res);
  $total_packs= $fetch['total_packs'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Admin Dashboard</title>
</head>

<body>
    <div class="container text-center my-5 px-5 py-4 bg-dark">
        <h2 class="text-info">Admin Dashboard</h2>
    </div>

<div class="container mt-5 py-5">
    <div class="row g-5">
        <div class="col-md-4">
             <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="row align-items-center">
                        <div class="col px-5">
                            <i class="fa-solid fa-check-double fa-4x"></i>
                        </div>
                        <div class="col">
                            <h4 class="display-3"><?php echo $total_users ?></h4>
                            <h6>Total Users</h6>
                            </div>
                    </div>
                </div>
             </div>
        </div>

        <div class="col-md-4">
             <div class="card">
                <div class="card-header bg-success text-white">
                    <div class="row align-items-center">
                        <div class="col px-5">
                            <i class="fa-solid fa-check-double fa-4x"></i>
                        </div>
                        <div class="col">
                            <h4 class="display-3"><?php echo $active_users ?></h4>
                            <h6>Active Users</h6>
                            </div>
                    </div>
                </div>
             </div>
        </div>

        <div class="col-md-4">
             <div class="card">
                <div class="card-header bg-danger text-white">
                    <div class="row align-items-center">
                        <div class="col px-5">
                            <i class="fa-solid fa-check-double fa-4x"></i>
                        </div>
                        <div class="col">
                            <h4 class="display-3"><?php echo $non_active_users ?></h4>
                            <h6>Non-active Users</h6>
                            </div>
                    </div>
                </div>
             </div>
        </div>
       
        <div class="col-md-4">
             <div class="card">
                <div class="card-header bg-warning text-white">
                    <div class="row align-items-center">
                        <div class="col px-5">
                            <i class="fa-solid fa-check-double fa-4x"></i>
                        </div>
                        <div class="col">
                            <h4 class="display-3"><?php echo $bill_paid?>%</h4>
                            <h6>Bill Paid (%)</h6>
                            </div>
                    </div>
                </div>
             </div>
        </div>

        <div class="col-md-4">
             <div class="card">
                <div class="card-header bg-info text-white">
                    <div class="row align-items-center">
                        <div class="col px-5">
                            <i class="fa-solid fa-check-double fa-4x"></i>
                        </div>
                        <div class="col">
                            <h4 class="display-3"><?php echo $total_reqs?></h4>
                            <h6>Total Requests</h6>
                            </div>
                    </div>
                </div>
             </div>
        </div>

        <div class="col-md-4">
             <div class="card">
                <div class="card-header bg-secondary text-white">
                    <div class="row align-items-center">
                        <div class="col px-3">
                            <i class="fa-solid fa-check-double fa-4x"></i>
                        </div>
                        <div class="col">
                            <h4 class="display-3"><?php echo $pending_conns?></h4>
                            <h6>Pending Connections</h6>
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