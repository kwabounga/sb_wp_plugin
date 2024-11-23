<?php
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
    update_option('sb_wp_enabled', $_POST['plugin_enabled']??false);
    update_option('sb_wp_publickey', $_POST['public_key']);
    update_option('sb_wp_homepage', $_POST['home_page']);
    update_option('sb_wp_debugmode', $_POST['debug_mode']??false);
  }

  $sb_wp_enabled = get_option('sb_wp_enabled', false);
  $sb_wp_public_key = get_option('sb_wp_publickey');
  $sb_wp_home_page = get_option('sb_wp_homepage');
  $sb_wp_debug_mode = get_option('sb_wp_debugmode', false);
  //var_dump($sb_wp_debug_mode)
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
    
    <h2>Configuration</h2>
    <table class="form-table" role="presentation">
      <form method="post" action="">
        <tbody>        
        <?php /* PUBLIC KEY */ ?>
          <tr>
            <th scope="row"><label for="public_key">Clé Publique SPREAD :</label></th>
            <td>
              <input  type="text" 
                      id="public_key" 
                      name="public_key" 
                      placeholder="<spread public api key here>" 
                      value="<?php echo $sb_wp_public_key;?>" 
                      aria-describedby="public_key-description"
                      class="regular-text ltr"
                      >
              <p class="description" id="public_key-description">la clé publique de votre compte Spread</p>
            </td>
          </tr>
          <?php /* HOME PAGE URL */ ?>
          <tr>
            <th scope="row"><label for="home_page">Home page URL : </label></th>
            <td>
              <input  type="text" 
                      id="home_page" 
                      name="home_page" 
                      placeholder="https://www.your-wordpress-website.com" 
                      value="<?php echo $sb_wp_home_page;?>" 
                      aria-describedby="home_page-description"
                      class="regular-text ltr"
                      >
              <p class="description" id="home_page-description">l'url de la home du site wordpress</p>
            </td>
          </tr>
          <?php /* ENABLE PLUGIN */ ?>
          <tr>
            <th scope="row"><label for="plugin_enabled">Activer la popup :</label></th>
            <td>
              <input type="checkbox" id="plugin_enabled" name="plugin_enabled" <?= $sb_wp_enabled?'checked':'';?> aria-describedby="plugin_enabled-description">
              <p class="description" id="plugin_enabled-description">active/désactive la popup</p>
            </td>
          </tr>
          <?php /* DEBUG SWITCH */ ?>
          <tr>
            <th scope="row"><label for="debug_mode">Debug Mode (for dev only) : </label></th>
            <td>
              <input type="checkbox" id="debug_mode" name="debug_mode" <?= $sb_wp_debug_mode?'checked':'';?> aria-describedby="debug_mode-description">
              <p class="description" id="debug_mode-description">voir les logs du sb-tracker.js dans la console</p>
            </td>
          </tr>
          <?php /* SAVE BUTTON */ ?>
          <tr>
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
