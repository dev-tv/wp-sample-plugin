<?php
wp_enqueue_script ( 'wp_bootstrap_js', SDI_URL . "admin/js/bootstrap/bootstrap.min.js", array ('jquery' ), '', true );
wp_enqueue_script ( 'wp_bootstrap_multiselect_js', SDI_URL . "admin/js/bootstrap/bootstrap-multiselect.js", array ('jquery' ), '', true );
wp_enqueue_script ( 'wp_bootstrap_moment_js', SDI_URL . "admin/js/bootstrap/moment.min.js", array ('jquery' ), '', true );
wp_enqueue_script ( 'wp_progress_bar', SDI_URL . "admin/js/jquery/circle-progress.min.js", array ('jquery' ), '', true );
wp_enqueue_script ( 'wp_setting_js', SDI_URL . 'admin/js/setting/setting_script.js', array ('jquery'), '', true );
wp_localize_script ( 'wp_setting_js', 'wp_ajax', array ( 'ajax_url' => admin_url ( 'admin-ajax.php' ), 'sdi_url' => SDI_URL) );
wp_enqueue_style ( 'bootstrap_css', SDI_URL . "admin/css/bootstrap.min.css" );
wp_enqueue_style ( 'wp_bootstrap_multiselect_css', SDI_URL . "admin/js/bootstrap/bootstrap-multiselect.js" );
wp_enqueue_style ( 'wp_typeahead_css', SDI_URL . 'admin/css/typeahead_less.css' );
wp_enqueue_style ( 'wp_main_css', SDI_URL . 'admin/css/style.css' );
wp_enqueue_style ( 'wp_setting_css', SDI_URL . 'admin/css/setting-style.css' );

$page = "import-dealers";
if (isset ( $_GET ['page'] ))
	$page = trim ( $_GET ['page'] );
else
	$_GET ['page'] = $page;
?>
<header class="setting-header">
    <ul class="nav nav-tabs">
        <li class="<?php if($page == "import-dealers"){echo "active";} ?>">
            <a href="edit.php?post_type=dealers&page=import-dealers" aria-expanded="false">Import Dealers</a>
        </li>
    </ul>
</header>