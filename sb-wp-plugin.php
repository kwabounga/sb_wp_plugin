<?php
/**
 * @package Spread Widget WP Plugin
 * @version 1.1.0
 */
/*
  Plugin Name: Spread Widget WP Plugin
  Plugin URI: https://github.com/kwabounga/sb_wp_plugin/
  Description: Spread popup show up on Wordpress
  Author: Jean-Yves Chaillou
  Version: 1.1.0
  Author URI: http://kwabounga.fr/
*/


const SB_WP_TILE = "SPREAD Popup Widget options";
const SB_WP_TILE_MENU = "SPREAD Popup";

function  getPluginNamePath(){
  $plug_url = explode("\\",plugin_dir_path( __FILE__ ));
  $plug_url = $plug_url[count($plug_url) -1];
  return $plug_url;
}

/**
 * ADMIN BUTTON DEFINITION
 */
function sb_wp_plugins_add_admin_page()
{
  add_menu_page(
    SB_WP_TILE,
    SB_WP_TILE_MENU,
    'manage_options',
    'spread_widget',
    'sb_wp_plugins_page',
    plugins_url(getPluginNamePath().'images/spread_picto_20.svg')
  );
}


/**
 * BUTTON MENU CALLBACK 
 * SET configuration
 */
function sb_wp_plugins_page()
{ 
  if (isset($_POST['submit'])) {
    update_option('sb_wp_publickey', $_POST['public_key']);
    update_option('sb_wp_homepage', $_POST['home_page']);
  }

  $sb_wp_public_key = get_option('sb_wp_publickey');
  $sb_wp_home_page = get_option('sb_wp_homepage');
  ?>
  <style>
    .options_head{
      display: flex;
      justify-content: flex-start;
      align-items: center;
      border-left: 3px #EE6900 solid;
    }
  </style>
  <div class="wrap">
    <div class="options_head">
      <a href="https://social-sb.com/login" target="_blank"><img src="<?= plugins_url(getPluginNamePath().'images/SPREAD_LOGO_HORIZ_RVB.svg');?>"  width="251" height="79"  alt="<?php echo SB_WP_TILE;?>"></a>
      <h1><?php echo SB_WP_TILE;?></h1>
    </div>
    

    <table class="form-table" role="presentation">
      <form method="post" action="">
        <tbody>
        <?php /* PUBLIC KEY */ ?>
          <tr>
            <th scope="row"><label for="public_key">Clé Publique SPREAD :</label></th>
            <td><input type="text" id="public_key" name="public_key" value="<?php echo $sb_wp_public_key;?>"></td>
          </tr>
          <?php /* HOME PAGE URL */ ?>
          <tr>
            <th scope="row"><label for="home_page">Home page URL : </label></th>
            <td><input type="text" id="home_page" name="home_page" value="<?php echo $sb_wp_home_page;?>"></td>
          </tr>
          <?php /* SAVE BUTTON */ ?>
          <tr>
            <th scope="row"><!-- <label for="home_page">Enregistrer la configuration </label> --></th>
            <td><input type="submit" name="submit" class="button button-primary" value="Enregistrer" /></td>
          </tr>
        </tbody>
      </form>
    </table>
  </div>
  <?php
}
/**
 * SET CALLBACK ON CLICK ADMIN BUTTON
 */
add_action('admin_menu', 'sb_wp_plugins_add_admin_page');


/**
 * SET CALLBACK ON CLICK ADMIN BUTTON
 */
function sb_wp_plugins_add_Widget_in_front() {
  $sb_wp_public_key = get_option('sb_wp_publickey');
  $sb_wp_home_page = get_option('sb_wp_homepage');
  ?>
    <script type="text/javascript">
      var spconfig = {
          public_key: "<?= $sb_wp_public_key;?>", //public key
          debug: false,
          set_cookie: false, // do not save cookies
          track_order_enabled: false, // no orders tracking
          display_option_home_value: "<?= $sb_wp_home_page;?>", // add own domain here
      };
      function loadSpreadTracker() {
          window.domLoadEventFired = true;
          var e = document.createElement("script");
          e.type = "text/javascript";
          e.async = true;
          e.charset = "UTF-8";
          e.id = "spread-tracker";
          e.src = "<?= plugins_url(getPluginNamePath().'src/sb-tracker.js');?>"; // overwrite js path here
          document.body.appendChild(e)
      }
      if (window.addEventListener) {
          window.addEventListener("load", loadSpreadTracker, false)
      } else if (window.attachEvent) {
          window.attachEvent("onload", loadSpreadTracker)
      } else {
          window.onload = loadSpreadTracker
      }
    </script>
  <?php
  }
  
  add_action('wp_head', 'sb_wp_plugins_add_Widget_in_front');