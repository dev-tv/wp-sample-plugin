<?php include_once 'header.php'; ?>
<div class="setting-container">
    <?php
    global $wpdb;
    $current_user = wp_get_current_user();
    $user_id = $current_user->ID;

    if (isset($_GET ['page'])) {
        $page = trim($_GET ['page']);
        if ($page == "import-dealers") {
            include_once 'import-dealers/import-dealers.php';
        }
    }
    ?>
</div>
<?php include_once 'footer.php'; ?>