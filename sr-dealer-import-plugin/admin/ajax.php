<?php

if (!session_id()) {
    session_start();
}

add_action('wp_ajax_import_dealers_from_csv', 'import_dealers_from_csv');

/*     * *
 * @param $value array
 * @return string array values enclosed in quotes every time.
 */
function import_dealers_from_csv() {
    if (isset($_FILES ['csv']['tmp_name'])) {
        $currunt_user_id = get_current_user_id();
        $handle = fopen($_FILES ['csv'] ['tmp_name'], "r");
        $data = fgetcsv($handle, 0, ",", '"');
        $x = 0;
        while (($data = fgetcsv($handle, 0, ",", '"')) !== FALSE) {
            // Gather post data.
            if (count($data) == 27) {
                $csv_property_id = $data[0];
                $dealerId = strtolower(trim($data [1]));
                if ($dealerId != "") {
                    ++$x;
                    $my_post = array(
                        'post_title' => trim($data [1]),
                        'post_author' => $currunt_user_id,
                        'post_status' => 'publish',
                        'post_type' => 'dealers',
                        'post_content' => trim($data[25])
                    );
                    $post_id = wp_insert_post($my_post);
                    add_post_meta($post_id, "dealer_location_dealer_name", trim($data[1]));
                    add_post_meta($post_id, "dealer_location_address", trim($data[2]));
                    add_post_meta($post_id, "dealer_location_city", trim($data[3]));
                    add_post_meta($post_id, "dealer_location_state", trim($data[4]));
                    add_post_meta($post_id, "dealer_location_zip_code", trim($data[5]));
                    add_post_meta($post_id, "dealer_location_phone", trim($data[6]));
                    add_post_meta($post_id, "dealer_location_website", trim($data[7]));
                    add_post_meta($post_id, "dealer_location_facebook", trim($data[12]));
                    add_post_meta($post_id, "dealer_location_latitude", trim($data[15]));
                    add_post_meta($post_id, "dealer_location_longitude", trim($data[16]));
                    add_post_meta($post_id, "dealers_type", trim($data[22]));
                    add_post_meta($post_id, "_dealer_location_dealer_name", "field_5b4c394d78666");
                    add_post_meta($post_id, "_dealer_location_address", "field_5b4c387d7865c");
                    add_post_meta($post_id, "_dealer_location_city", "field_5b4c38c47865e");
                    add_post_meta($post_id, "_dealer_location_state", "field_5b4c38d87865f");
                    add_post_meta($post_id, "_dealer_location_zip_code", "field_5b4c38e178660");
                    add_post_meta($post_id, "_dealer_location_phone", "field_5b4c38ff78662");
                    add_post_meta($post_id, "_dealer_location_website", "field_5b4c38eb78661");
                    add_post_meta($post_id, "_dealer_location_facebook", "field_5b4c390778663");
                    add_post_meta($post_id, "_dealer_location_latitude", "field_5b4c391578664");
                    add_post_meta($post_id, "_dealer_location_longitude", "field_5b4c392278665");
                    add_post_meta($post_id, "_dealers_type", "field_5b4c93f80c737");

                }
            }
        }
    }
    else{
        // No Responce
    }
}
