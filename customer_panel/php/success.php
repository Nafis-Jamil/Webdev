<?php
include('db-connection.php');
if (isset($_GET['id'])) {
    $id= $_GET['id'];
	$sql = "SELECT `validity` FROM `users` WHERE `users`.`id` = '$id';";
	$res = mysqli_query($conn,$sql);
	$fetch = mysqli_fetch_assoc($res);
	$validity= $fetch['validity'];
	if($validity<0){
	$update_sql = "UPDATE `users` SET `validity` = 30 WHERE `users`.`id` = '$id';";
    $upres = mysqli_query($conn, $update_sql);
	}
	else{
	$update_sql = "UPDATE `users` SET `validity` = `validity` + 30 WHERE `users`.`id` = '$id';";
    $upres = mysqli_query($conn, $update_sql);
	}
    
}
?>

<?php
$val_id=urlencode($_POST['val_id']);
$store_id=urlencode("piper62d520654541a");
$store_passwd=urlencode("piper62d520654541a@ssl");
$requested_url = ("https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id=".$val_id."&store_id=".$store_id."&store_passwd=".$store_passwd."&v=1&format=json");

$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $requested_url);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC

$result = curl_exec($handle);

$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

if($code == 200 && !( curl_errno($handle)))
{

	# TO CONVERT AS ARRAY
	# $result = json_decode($result, true);
	# $status = $result['status'];

	# TO CONVERT AS OBJECT
	$result = json_decode($result);

	# TRANSACTION INFO
	$status = $result->status;
	$tran_date = $result->tran_date;
	$tran_id = $result->tran_id;
	$val_id = $result->val_id;
	$amount = $result->amount;
	$store_amount = $result->store_amount;
	$bank_tran_id = $result->bank_tran_id;
	$card_type = $result->card_type;

	# EMI INFO
	$emi_instalment = $result->emi_instalment;
	$emi_amount = $result->emi_amount;
	$emi_description = $result->emi_description;
	$emi_issuer = $result->emi_issuer;

	# ISSUER INFO
	$card_no = $result->card_no;
	$card_issuer = $result->card_issuer;
	$card_brand = $result->card_brand;
	$card_issuer_country = $result->card_issuer_country;
	$card_issuer_country_code = $result->card_issuer_country_code;

	# API AUTHENTICATION
	$APIConnect = $result->APIConnect;
	$validated_on = $result->validated_on;
	$gw_version = $result->gw_version;

	$sql= "INSERT INTO `bill` (`tran_id`, `tran_type`, `tran_date`, `amount`, `uid`) VALUES ('$tran_id', '$card_type', '$tran_date', '$amount', '$id');";
	mysqli_query($conn,$sql);


} else {

	echo "Failed to connect with SSLCOMMERZ";
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
    <title>Payment Successful</title>
</head>

<body>
    <div class="container text-center my-5 px-5 py-4 bg-light">
        <h2 class="text-success display-3">Payment Successful</h2>
    </div>

	<div class="container my-3 text-center">
		<a href="http://localhost/PiperNet/customer_panel/php/pdf.php?id=<?php echo $id ;?>&date=<?php echo $tran_date ;?>&tid=<?php echo $tran_id; ?>&type=<?php echo $card_type; ?>&amount=<?php echo $amount; ?>" class="btn btn-lg btn-primary">Download Recipt</a>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>


</body>

</html>