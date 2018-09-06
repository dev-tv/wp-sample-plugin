<?php
/*
 * Plugin Name: Dealers Import
 * Plugin URI: XXXXXXXXXX
 * Description: Dealers Import plugin to import your dealers from CSV.
 * Version: 1.XX
 * Author: XXXXXXXXXX
 * Author URI: XXXXXXXXXX
 * License: XXXXXXXXXX
 */
ini_set ( 'memory_limit', '2048M' );
ini_set ( 'post_max_size', '1024M' );
ini_set ( 'upload_max_filesize', '512M' );

define ( 'SDI_PATH', untrailingslashit ( dirname ( __FILE__ ) ) );
define ( 'SDI_URL', plugins_url ( '/', __FILE__ ) );
define ( 'SDI_BASE_NAME', plugin_basename ( __FILE__ ));
define ( 'SDI_AUTO_SAVE_PROPETY_INTERVAL', 6000);

setlocale(LC_MONETARY,"en_US.utf8");

require_once "admin/functions.php";
if(is_admin())
	require_once "admin/ajax.php";
require_once 'admin/pages/setting/import-dealers/ImportDealers.php';

class SDI {

    public function sdi_install() {
        add_option('Activated_Plugin', 'sdi');
    }

    public function sdi_deactivation() {
        update_option("Activated_Plugin", "");
    }

    public static function sdi_uninstall() {
        delete_option("Activated_Plugin");
    }

    public function sdi_add_menu_page() {
        global $menu;

        $page_title = "dealer";
        $menu_title = "Dealer";
        $capability = "access_sdi";
        $menu_slug = "edit.php?post_type=dealers";
        $function = null;

        // ADD MAIN MENU PAGE
        //add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, plugins_url('sr-dealer-import/images/logo.png'), 6);
        
        add_submenu_page($menu_slug, "Import Dealers", 'Import Dealers', 'access_sdi', 'import-dealers', array(
            $this,
            'settings_render'
        ));
    }

    public function settings_render() {
        require_once SDI_PATH . '/admin/pages/setting/Setting.php';
    }

    private function execute_sql($filename) {
        global $wpdb;

        $script_path = CPD_PATH . '/admin/sql';

        $command = "mysql -u" . DB_USER . " -p" . DB_PASSWORD . " " . "-h " . DB_HOST . " -D " . DB_NAME . " < $script_path";

        $output = shell_exec($command . "/$filename");

        $sql = "SELECT COUNT(id) FROM cpd_cities_county";

        $count = intval($wpdb->get_var($sql));
        if ($count == 0) {
            $filename = "cities_county_state.sql";
            $script_path = CPD_PATH . '/admin/sql';

            $command = "mysql -u" . DB_USER . " -p" . DB_PASSWORD . " " . "-h " . DB_HOST . " -D " . DB_NAME . " < $script_path";
            $output = shell_exec($command . "/$filename");
        }
    }

     public function allow_administrator_access() {
        global $current_user;
        $roles = array( 'administrator' );
        foreach ($roles as $the_role) {
            $role = get_role($the_role);

            if ($the_role == "administrator") {
                $role->add_cap('read');
                $role->add_cap('access_sdi');
            }
        }
    } 

    public function initi_plugin() {
        register_activation_hook(__FILE__, array(
            &$this,
            "sdi_install"
        ));
        register_deactivation_hook(__FILE__, array(
            &$this,
            "sdi_deactivation"
        ));
        register_uninstall_hook(__FILE__, array(
            "SDI",
            "sdi_uninstall"
        ));

        add_action('admin_menu', array(
            $this,
            'sdi_add_menu_page'
        ));
        add_action('admin_init', array(
            $this,
            'allow_administrator_access'
                ), 999);
    }

}

$cpd = new SDI ();
$cpd->initi_plugin ();

$importExport = new ImportDealers ();
$importExport->init ();

?>