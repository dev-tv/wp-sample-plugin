<?php
global $wpdb;
$table_name = $wpdb->prefix . "child_registration";
if (isset($_GET["reg"])) {
    $page = $_GET["reg"];
} else {
    $page = 1;
};
$start_from = ($page - 1) * 20;
$results = $wpdb->get_results("SELECT * FROM $table_name WHERE `delete_status` = '0' AND `status`='paid' ORDER BY id ASC LIMIT $start_from, 20");
?>
<div class="fw-portPreview">
    <?php
    /* echo '<tr><td>Order Id</td><td>' . $result->registration_id . '</td></tr>
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
      <tr><td>photo3</td><td><img src=' . $upload_dir['baseurl'] . '/kids_photo/' . $result->photo3 . ' width="180" height="180"  alt="img3">&nbsp&nbsp<a href=' . $upload_dir['baseurl'] . '/kids_photo/' . $result->photo3 . '  download=' . $result->photo3 . '>Download</a></td></tr>'; */
    $upload_dir = wp_upload_dir();
    if(count($results)){
        foreach ($results as $result) {
            echo '<div class="img_block wrapped_img fs_port_item gallery_item_wrapper">';
            echo '<a class="featured_ico_link swipebox" rel="gallery-post" href="javascript:void(0);" title=""></a>';

            echo '<img width="540" height="" src="' . $upload_dir['baseurl'] . '/kids_photo/' . $result->photo1 . '" alt="">';
            echo '<div class="gallery_fadder"></div>';
            echo '<span class="featured_items_ico"></span>';
            echo '</div>';
        }
    } else{
        echo "No contestant to show now.";
    }
    ?>
</div>