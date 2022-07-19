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
    if (isset($_GET['delete'])) {
      $uid= $_GET['delete'];
      $pid= $_GET['pid'];
      $sql = "UPDATE `packages` SET `popularity`=`popularity` - 1  WHERE `packages`.`id`='$pid';";
      mysqli_query($conn,$sql);
      $sql = "DELETE FROM `users` WHERE `users`.`id`='$uid';";
      mysqli_query($conn,$sql);
      $sql = "DELETE FROM `complaints` WHERE `complaints`.`cus_id`='$uid';";
      mysqli_query($conn,$sql);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $uid= $_POST['uid'];
  $contact = $_POST['econtact'];
  $email= $_POST['eemail'];
  $pid = $_POST['package'];
  $opid= $_POST['opid'];
  $sql = "UPDATE `packages` SET `popularity`=`popularity` - 1  WHERE `packages`.`id`='$opid';";
  mysqli_query($conn,$sql);
  $sql = "UPDATE `users` SET `contact`='$contact' , `email`='$email' , `pack_id`='$pid' WHERE `users`.`id`='$uid';";
  mysqli_query($conn,$sql);
  $sql = "UPDATE `packages` SET `popularity`=`popularity` + 1  WHERE `packages`.`id`='$pid';";
  mysqli_query($conn,$sql);
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


     <!-- Modal -->
     <div class="modal fade" id="userEditModal" tabindex="-1" aria-labelledby="userEditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userEditModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="reqForm"  action="http://localhost/piperNet/admin_dashboard/includes/user.php" method="post">
                         <input type="hidden" id="uid" name="uid">
                         <input type="hidden" id="opid" name="opid">
                        <div class="mb-3">
                            <label for="econtact" class="form-label">Contact</label>
                            <input type="tel" class="form-control" id="econtact" name="econtact" required>
                        </div>

                        <div class="mb-3">
                            <label for="eemail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="eemail" name="eemail" required>
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
                                        echo "<option id='$row[id]' value='$row[id]'>$row[name]</option>";
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
          <th>validity</th>
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
          <td>$row[validity]</td>
          <td>$pname</td>
          <td>
          <button class='btn btn-sm btn-success edit' id='$row[pack_id]'>Edit</button> 
          <button class='btn btn-sm btn-danger delete' id='$row[pack_id]'>Delete</button> 
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

    edits = document.getElementsByClassName("edit");
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        row = e.target.parentNode.parentNode;
        contact = row.getElementsByTagName("td")[3].innerText;
        email = row.getElementsByTagName("td")[4].innerText;
        document.getElementById('uid').setAttribute("value", row.id);
        document.getElementById('econtact').setAttribute("value", contact);
        document.getElementById('eemail').setAttribute("value", email);
        document.getElementById('opid').setAttribute("value", e.target.id);
        document.getElementById(e.target.id).setAttribute('selected', 'selected');
        const myModal = new bootstrap.Modal(document.getElementById('userEditModal'), {});
        myModal.show();

      })
    })

    deletes = document.getElementsByClassName("delete");
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        row = e.target.parentNode.parentNode;
        id= row.id;
        pid= e.target.id;
        if (confirm("Press a button!")) {
          window.location = `http://localhost/PiperNet/admin_dashboard/includes/user.php?delete=${id}&pid=${pid}`;

        } else {
          console.log("no");
        }

      })
    })
  </script>

</body>

</html>