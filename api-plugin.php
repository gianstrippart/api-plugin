<?php
/**
 * Plugin Name: API Plugin
 * Plugin URI: https://gianluigistrippoliarteaga.crevado.com/galeria
 * Description: Very simple plugin to retrieve API REST data.
 * Version: 1.1
 * Author: Gianluigi Strippoli
 * Author URI: https://gianluigistrippoliarteaga.crevado.com/
 */

add_action( 'admin_init', 'apiplugin_register_settings' );
function apiplugin_register_settings() {
    add_option( 'apiplugin_max_per_call', '3');
    register_setting( 'apiplugin_options_group', 'apiplugin_max_per_call', 'apiplugin_callback' );
 }
 add_action('admin_menu', 'apiplugin_register_options_page');
 function apiplugin_register_options_page() {
    add_menu_page('API Plugin','API Plugin','manage_options','apiplugin','apiplugin_main','',50);
    add_submenu_page('apiplugin','API Plugin Options','Plugin Settings','manage_options','apiplugin_options_page','apiplugin_options_page',null);
  }
function apiplugin_options_page(){?>
    <div>
    <h2>API Plugin Page Settings</h2>
    <form method="post" action="options.php">
    <?php settings_fields( 'apiplugin_options_group' ); ?>
    <p>Here you can set the maximum amount of results to retrieve from the API (e.g. '3' for 'Top 3')</p>
    <label for="apiplugin_max_per_call"><b>Maximum per call:</b></label><br>
    <input type="text" id="apiplugin_max_per_call" name="apiplugin_max_per_call" value="<?php echo get_option('apiplugin_max_per_call'); ?>" />
    <?php  submit_button(); ?>
    </form>
    </div><?php
}
function apiplugin_main(){
    $server = 'http://127.0.0.1:8000';
    $url = '/'.get_option('apiplugin_max_per_call').'/links';
    $response = wp_remote_get($server.$url);
    $body = wp_remote_retrieve_body($response);
    echo '<div id="main-container">';
    echo '<h1 class="title"> API Plugin </h1>';
    echo '<div class="render-area">
            <p class=""><b>Top '.get_option('apiplugin_max_per_call').' most visited links are: </b></p>
            <p class="placeholder-t">'.$body.'</p>
          </div>';

    $url = '/'.get_option('apiplugin_max_per_call').'/browsers';
    $response = wp_remote_get($server.$url);
    $body = wp_remote_retrieve_body($response);
    echo '<div class="render-area">
          <p class=""><b>Top '.get_option('apiplugin_max_per_call').' visits by browser: </b></p>
          <p class="placeholder-t">'.$body.'</p>
        </div>';
    echo '</div>';

}
?>