<style>
    .not-active {
        pointer-events: none;
        cursor: default;
        background:#ddd;
    }

    .pagi {
        background: #fff none repeat scroll 0 0;
        border: 1px;
        box-shadow: 0px 0px 1px;
        padding: 5px;
    }
    .pagination {
        float:right;
        margin-right:20px;
        margin-top:7px;
    }
    ul.page_navi li {
        float: left;
        padding-right: 10px;
        display: block;
        float: left;
        border: solid 1px #c0c0c0;
        padding: 5px 7px;
        margin-right: 6px;
        border-radius: 3px;
        color: #444;
    }

</style>
<?php
global $wpdb;
$table_name = $wpdb->prefix . "child_registration";
if (isset($_GET["reg"])) {
    $page = $_GET["reg"];
} else {
    $page = 1;
};
$start_from = ($page - 1) * 20;
$results = $wpdb->get_results("SELECT * FROM $table_name WHERE `delete_status` = '0' ORDER BY id DESC LIMIT $start_from, 20");

//print_r($results); 
?>
<body>

    <?php
    if (isset($_REQUEST['res'])) {
        echo '<style type="text/css"> 
            body{margin: 0;padding: 0;}
			.centered {margin: 0 auto;text-align: left; width: 750px;font-family: georgia;}
			 th, td { border: 1px solid azure; padding: 10px;  background: #fff none repeat scroll 0 0;}
                         
        </style> ';
        global $wpdb;
        $table_name = $wpdb->prefix . "child_registration";

        $results = $wpdb->get_results("SELECT * FROM $table_name where id ='" . $_REQUEST['res'] . "'");


        $upload_dir = wp_upload_dir();
        foreach ($results as $result) {
            echo "<h3 style='background: #fff none repeat scroll 0 0;color: #23282d;font-size: 1.3em;margin: 1em 0;padding: 19px;'>India cutest kid Registration entry :" . $result->child_name . "<h3>";
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
                <tr><td>photo1</td><td><img src=' . $upload_dir['baseurl'] . '/kids_photo/' . $result->photo1 . ' width="180" height="180" alt="img1"> &nbsp&nbsp<a href=' . $upload_dir['baseurl'] . '/kids_photo/' . $result->photo1 . '  download=' . $result->photo1 . '>Download</a></td></tr>
                <tr><td>photo2</td><td><img src=' . $upload_dir['baseurl'] . '/kids_photo/' . $result->photo2 . ' width="180" height="180"  alt="img2">&nbsp&nbsp<a href=' . $upload_dir['baseurl'] . '/kids_photo/' . $result->photo2 . '  download=' . $result->photo2 . '>Download</a></td></tr>
                <tr><td>photo3</td><td><img src=' . $upload_dir['baseurl'] . '/kids_photo/' . $result->photo3 . ' width="180" height="180"  alt="img3">&nbsp&nbsp<a href=' . $upload_dir['baseurl'] . '/kids_photo/' . $result->photo3 . '  download=' . $result->photo3 . '>Download</a></td></tr>
                <tr><td>status</td><td>' . $result->status . '</td></tr>

                </table>';
        }
    } 
    else {
        ?>

        <form action="" method="post">
            <input type="submit" value="Delete" style="background:#fff;""><span id="msg"></span>

            <?php
            /* global $wpdb;
              $perpage = 10;
              $table_name = $wpdb->prefix."child_registration";
              $resuls = $wpdb->get_results("SELECT * FROM $table_name  where delete_status=0");
              $count =  $wpdb->num_rows;
              $c = $count/$perpage;
              $prev= $_GET["reg"]-1;
              $next= $_GET["reg"]+1;
              echo '<div class="pagination">';
              if($prev == '-1')
              {
              echo '<a href="admin.php?page=reg-main&reg='.$prev.'" class="not-active pagi">Prev</a>';
              }
              else
              {
              echo '<a href="admin.php?page=reg-main&reg='.$prev.'" class="pagi">Prev</a>';
              }
              for($i=1;$i<=$c;$i++)
              {
              echo '<a href="admin.php?page=reg-main&reg='.$i.'" class="pagi">'.$i.'</a>';
              }
              echo '<a href="admin.php?page=reg-main&reg='.$page_id.'+1" class="pagi">Next</a>';
              echo '</div>'; */
            ?>
            <table class="wp-list-table widefat fixed striped users">
                <thead>
                    <tr>
                        <td class="manage-column column-cb check-column" id="cb"><label for="cb-select-all-1" class="screen-reader-text">Select All</label><input type="checkbox" id="cb-select-all-1" value="delete_all"></td>
                        <th class="manage-column column-username column-primary sortable desc" id="username" scope="col"><span style="margin-left:10px;">Child Name</span></th>
                        <th class="manage-column column-name sortable desc" id="name" scope="col"><span style="margin-left:10px;">Parent Name</span></th>
                        <th class="manage-column column-name sortable desc" id="name" scope="col"><span style="margin-left:10px;">City</span></th>
                        <th class="manage-column column-email sortable desc" id="email" scope="col"><span style="margin-left:10px;">Contact Number</span></th>
                        <th class="manage-column column-email sortable desc" id="email" scope="col"><span style="margin-left:10px;">Payment Status</span></th>
                        <th class="manage-column column-email sortable desc" id="email" scope="col"><span style="margin-left:10px;">Registration Date</span></th>
                        <th class="manage-column column-role" id="role" scope="col"><span style="margin-left:36px;">View Detail</span></th>
                    </tr>
                </thead>


                <tbody data-wp-lists="list:user" id="the-list">
                    <?php
                    foreach ($results as $result)
                        echo '<tr id="user-1"><th class="check-column" scope="row"><label for="user_1" class="screen-reader-text">Select admin</label>
                            <input type="checkbox" class="administrator"  name="users_id[]" value=' . $result->id . '></th>

                            <td data-colname="Username" class="username column-username has-row-actions column-primary">' . $result->child_name . '</td>
                            <td data-colname="Name" class="name column-name">' . $result->parent_name . '</td><td data-colname="E-mail" class="email column-email">' . $result->city . '</td>
                            <td data-colname="Role" class="role column-role">' . $result->contact_number . '</td>
                            <td data-colname="Posts" class="posts column-posts payment_status">' . $result->status . '</td>
                            <td data-colname="Posts" class="posts column-posts payment_status">' . $result->createdon . '</td>
                            <td data-colname="Posts" class="posts column-posts num"><a class="edit"><span aria-hidden="true">
                            <a href="admin.php?page=reg-main&res=' . $result->id . '"> View detail</a></td></tr>';
                    ?>
                </tbody>

                <tfoot>
                    <tr>
                        <td class="manage-column column-cb check-column" id="cb"><label for="cb-select-all-1" class="screen-reader-text">Select All</label><input type="checkbox" id="cb-select-all-1" value="delete_all"></td>
                        <th class="manage-column column-username column-primary sortable desc" id="username" scope="col"><span style="margin-left:10px;">Child Name</span></th>
                        <th class="manage-column column-name sortable desc" id="name" scope="col"><span style="margin-left:10px;">Parent Name</span></th>
                        <th class="manage-column column-name sortable desc" id="name" scope="col"><span style="margin-left:10px;">Email_id</span></th>
                        <th class="manage-column column-email sortable desc" id="email" scope="col"><span style="margin-left:10px;">Contact Number</span></th>
                        <th class="manage-column column-email sortable desc" id="email" scope="col"><span style="margin-left:10px;">Payment Status</span></th>
                        <th class="manage-column column-email sortable desc" id="email" scope="col"><span style="margin-left:10px;">Registration Date</span></th>
                        <th class="manage-column column-role" id="role" scope="col"><span style="margin-left:36px;">View Detail</span></th></tr>
                </tfoot>

            </table>
        </form>


        <?php
        global $wpdb;
        $table_name_page = $wpdb->get_results("SELECT * FROM ".$table_name."  WHERE `delete_status` = '0'");
        $rows = $wpdb->num_rows;
        $total_pages = ($rows / 20);
        echo '<ul class="page_navi">';
        echo "<li><a href='admin.php?page=reg-main&reg=1'>" . 'First' . "</a> </li>"; // Goto 1st page   
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<li><a href='admin.php?page=reg-main&reg=" . $i . "'>" . $i . "</a></li> ";
        };
        echo "<li><a href='admin.php?page=reg-main&reg=$total_pages'>" . 'Last' . "</a></li> "; // Goto 1st page  
        echo '</ul>';
        ?>
        <?php
        if (isset($_REQUEST['delete_all'])) {
            global $wpdb;

            $table_name = $wpdb->prefix . "child_registration";
            $query = "UPDATE $table_name SET delete_status='1'";
            $update = $wpdb->query($query);
            if ($update) {
                echo "<script>document.getElementById('msg').innerHTML = 'All Rows Deleted';
				setTimeout(function(){
				   window.location.reload(1);
				}, 300);
                        </script>";
            }
        }
        if (isset($_REQUEST['users_id'])) {
            foreach ($_REQUEST['users_id'] as $users_id) {
                global $wpdb;

                $table_name = $wpdb->prefix . "child_registration";
                $query = "UPDATE $table_name SET delete_status='1' WHERE id='$users_id'";
                $update = $wpdb->query($query);
                if ($update) {
                    echo "<script>document.getElementById('msg').innerHTML = 'Row Deleted';
				setTimeout(function(){
				   window.location.reload(1);
				}, 300);
                    </script>";
                }
            }
        }
    }
?>