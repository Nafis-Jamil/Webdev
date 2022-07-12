<?php
include('db-connection.php');
$insert_check = false;
$update_check = false;
$delete_check = false;
?>

<?php


if ($_SERVER['REQUEST_METHOD'] == 'GET'){
  if(isset($_GET['delete'])){
    $did= $_GET['delete'];
    $delete_sql = "DELETE FROM `packages` WHERE `packages`.`id` = '$did'";
    $res = mysqli_query($conn, $delete_sql);
    if ($res) {
      $delete_check = true;
    }
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (isset($_POST['pid'])) {
    //update
    $id= $_POST['pid'];
    $name = $_POST['pname'];
    $price = $_POST['pprice'];
    $desc = $_POST['pdesc'];
    $update_sql = "UPDATE `packages` SET `name` = '$name' , `price`='$price' , `description`='$desc' WHERE `packages`.`id` = '$id';";
    $res = mysqli_query($conn, $update_sql);
    if ($res) {
      $update_check = true;
    }

    
    
  } else {
    $name = $_POST['pname'];
    $price = $_POST['pprice'];
    $desc = $_POST['pdesc'];
    $pop= 0;
    $insert_sql = "INSERT INTO `packages` (`id`, `name`, `price`, `description`, `popularity`) VALUES ('NULL', '$name', '$price', '$desc', '0');";
    $res = mysqli_query($conn, $insert_sql);
    if ($res) {
      $insert_check = true;
    }
  }
}
?>

<?php
include('admin.php');
?>

<?php

if ($insert_check) {
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Successful!!</strong> New Package Added
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}

if ($update_check) {
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Successful!!</strong> Package Updated
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}

if ($delete_check) {
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Successful!!</strong> Package Deleted
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
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
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form class="pack-form" id="packFormEdit" action="http://localhost/piperNet/admin_dashboard/includes/package-manager.php" method="post">

            <input type="hidden" name="pid" id="pidEdit">

            <div class="mb-2">
              <label class="pack-labels" for="pnameEdit">Package Name</label>
              <br>
              <input class="my-2" type="text" name="pname" id="pnameEdit" required>
            </div>

            <div class="mb-2">
              <label class="pack-labels" for="ppriceEdit">Package Price</label>
              <br>
              <input class="my-2" type="number" name="pprice" id="ppriceEdit" min="500" step="100" required>
            </div>

            <div class="mb-3">
              <label class="pack-labels" for="pdescEdit">Package Description</label>
              <br>
              <textarea class="my-2" name="pdesc" id="pdescEdit" cols="30" rows="3"></textarea>
            </div>



          </form>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="packFormEdit" class="btn btn-primary">Save changes</button>
        </div>

      </div>
    </div>
  </div>

  <div class="container bg-light my-5 py-5">

    <h3 style="text-align:center;">Add a Package</h3>
    <br>
    <form class="pack-form" action="http://localhost/piperNet/admin_dashboard/includes/package-manager.php" method="post">

      <div class="mb-2">
        <label class="pack-labels" for="pname">Package Name</label>
        <br>
        <input class="my-2" type="text" name="pname" id="pname" required>
      </div>

      <div class="mb-2">
        <label class="pack-labels" for="pprice">Package Price</label>
        <br>
        <input class="my-2" type="number" name="pprice" id="pprice" min="500" step="100" required>
      </div>

      <div class="mb-3">
        <label class="pack-labels" for="pdesc">Package Description</label>
        <br>
        <textarea class="my-2" name="pdesc" id="pdesc" cols="30" rows="3"></textarea>
      </div>

      <div class="mb-2">
        <button class="btn btn-outline-success" type="submit">ADD</button>
      </div>

    </form>

  </div>

  <div class="container bg-light my-3 py-3">

    <table class="table" id="myTable">
      <thead>
        <tr>
          <th>Name</th>
          <th>Price</th>
          <th>Description</th>
          <th>Popularity</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $show_sql = 'select * from packages';
        $result = mysqli_query($conn, $show_sql);
        $check = mysqli_num_rows($result);
        if ($check > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr id='$row[id]'>
          <td>$row[name]</td>
          <td>$row[price]</td>
          <td>$row[description]</td>
          <td>$row[popularity]</td>
          <td>
          <button class='btn btn-sm btn-success edit'>Edit</button> 
          <button class='btn btn-sm btn-danger delete'>delete</button> 
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
  <!-- <script src="../js/package-manager.js"></script> -->

<script>
    edits= document.getElementsByClassName("edit");
    Array.from(edits).forEach((element)=>{
    element.addEventListener("click", (e)=>{
        row= e.target.parentNode.parentNode;
        package_name= row.getElementsByTagName("td")[0].innerText;
        package_price= row.getElementsByTagName("td")[1].innerText;
        package_description= row.getElementsByTagName("td")[2].innerText;
        package_popularity= row.getElementsByTagName("td")[3].innerText;
        console.log(package_name,package_price,package_description,package_popularity);
        document.getElementById('pnameEdit').setAttribute("value", package_name);
        document.getElementById('ppriceEdit').setAttribute("value", package_price);
        pdescEdit.value= package_description;
        pidEdit.value= row.id;
        const myModal = new bootstrap.Modal(document.getElementById('editModal'), {});
        myModal.show();
       
    })
})


deletes= document.getElementsByClassName("delete");
    Array.from(deletes).forEach((element)=>{
    element.addEventListener("click", (e)=>{
        row= e.target.parentNode.parentNode;
        id=row.id;
        if (confirm("Press a button!")) {
           window.location=`http://localhost/piperNet/admin_dashboard/includes/package-manager.php?delete=${id}`;
        } else {
          console.log("no");
        }
       
    })
})
</script>



</body>

</html>