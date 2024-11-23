<?php
/**
 * SET ACTIONS FOR FRONT PART
 */
function sb_wp_plugins_add_Widget_in_front() {
  
  $sb_wp_enabled = get_option('sb_wp_enabled', false);
  if(!$sb_wp_enabled){
    return;
  }
  $sb_wp_public_key = get_option('sb_wp_publickey');
  $sb_wp_home_page = get_option('sb_wp_homepage');
  $sb_wp_debug_mode = get_option('sb_wp_debugmode', false);
  ?>

  <script type="text/javascript">
    
    var spconfig = {
        public_key: "<?= $sb_wp_public_key;?>", //public key
        debug: <?= $sb_wp_debug_mode?'true':'false';?>,
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
        e.src = "<?= plugins_url(getPluginNamePath().'js/sb-tracker.js');?>"; // overwrite js path here
        document.body.appendChild(e)
    }

    if (window.addEventListener) {
        window.addEventListener("load", loadSpreadTracker, false)
    } else if (window.attachEvent) {
        window.attachEvent("onload", loadSpreadTracker)
    } else {d
        window.onload = loadSpreadTracker
    }

  </script>

  <?php
  }
  
  add_action('wp_head', 'sb_wp_plugins_add_Widget_in_front');
