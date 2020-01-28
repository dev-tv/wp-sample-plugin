<?php

/**
  Plugin Name: Cute Kids Registration
  Description: This plugin is developed for cute kids functionality.
  Author: CuteKids
  Author Uri:registration
  version:1.0
 * */
// Include Kids class
require_once("class-kids.php");

//require_once("maincss.php");
// Create Shortcode for registration

add_shortcode('kids_registration', 'kids_registration_callback');
function kids_registration_callback() {
    ob_start();
    require_once('includes/registration.php');
    return ob_get_clean();
}

add_shortcode('kids_registration_1', 'kids_registration_callback_1');
function kids_registration_callback_1() {
    $kids_obj = new kids;
    $reg_id = $kids_obj->child_registration();

  $regis_id = $reg_id['lastid'];
    $orders_id = $reg_id['order_id']; 

    echo '<div style="height:500px;">
                     <h4 style="margin-top:10px;">Thank you for submitting your entry to India cutest kids event</h4>
                     </div>';

    if($regis_id!='' && $orders_id!='')
    {
    require_once('dataFrom.php');
    }else{ echo "Oops! something went wrong please try again"; ?>

        <script type="text/javascript">
setTimeout("window.location='<?php bloginfo('url');?>/kidsinfo/'",5000);
</script>
 
    <?php } 
}

add_shortcode('kids_registration_2', 'kids_registration_callback_2');
function kids_registration_callback_2() {
    $kids_obj = new kids;
    $reg_id = $kids_obj->child_registration();
    
    $regis_id = $reg_id['lastid'];
    $orders_id = $reg_id['order_id']; 

     echo '<div style="height:500px;">
                     <h4 style="margin-top:10px;">Thank you for submitting your entry to India cutest kids event</h4>
                     </div>';
    
    if($regis_id!='' && $orders_id!='')
    {
        require_once('ccavRequestHandler.php');
     }
     else{ echo "Oops! something went wrong please try again"; ?>
        <!--<i class="'fa fa-exclamation-circle'" aria-hidden="true"></i>-->
        <script type="text/javascript">
setTimeout("window.location='<?php bloginfo('url');?>/kidsinfo/'",5000);
</script>
     
   <?php } 
}

