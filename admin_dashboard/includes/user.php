<?php
include('db-connection.php');
?>



<?php
include('admin.php');
?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['add'])) {
      $id= $_GET['add'];
      $del_sql = "DELETE FROM `requests` WHERE `requests`.`rid` = '$id';";
      $del_res = mysqli_query($conn, $del_sql);
      $id_sql = "SELECT LEFT(UUID(), 8) as uuid;";
      $id_res = mysqli_query($conn, $id_sql);
      $id_fetch = mysqli_fetch_assoc($id_res);
      
      
      $uid= $id_fetch['uuid'];
      $date = date("Y/m/d");
      $name= $_GET['name'];
      $contact = $_GET['contact'];
      $email = $_GET['email'];
      $address = $_GET['address'];
      $pid = $_GET['pid'];
      $validity= 0;
      
      

      $update_sql = "UPDATE `packages` SET `popularity` = `popularity` + 1 WHERE `packages`.`id` = '$pid';";
      $upres = mysqli_query($conn, $update_sql);

      $insert_sql = "INSERT INTO `users` (`id`, `date`, `name`, `contact`, `email`, `address`, `pack_id`, `validity`) VALUES ('$uid', '$date', '$name', '$contact', '$email', '$address', '$pid', '0');";
      $res = mysqli_query($conn, $insert_sql);

      
       $to_email = $email;
       $subject = "Connection Established";
       $body = "Dear Customer, your connection has been Established. Your unique id is $uid. Please don't share it with anybody";
       $headers = "From: pipernetbd@gmail.com";
       
       if (mail($to_email, $subject, $body, $headers)) {
           echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
           <strong>Successful!!</strong> Email Sent
           <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
         </div>";
       } else {
           echo  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
           <strong>Failed!!</strong> Email Could Not Be Sent
           <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
         </div>";
       }
  
    }
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/package.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>

<body>

   <div class="container my-3">
    <h3>Pending Users</h3>
   </div>


  <div class="container bg-light my-3 py-3">

    <table class="table" id="myTable">
      <thead>
        <tr>
          <th>Date</th>
          <th>Name</th>
          <th>Contact</th>
          <th>Email</th>
          <th>Address</th>
          <th>Package</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $show_sql = "SELECT * FROM requests  WHERE `requests`.`status` = '1';";
        $result = mysqli_query($conn, $show_sql);
        $check = mysqli_num_rows($result);
        if ($check > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $pname_sql = "SELECT name as pname FROM packages  WHERE `packages`.`id` = '$row[pack_id]';";
            $pres = mysqli_query($conn, $pname_sql);
            $pname_fetch= mysqli_fetch_assoc($pres);
            $pname= $pname_fetch['pname'];
            echo 
          "<tr id='$row[rid]'>
          <td>$row[date]</td>
          <td>$row[name]</td>
          <td>$row[contact]</td>
          <td>$row[email]</td>
          <td>$row[address]</td>
          <td>$pname</td>
          <td>
          <button class='btn btn-sm btn-success add' id='$row[pack_id]'>Add to User</button> 
          </td>
        </tr>";
          }
        }
        ?>

      </tbody>
    </table>

    <hr>

  </div>


  <div class="container my-3">
    <h3>Active Users</h3>
   </div>


  <div class="container bg-light my-3 py-3">

    <table class="table" id="myTable2">
      <thead>
        <tr>
        <th>ID</th>
          <th>Connection Date</th>
          <th>Name</th>
          <th>Contact</th>
          <th>Email</th>
          <th>Address</th>
          <th>Package</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $show_sql = "SELECT * FROM `users`;";
        $result = mysqli_query($conn, $show_sql);
        $check = mysqli_num_rows($result);
        if ($check > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $pname_sql = "SELECT name as pname FROM packages  WHERE `packages`.`id` = '$row[pack_id]';";
            $pres = mysqli_query($conn, $pname_sql);
            $pname_fetch= mysqli_fetch_assoc($pres);
            $pname= $pname_fetch['pname'];
            echo 
          "<tr id='$row[id]'>
          <td>$row[id]</td>
          <td>$row[date]</td>
          <td>$row[name]</td>
          <td>$row[contact]</td>
          <td>$row[email]</td>
          <td>$row[address]</td>
          <td>$pname</td>
          <td>
          <button class='btn btn-sm btn-success edit' id='$row[pack_id]'>Edit</button> 
          <button class='btn btn-sm btn-success delete' id='$row[pack_id]'>Edit</button> 
          </td>
        </tr>";
          }
        }
        ?>

      </tbody>
    </table>

    <hr>

  </div>





  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>

<script>
    $(document).ready(function() {
      $('#myTable2').DataTable();
    });
  </script>

  <script>
      adds = document.getElementsByClassName("add");
    Array.from(adds).forEach((element) => {
      element.addEventListener("click", (e) => {
        row = e.target.parentNode.parentNode;
        id = row.id;
        name = row.getElementsByTagName("td")[1].innerText;
        contact = row.getElementsByTagName("td")[2].innerText;
        email = row.getElementsByTagName("td")[3].innerText;
        address = row.getElementsByTagName("td")[4].innerText;
        pname= row.getElementsByTagName("td")[5].innerText;
        pid= e.target.id;
        if (confirm("Are You Sure?")) {
          window.location = `http://localhost/PiperNet/admin_dashboard/includes/user.php?add=${id}&name=${name}&contact=${contact}&email=${email}&address=${address}&pid=${pid}`;
        } else {
          console.log("no");
        }
      })
    })
  </script>

</body>

</html>