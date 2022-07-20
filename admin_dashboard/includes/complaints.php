<?php
include('db-connection.php');
?>



<?php
include('admin.php');
?>

<?php
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $cus_id = $_POST['cus_id'];
      $comp_id = $_POST['comp_id'];
      $sql = "SELECT `email` FROM `users` WHERE `users`.`id` = '$cus_id';";
      $res = mysqli_query($conn,$sql);
      $fetch = mysqli_fetch_assoc($res);
      $email = $fetch['email'];
      $sql = "DELETE FROM `complaints` WHERE `complaints`.`comp_id` = '$comp_id';";
      $res = mysqli_query($conn,$sql);
      $to_email = $email;
      $subject = "PiperNet Customer Service";
      $body = $_POST['replyMail'];
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
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Customer Service</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/package.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>

<body>



  <!-- Modal -->
  <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="replyModalLabel">Reply The Customer</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form class="reply-form" id="replyForm" action="http://localhost/piperNet/admin_dashboard/includes/complaints.php" method="post">
            
            <input type="hidden" name="comp_id" id="comp_id">
            <input type="hidden" name="cus_id" id="cus_id">

            <div class="container my-3">
                <label for="replyMail" class="form-label text-danger"><b>Description</b></label>
                <br>
                <textarea class="my-2 bg-light" name="replyMail" id="replyMail" cols="55" rows="8"  placeholder="Reply The Customer"></textarea>
             </div>

          </form>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="replyForm" class="btn btn-info">Reply</button>
        </div>
      </div>
    </div>
  </div>



   <div class="container my-5 text-center">
    <h3 class="text-danger display-2">Customer Complaints</h3>
   </div>


  <div class="container bg-light my-3 py-3">

    <table class="table" id="myTable">
      <thead>
        <tr>
          <th>Id</th>
          <th>Type</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $show_sql = "SELECT * FROM `complaints`;";
        $result = mysqli_query($conn, $show_sql);
        $check = mysqli_num_rows($result);
        if ($check > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo 
          "<tr id='$row[comp_id]'>
          <td class='px-3 py-3'>$row[cus_id]</td>
          <td class='px-3 py-3'>$row[type]</td>
          <td class='px-3 py-3'>$row[description]</td>
          <td class='px-3 py-3'>
          <button class='btn btn-md btn-success reply'>Reply</button>  
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
       replys = document.getElementsByClassName("reply");
    Array.from(replys).forEach((element) => {
      element.addEventListener("click", (e) => {
        row = e.target.parentNode.parentNode;
        comp_id=row.id;
        customer_id = row.getElementsByTagName("td")[0].innerText;
        document.getElementById('comp_id').setAttribute("value", comp_id);
        document.getElementById('cus_id').setAttribute("value", customer_id);
        const myModal = new bootstrap.Modal(document.getElementById('replyModal'), {});
        myModal.show();

      })
    })
  </script>

</body>

</html>