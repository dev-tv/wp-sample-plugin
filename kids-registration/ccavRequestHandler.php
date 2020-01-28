<html>
<head>
<title> Custom Form Kit </title>
</head>
<body>
<center>

<?php include('Crypto.php')?>
<?php 

	error_reporting(0);
	
	$merchant_data='12345';
	$working_key='1234567890';//Shared by CCAVENUES
	$access_code='dfgdfgdfg';//Shared by CCAVENUES
        $_POST['merchant_id'] = "12345";
        $_POST['currency'] = "INR";
        $_POST['language'] = "EN";
        $_POST['amount'] = "950.00";
	
	foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.urlencode($value).'&';
	}
	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.

global $wpdb;
$billState1 = $_POST['state'];
$table_name = $wpdb->prefix . "statelist";

$query = "SELECT * FROM $table_name WHERE city_id='$billState1'";
$results = $wpdb->get_row($query); 
$billState = $results->state;

    $billName = $_POST['parent_name'];
    $billAddress = $_POST['address'];
    $billTel = $_POST['contact_number'];
    $billEmail = $_POST['email_id'];
	$billCity = $_POST['city'];	
?>
<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";

echo "<input type=hidden name=billName value='$billName'>";
echo "<input type=hidden name=billAddress value='$billAddress'>";
echo "<input type=hidden name=billCity value='$billCity'>";
echo "<input type=hidden name=billState value='$billState'>";
echo "<input type=hidden name=billTel value='$billTel'>";
echo "<input type=hidden name=billEmail value='$billEmail'>";

?>
</form>
</center>
<script language='javascript'>document.redirect.submit();</script>
</body>
</html>

