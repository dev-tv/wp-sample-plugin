<html>
    <head>
        <title>India cutest kid </title>

    </head>
    <body><style type="text/css"> 
            body{margin: 0;padding: 0;}
            .centered {margin: 0 auto;text-align: left; width: 750px;font-family: georgia;}
            table, th, td { border: 1px solid black;}
        </style> 
        <div class="centered">

            <?php
            $location = $_SERVER['DOCUMENT_ROOT'];
            include ($location . '/wp-config.php');
            include ($location . '/wp-load.php');


            if (isset($_REQUEST['res'])) {
                global $wpdb;
                $table_name = $wpdb->prefix . "child_registration";

                $results = $wpdb->get_results("SELECT * FROM $table_name where id ='" . $_REQUEST['res'] . "'");


                $upload_dir = wp_upload_dir();
                foreach ($results as $result) {
                    echo "<h3>India cutest kid Registration entry :" . $result->child_name . "<h3>";
                    echo '<table width="70%" style="margin-top:20px;">


<tr><td>Order Id</td><td>' . $result->registration_id . '</td></tr>
<tr><td>Child name</td><td>' . $result->child_name . '</td></tr>
<tr><td>Date of birth</td><td>' . $result->date_of_birth . '</td></tr>
<tr><td>Agege</td><td>' . $result->age . '</td></tr>
<tr><td>Gender</td><td>' . $result->gender . '</td></tr>
<tr><td>Parent name</td><td>' . $result->parent_name . '</td></tr>
<tr><td>Contact number</td><td>' . $result->contact_number . '</td></tr>
<tr><td>Email id</td><td>' . $result->email_id . '</td></tr>
<tr><td>Facebook URL</td><td>' . $result->facebook_id . '</td></tr>
<tr><td>Address</td><td>' . $result->address . '</td></tr>
<tr><td>State</td><td>' . $result->state . '</td></tr>
<tr><td>City</td><td>' . $result->city . '</td></tr>
<tr><td>photo1</td><td><img src=' . $upload_dir['baseurl'] . '/kids_photo/' . $result->photo1 . ' width="180" height="180" alt="img1"></td></tr>
<tr><td>photo2</td><td><img src=' . $upload_dir['baseurl'] . '/kids_photo/' . $result->photo2 . ' width="180" height="180"  alt="img2"></td></tr>
<tr><td>photo3</td><td><img src=' . $upload_dir['baseurl'] . '/kids_photo/' . $result->photo3 . ' width="180" height="180"  alt="img3"></td></tr>
<tr><td>photo4</td><td><img src=' . $upload_dir['baseurl'] . '/kids_photo/' . $result->photo4 . ' width="180" height="180"  alt="img4"></td></tr>
<tr><td>status</td><td>' . $result->status . '</td></tr>

</table>';
                }
            }
            ?>
        </div>
    </body>
</html>


