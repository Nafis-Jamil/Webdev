<?php
include('db-connection.php');
?>



<?php
include('admin.php');
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
          "<tr>
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

</body>

</html>