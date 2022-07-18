<?php
include('db-connection.php')
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
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
                    <button type="button" form="reqForm" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <script>
            buys = document.getElementsByClassName("buy");
    Array.from(buys).forEach((element) => {
      element.addEventListener("click", (e) => {
        
        const myModal = new bootstrap.Modal(document.getElementById('buyModal'), {});
        myModal.show();
        
      })
    })
    </script>
</body>

</html>