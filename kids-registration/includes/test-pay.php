<?php

function getchecksum($MerchantId, $Amount, $OrderId, $URL, $WorkingKey) {
    $str = "$MerchantId|$OrderId|$Amount|$URL|$WorkingKey";
    $adler = 1;
    $adler = adler32($adler, $str);
    return $adler;
}

function verifychecksum($MerchantId, $OrderId, $Amount, $AuthDesc, $CheckSum, $WorkingKey) {
    $str = "$MerchantId|$OrderId|$Amount|$AuthDesc|$WorkingKey";
    $adler = 1;
    $adler = adler32($adler, $str);
    if ($adler == $CheckSum)
        return "true";
    else
        return "false";
}

function adler32($adler, $str) {
    $BASE = 65521;
    $s1 = $adler & 0xffff;
    $s2 = ($adler >> 16) & 0xffff;
    for ($i = 0; $i < strlen($str); $i++) {
        $s1 = ($s1 + Ord($str[$i])) % $BASE;
        $s2 = ($s2 + $s1) % $BASE;
    }
    return leftshift($s2, 16) + $s1;
}

function leftshift($str, $num) {
    $str = DecBin($str);
    for ($i = 0; $i < (64 - strlen($str)); $i++)
        $str = "0" . $str;
    for ($i = 0; $i < $num; $i++)
        $str = $str . "0"; $str = substr($str, 1);
    return cdec($str);
}

function cdec($num) {
    for ($n = 0; $n < strlen($num); $n++) {
        $temp = $num[$n];
        $dec = $dec + $temp * pow(2, strlen($num) - $n - 1);
    }
    return $dec;
}

$Merchant_Id = "75077"; //This id(also User Id) available at "Generate Working Key" of "Settings & Options" 
$Amount = '1500'; //your script should substitute the amount in the quotes provided here 
$Order_Id = "Order ID"; //your script should substitute the order description in the quotes provided here 
$Redirect_Url = "http://www.indiacutestkids.com/"; //your redirect URL where your customer will be redirected after authorisation from CCAvenue   
$WorkingKey = "ADF22E55CEC50257D0BC71D508164C14"; //put in the 32 bit alphanumeric key in the quotes provided here.Please note that get this key ,login to your CCAvenue merchant account and visit the "Generate Working Key" section at the "Settings & Options" page. 
$Checksum = getCheckSum($Merchant_Id, $Amount, $Order_Id, $Redirect_Url, $WorkingKey);
$billing_cust_name = $customer_name;
$billing_cust_address = $customer_address;
$billing_cust_state = $customer_statename;
$billing_cust_country = $customer_country;
$billing_cust_tel = $customer_contact_no;
$billing_cust_email = $customer_email;
$delivery_cust_name = $customer_name;
$delivery_cust_address = $customer_address;
$delivery_cust_state = $customer_statename;
$delivery_cust_country = $customer_country;
$delivery_cust_tel = $customer_contact_no;
$delivery_cust_notes = $customer_message;
$billing_city = $customer_city;
$billing_zip = $customer_zipcode;
$delivery_city = $customer_city;
$delivery_zip = $customer_zipcode;
?> 



<form name="paymentform" method="post" action="https://www.ccavenue.com/shopzone/cc_details.jsp">
    <input type="hidden" name="Merchant_Id" value="<?php echo $Merchant_Id; ?>"> 
    <input type="hidden" name="Amount" value="<?php echo $Amount; ?>"> 
    <input type="hidden" name="Order_Id" value="<?php echo $Order_Id; ?>">
    <input type="hidden" name="Redirect_Url" value="<?php echo $Redirect_Url; ?>"> 
    <input type="hidden" name="Checksum" value="<?php echo $Checksum; ?>"> 
    <input type="hidden" name="billing_cust_name" value="<?php echo $billing_cust_name; ?>"> 
    <input type="hidden" name="billing_cust_address" value="<?php echo $billing_cust_address; ?>"> 
    <input type="hidden" name="billing_cust_country" value="<?php echo $billing_cust_country; ?>"> 
    <input type="hidden" name="billing_cust_state" value="<?php echo $billing_cust_state; ?>"> 
    <input type="hidden" name="billing_zip" value="<?php echo $billing_zip; ?>"> 
    <input type="hidden" name="billing_cust_tel" value="<?php echo $billing_cust_tel; ?>"> 
    <input type="hidden" name="billing_cust_email" value="<?php echo $billing_cust_email; ?>"> 
    <input type="hidden" name="delivery_cust_name" value="<?php echo $delivery_cust_name; ?>">
    <input type="hidden" name="delivery_cust_address" value="<?php echo $delivery_cust_address; ?>">
    <input type="hidden" name="delivery_cust_country" value="<?php echo $delivery_cust_country; ?>">
    <input type="hidden" name="delivery_cust_state" value="<?php echo $delivery_cust_state; ?>"> 
    <input type="hidden" name="delivery_cust_tel" value="<?php echo $delivery_cust_tel; ?>">
    <input type="hidden" name="delivery_cust_notes" value="<?php echo $delivery_cust_notes; ?>"> 
    <input type="hidden" name="Merchant_Param" value="<?php echo $Merchant_Param; ?>"> 
    <input type="hidden" name="billing_cust_city" value="<?php echo $billing_city; ?>">
    <input type="hidden" name="billing_zip_code" value="<?php echo $billing_zip; ?>">
    <input type="hidden" name="delivery_cust_city" value="<?php echo $delivery_city; ?>"> 
    <input type="hidden" name="delivery_zip_code" value="<?php echo $delivery_zip; ?>"> 
    <INPUT TYPE="submit" value="submit">
</form>