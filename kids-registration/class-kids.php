<?php

abstract class Cutekids {

    abstract function states();

    abstract function child_registration();
}

class kids {
    static function states() {
        global $wpdb;
        $query = "SELECT * FROM ".$wpdb->prefix."statelist GROUP BY state";
        $state = $wpdb->get_results($query);
        $option = "<select name='state' required><option value=\"\">Select State</option>";
        foreach ($state as $st):
            $option .= "<option value=" . $st->city_id . ">" . $st->state . "</option>";
        endforeach;
        $option .= "</select>";
        return $option;
    }

    function child_registration() {
        global $wpdb;
        //extract($_POST);
        $resArr = array();
        $child_name = $_POST['child_name'];
        $order_id = $_POST['order_id'];
        $date_of_birth = $_POST['date_of_birth'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $parent_name = $_POST['parent_name'];
        $contact_number = $_POST['contact_number'];
        $email_id = $_POST['email_id'];
        $facebook_id = $_POST['facebook_id'];
        $address = $_POST['address'];
        $state = $_POST['state'];
        $city = $_POST['city'];

        $table_name = $wpdb->prefix . "child_registration";
        $photo1 = '';
        $photo2 = '';
        $photo3 = '';
        $photo4 = '';
        $path = ABSPATH . '/wp-content/uploads/kids_photo/';
        if (isset($_FILES['photo1']['name'])) {
            $photo1 = time() . $_FILES['photo1']['name'];
            move_uploaded_file($_FILES['photo1']['tmp_name'], $path . $photo1);
        }
        if (isset($_FILES['photo2']['name'])) {
            $photo2 = time() . $_FILES['photo2']['name'];
            move_uploaded_file($_FILES['photo2']['tmp_name'], $path . $photo2);
        }
        if (isset($_FILES['photo3']['name'])) {
            $photo3 = time() . $_FILES['photo3']['name'];
            move_uploaded_file($_FILES['photo3']['tmp_name'], $path . $photo3);
        }

        $log = "======================================" . "\n";
        $log .= "Order ID : ".$order_id." - Starting Registration - " . "\n\n";
        $log .= "Child Name : ".$_POST['child_name'] . "\n";
        $log .= "Date of Birth : ".$_POST['date_of_birth'] . "\n";
        $log .= "Age : ".$_POST['age'] . "\n";
        $log .= "Gender : ".$_POST['gender'] . "\n";
        $log .= "Parent Name : ".$_POST['parent_name'] . "\n";
        $log .= "Contact Number : ".$_POST['contact_number'] . "\n";
        $log .= "Facebook Id : ".$_POST['facebook_id'] . "\n";
        $log .= "Address : ".$_POST['address'] . "\n";
        $log .= "State : ".$_POST['state'] . "\n";
        $log .= "City : ".$_POST['city'] . "\n";
        $log .= "Photo 1 : ".$path.$photo1 . "\n";
        $log .= "Photo 2 : ".$path.$photo2 . "\n";
        $log .= "Photo 3 : ".$path.$photo3 . "\n";
        $log .= "Registration Before Payment ========" . "\n\n";
        $lh = fopen(ABSPATH. '/wp-content/plugins/cute-kids/reg.log', 'a+');
        fwrite($lh, $log);
        fclose($lh);
        

        //$reg_id = uniqid();
    if($order_id!='' && $child_name!='' && $date_of_birth!='' && $age!='' && $gender!='' && $contact_number!='' )
{    
        $query = "INSERT INTO $table_name(`registration_id`,`child_name`,`date_of_birth`,`age`,`gender`,`parent_name`,`contact_number`,`email_id`,`facebook_id`,`address`,`state`,`city`,`photo1`,`photo2`,`photo3`) VALUES('$order_id','$child_name','$date_of_birth','$age','$gender','$parent_name','$contact_number','$email_id','$facebook_id','$address','$state','$city','$photo1','$photo2','$photo3')";
        $result = $wpdb->query($query);
        $lastid = $wpdb->insert_id;
        $resArr["lastid"] = "$lastid";

        }else{  $resArr["lastid"] = ''; } 
        //$message='Dear,'.$parent_name.' Your child '.$child_name.' is registered for India Cutest Kids - Bacche Banege Star Competition, Your Payment is in Process. Thanks';
        //$message = 'Dear Parent, Your child registration for “India Cutest Kids: Bacche Banenge STAR” contest in process, please visit www.facebook.com/indiacutestkids page Thanks';
        //$ch = curl_init();
        //$url1 = 'http://smszone.us/xml-connect-api.php?username=MYCITY&password=MYCITY123&mobile=' . urlencode($contact_number) . '&message=' . urlencode($message);
        //curl_setopt($ch, CURLOPT_URL, $url1);
        //curl_setopt($ch, CURLOPT_HEADER, 0);
        //curl_exec($ch);
        //curl_close($ch);
        //return $reg_id;

         $resArr["order_id"] = "$order_id";

         return $resArr;
    }

}

//start code for insert data into table
class kids1 {

    public function child_registration1() {
        //die('---------dfddsfsfsdf---------');
        //echo '<pre>';
        //print_r($_POST);
        global $wpdb;
        $table_name = $wpdb->prefix . "child_registration";
        //echo $table_name; die();
        $child_name = $_POST['child_name'];
        $date_of_birth = $_POST['date_of_birth'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $parent_name = $_POST['parent_name'];
        $contact_number = $_POST['contact_number'];
        $email_id = $_POST['email_id'];
        $facebook_id = $_POST['facebook_id'];
        $address = $_POST['address'];
        $state = $_POST['state'];
        $city = $_POST['city'];

        $path = ABSPATH . 'wp-content/uploads/kids_photo/';
        if (isset($_FILES['photo1']['name'])) {
            $photo1 = time() . $_FILES['photo1']['name'];
            move_uploaded_file($_FILES['photo1']['tmp_name'], $path . $photo1);
        }

        if (isset($_FILES['photo2']['name'])) {
            $photo2 = time() . $_FILES['photo2']['name'];
            move_uploaded_file($_FILES['photo2']['tmp_name'], $path . $photo2);
        }


        if (isset($_FILES['photo3']['name'])) {
            $photo3 = time() . $_FILES['photo3']['name'];
            move_uploaded_file($_FILES['photo3']['tmp_name'], $path . $photo3);
        }


        if (isset($_FILES['photo4']['name'])) {
            $photo4 = time() . $_FILES['photo4']['name'];
            move_uploaded_file($_FILES['photo4']['tmp_name'], $path . $photo4);
        }


        $query = "INSERT INTO $table_name(`child_name`,`date_of_birth`,`age`,`gender`,`parent_name`,`contact_number`,`email_id`,`facebook_id`,`address`,`state`,`city`,`photo1`,`photo2`,`photo3`) VALUES(		'$child_name','$date_of_birth','$age','$gender','$parent_name','$contact_number','$email_id','$facebook_id','$address','$state','$city','$photo1','$photo2','$photo3')";
        //echo $query; die();
        $result = $wpdb->query($query);
        if ($result) {
            echo "<h1 style='color: #66cc33; font-size: 20px; font-weight: bold;'> Redirected to payment <h1>";

            echo '<meta http-equiv="refresh" content="0;URL= http://indiacutestkids.com/payment" />';
        }

        //print_r($result);die();
    }

}

?>
