<?php
include('db-connection.php');
?>



<?php
include('admin.php');
?>


<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (isset($_GET['accept'])) {
    $id= $_GET['accept'];
    $ac_sql = "UPDATE `requests` SET `status` = '1' WHERE `requests`.`rid` = '$id';";
    $ac_res = mysqli_query($conn, $ac_sql);

     $to_email = $_GET['email'];
     $subject = "Connection Request Accepted";
     $body = "Dear Customer, your connection request has been accepted. Our team will contact you within 3 days";
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

  if (isset($_GET['reject'])) {
    $id= $_GET['reject'];
    $rj_sql = "DELETE FROM `requests` WHERE `requests`.`rid` = '$id';";
    $rj_res = mysqli_query($conn, $rj_sql);
    $to_email = $_GET['email'];
    $subject = "Connection Request Not Accepted";
    $body = "Dear Customer, your connection request has not been accepted. We are extremely sorry";
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
    <h3>Connection Requests</h3>
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
        $show_sql = "SELECT * FROM requests  WHERE `requests`.`status` = '0';";
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
          <button class='btn btn-sm btn-success accept'>Accept</button> 
          <button class='btn btn-sm btn-danger reject'>Reject</button> 
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
       accepts = document.getElementsByClassName("accept");
    Array.from(accepts).forEach((element) => {
      element.addEventListener("click", (e) => {
        row = e.target.parentNode.parentNode;
        id = row.id;
        email = row.getElementsByTagName("td")[3].innerText;
        if (confirm("Are You Sure?")) {
          window.location = `http://localhost/PiperNet/admin_dashboard/includes/request.php?accept=${id}&email=${email}`;
        } else {
          console.log("no");
        }
      })
    })

    rejects = document.getElementsByClassName("reject");
    Array.from(rejects).forEach((element) => {
      element.addEventListener("click", (e) => {
        row = e.target.parentNode.parentNode;
        id = row.id;
        email = row.getElementsByTagName("td")[3].innerText;
        if (confirm("Are You Sure?")) {
          window.location = `http://localhost/PiperNet/admin_dashboard/includes/request.php?reject=${id}&email=${email}`;
        } else {
          console.log("no");
        }
      })
    })
  </script>

</body>

</html>