add_shortcode("payment_success", "payment_success_callback");
function payment_success_callback() {

include('Crypto.php');

  error_reporting(0);
  
  $workingKey='1234567890';   //Working Key should be provided here.
  $encResponse=$_POST["encResp"];     //This is the response sent by the CCAvenue Server
  $rcvdString=decrypt($encResponse,$workingKey);    //Crypto Decryption used as per the specified working key.
  $order_status="";
  $decryptValues=explode('&', $rcvdString);
  $dataSize=sizeof($decryptValues);
  echo "<center>";

  for($i = 0; $i < $dataSize; $i++) 
  {
    $information=explode('=',$decryptValues[$i]);
    if($i==3) 
               $order_status=$information[1];
    if($i==1)
               $tracking_id=$information[1];
  }
  $log = "Registration After Payment ========" . "\n";
  $log .= "Order Status : ".$order_status . "\n";
  $log .= "Transaction ID: ".$tracking_id . "\n";
  $log .= "Registration Ends ========" . "\n\n";
  $lh = fopen(ABSPATH. '/wp-content/plugins/cute-kids/reg.log', 'a+');
  fwrite($lh, $log);
  fclose($lh);
     
  if($order_status==="Success")
  {
    /* echo "<br>Thank you for submitting your entry to India cutest kids event";
    global $wpdb;
    $table_name = $wpdb->prefix."child_registration";
    $query = "UPDATE $table_name SET status='active' WHERE id=$id";
    $update = $wpdb->query($query); */

       if (isset($_GET['reg_id']) and isset($_GET['code']) and $_GET['status'] == 'success') {
        $receive_code = $_GET['code'];
        if ($receive_code == md5($_GET['reg_id'] . 'kids#@!')) {

            global $wpdb;
            $id = $_GET['reg_id'];
            $table_name = $wpdb->prefix . "child_registration";
            $query = "UPDATE $table_name SET status='paid',txn_id='$tracking_id' WHERE registration_id='$id'";
            $update = $wpdb->query($query);
            if ($update) {
                echo '<div style="height:500px;">
                     <h4 style="margin-top:100px;">Thank you for submitting your entry to India cutest kids event</h4>
                     </div>';
                //$message="Thank you for submitting your entry to India cutest kids event";
                //wp_mail( $to, $subject, $message, $headers, $attachments ); 


            }

$query = "SELECT * FROM $table_name WHERE registration_id='$id'";
$results = $wpdb->get_row($query); 
           
$contactno = $results->contact_number;
$email_id = $results->email_id;   
//send sms//
$username = 'mycity';
$password = 'MY@1245';
$senderid = 'MYCITY';
$mobile = $contactno;
$message1 = 'Dear Parent, Thanks for your enrolment in India Cutest Kids :Calendar Model Hunt 2020 Season-5/ICK Fashion Show , please visit www.facebook.com/indiacutestkids page and get maximum likes and shares on your child picture, picture will be uploaded soon : Thanks Team ICK www.indiacutestkids.com . Query-  indiacutestkids@gmail.com or 9826083489';
$message = urlencode($message1);
$smsurl = 'http://smszone.us/xml-transconnect-api.php?username='.$username.'&password='.$password.'&mobile='.$mobile.'&message='.$message.'&senderid='.$senderid;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $smsurl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$datas = curl_exec($ch);
curl_close($ch);
//echo $datas;

//send email//

$to = $email_id;
$subject = "Indiacutestkids has successfully recived your payment!";

$message = "
<html>
<head>
<title>Payment successful Email</title>
</head>
<body>
<table>
<tr>
<th>Hi,</th>
</tr>
<tr>
<td> </td>
<td>Dear Parent, Thanks for your enrolment in India Cutest Kids :Calendar Model Hunt 2020 Season-5/ICK Fashion Show , please visit www.facebook.com/indiacutestkids page and get maximum likes and shares on your child picture, picture will be uploaded soon : Thanks Team ICK www.indiacutestkids.com . Query-  indiacutestkids@gmail.com or 9826083489</td>
</tr>

</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <indiacutestkids@gmail.com>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";
$sendmail = mail($to,$subject,$message,$headers);

if($sendmail){} 
  
      $regid = $_GET['reg_id'];
      global $wpdb;
      $table_name = $wpdb->prefix . "child_registration";

      $results = $wpdb->get_results("SELECT * FROM $table_name where registration_id ='" . $regid . "'");

        foreach ($results as $result) {

               $photo1 = get_site_url() . '/wp-content/uploads/kids_photo/' . $result->photo1 ;
               $photo2 = get_site_url() . '/wp-content/uploads/kids_photo/' . $result->photo2;
               $photo3 = get_site_url() . '/wp-content/uploads/kids_photo/' . $result->photo3;
        }
 
  ?> 

     <script type="text/javascript">
            var $ = jQuery;
            $(document).ready(function(){
             
              var iv1 = $("#viewer1").iviewer(
                  {
                      src: "<?php echo $photo1; ?>"
                  });

              var iv2 = $("#viewer2").iviewer(
                  {
                      src: "<?php echo $photo2; ?>"
                  });

              var iv3 = $("#viewer3").iviewer(
                  {
                      src: "<?php echo $photo3; ?>"
                  });

            });
        </script>  


         <div id="html-content-holder" style="width:810px;height:810px;">
    
    <div><img src="<?php bloginfo('template_url'); ?>/collage_image/test/image/ick_text.png" style="width:810px;height:50px;"></div>
        
        <div class="wrapper">
           
         <div id="viewer1" class="viewer v1"></div>

         <div id="viewer2" class="viewer v2"></div>

         <div id="viewer3" class="viewer v3"></div>

        </div>
    
    <div class="fooimg">
<img src="<?php bloginfo('template_url'); ?>/collage_image/test/image/ick_logo_deatils.png" style="width:810px;height:316px;">
</div>

    </div>

   <br/><br/>

    <input id="btn-Preview-Image" type="button" value="Preview Collage"/>
   
    <br/>
        
  <br/><br/>
        
    <div id="previewImage"></div>
     <br/>
         <a id="btn-Convert-Html2Image" class="postfb" href="#">Share On Facebook</a>
       <br/><br/>

<?php 
 
        }
    }
    
  }
  else if($order_status==="Aborted")
  {
    echo "<br>Thank you for submitting your entry to India Cutest Kids event.We will keep you posted regarding the status of your registration and further process through e-mail and text messages on your given number.";
      
  }
  else if($order_status==="Failure")
  {
    echo "<br>Thank you for submitting your entry to India Cutest Kids event.However, the transaction has been declined, please try again.";
  }
  else
  {
    echo "<br>Security Error. Illegal access detected";

global $wpdb;
$id = $_GET['reg_id'];
$table_name = $wpdb->prefix . "child_registration";
$query = "SELECT * FROM $table_name WHERE registration_id='$id'";
$results = $wpdb->get_row($query); 
//$contactno = $results->contact_number;
$email_id = $results->email_id;    

$to = $email_id;
$subject = "Sorry, your payment failed!";

$message = "
<html>
<head>
<title>Payment Failed Email</title>
</head>
<body>

<table>
<tr>
<th>Hi,</th>
</tr>
<tr>
<td> </td>
<td>Dear Parent your payment has been failed. Please try again or contact us: indiacutestkids@gmail.com or 9826083489</td>
</tr>
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
// More headers
$headers .= 'From: <indiacutestkids@gmail.com>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";
$sendmail = mail($to,$subject,$message,$headers);
if($sendmail){} 

   }
 
}


add_shortcode("view_participants", "view_participants_callback");
function view_participants_callback() {
    ob_start();
    require_once('includes/registration_entries.php');
    return ob_get_clean();
}


add_action('admin_menu', 'register_my_custom_menu_page');
function register_my_custom_menu_page() {
    add_menu_page('custom menu title', 'Registration-Entries', 'manage_options', 'reg-main', 'main_callback', '', 16);
}

function main_callback() {
    include_once('registration_entries.php'); 
}

?>
